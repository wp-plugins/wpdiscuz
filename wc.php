<?php

/*
  Plugin Name: wpDiscuz - Wordpress Comments
  Description: Better comment system. Wordpress post comments and discussion plugin. Allows your visitors discuss, vote for comments and share.
  Version: 2.2.5
  Author: gVectors Team (A. Chakhoyan, G. Zakaryan, H. Martirosyan)
  Author URI: http://www.gvectors.com/
  Plugin URI: http://www.gvectors.com/wpdiscuz/
 */

include_once 'options/wc-options.php';
include_once 'options/wc-options-serialize.php';
include_once 'includes/wc-helper.php';
include_once 'includes/wc-db-helper.php';
include_once 'comment-form/tpl-comment.php';
include_once 'wc-css.php';

class WC_Core {

    public $wc_options;
    public $wc_options_serialized;
    public $comment_types;
    public $reviews_count;
    public $wc_db_helper;
    public $wc_helper;
    public $comment_tpl_builder;
    public $wc_css;
    public $wc_parent_comments_count;
    public $commetns_count = 0;
    public $comment_count_text;
    public static $PLUGIN_DIRECTORY;
    public static $TEXT_DOMAIN = 'wpdiscuz';
    public $post_type;
    public $wc_version_slug = 'wc_plugin_version';
    public $wc_user_agent = '';

    function __construct() {
        $this->wc_user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
        add_action('plugins_loaded', array(&$this, 'load_wpdiscuz_text_domain'));
        add_action('init', array(&$this, 'init_plugin_dir_name'), 1);

        $this->wc_db_helper = new WC_DB_Helper();
        $this->wc_options_serialized = new WC_Options_Serialize($this->wc_db_helper);
        $this->wc_options = new WC_Options($this->wc_options_serialized, $this->wc_db_helper);

        register_activation_hook(__FILE__, array($this, 'db_operations'));

        $this->wc_helper = new WC_Helper($this->wc_options_serialized);
        $this->wc_css = new WC_CSS($this->wc_options_serialized);
        $this->comment_tpl_builder = new WC_Comment_Template_Builder($this->wc_helper, $this->wc_db_helper, $this->wc_options, $this->wc_options_serialized);
        
        if (!$this->wc_options_serialized->wc_captcha_show_hide) {
            add_action('init', array(&$this, 'register_session'), 2);
        }
        add_action('admin_init', array(&$this, 'wc_plugin_new_version'), 2);

        add_action('admin_enqueue_scripts', array(&$this, 'admin_page_styles_scripts'), 2315);
        add_action('wp_enqueue_scripts', array(&$this, 'front_end_styles_scripts'));
        add_action('wp_head', array(&$this->wc_css, 'init_styles'));

        add_action('admin_menu', array(&$this, 'add_plugin_options_page'), -191);

        add_action('wp_ajax_wc_comms_via_ajax', array(&$this, 'comment_submit_via_ajax'));
        add_action('wp_ajax_nopriv_wc_comms_via_ajax', array(&$this, 'comment_submit_via_ajax'));

        add_action('wp_ajax_wc_load_more_comments', array(&$this, 'load_more_comments'));
        add_action('wp_ajax_nopriv_wc_load_more_comments', array(&$this, 'load_more_comments'));

        add_action('wp_ajax_wc_vote_via_ajax', array(&$this, 'vote_on_comment'));
        add_action('wp_ajax_nopriv_wc_vote_via_ajax', array(&$this, 'vote_on_comment'));

        add_action('wp_ajax_wc_check_notification_type', array(&$this, 'wc_check_notification_type'));
        add_action('wp_ajax_nopriv_wc_check_notification_type', array(&$this, 'wc_check_notification_type'));

        add_action('wp_ajax_wc_live_update', array(&$this, 'live_update'));
        add_action('wp_ajax_nopriv_wc_live_update', array(&$this, 'live_update'));

        add_action('wp_ajax_wc_list_new_comments', array(&$this, 'wc_list_new_comments'));
        add_action('wp_ajax_nopriv_wc_list_new_comments', array(&$this, 'wc_list_new_comments'));

        add_action('wp_ajax_wpdiscuz_comment_redirect', array(&$this, 'wpdiscuz_comment_redirect'));
        add_action('wp_ajax_nopriv_wpdiscuz_comment_redirect', array(&$this, 'wpdiscuz_comment_redirect'));

        if ($this->wc_options_serialized->wc_comment_editable_time) {
            add_action('wp_ajax_wc_get_editable_comment_content', array(&$this, 'wc_get_editable_comment_content'));
            add_action('wp_ajax_nopriv_wc_get_editable_comment_content', array(&$this, 'wc_get_editable_comment_content'));
            add_action('wp_ajax_wc_save_edited_comment', array(&$this, 'wc_save_edited_comment'));
            add_action('wp_ajax_nopriv_wc_save_edited_comment', array(&$this, 'wc_save_edited_comment'));
        }

        add_filter('preprocess_comment', array(&$this, 'wc_new_comment'));
        add_action('transition_comment_status', array(&$this, 'wc_notify_to_subscriber'), 265, 3);

        $plugin = plugin_basename(__FILE__);
        add_filter("plugin_action_links_$plugin", array(&$this, 'wc_add_plugin_settings_link'));

        add_action('wp_head', array(&$this, 'init_current_post_type'));
    }

    public function load_wpdiscuz_text_domain() {
        load_plugin_textdomain('wpdiscuz', false, dirname(plugin_basename(__FILE__)) . '/languages/');
    }

    /**
     * create table
     * updates the comments to set comment type review if comment id is exists in comment meta table
     */
    public function db_operations() {
        $this->wc_db_helper->create_tables();
    }

    public function wc_plugin_new_version() {
        $this->wc_db_helper->wc_create_email_notification_table();
        $wc_version = (!get_option($this->wc_version_slug) ) ? '1.0.0' : get_option($this->wc_version_slug);
        $wc_plugin_data = get_plugin_data(__FILE__);
        if (version_compare($wc_plugin_data['Version'], $wc_version, '>')) {
            $this->wc_add_new_options();
            $this->wc_add_new_phrases();
            if ($wc_version === '1.0.0') {
                add_option($this->wc_version_slug, $wc_plugin_data['Version']);
            } else {
                update_option($this->wc_version_slug, $wc_plugin_data['Version']);
            }
            if (version_compare($wc_version, '2.1.2', '<=') && version_compare($wc_version, '1.0.0', '!=')) {
                $this->wc_db_helper->wc_alter_phrases_table();
            }

            if (version_compare($wc_version, '2.1.7', '<=') && version_compare($wc_version, '1.0.0', '!=')) {
                $this->wc_db_helper->wc_alter_voting_table();
            }
        }
    }

    private function wc_add_new_options() {
        $this->wc_options_serialized->init_options(get_option($this->wc_options_serialized->wc_options_slug));
        $wc_new_options = $this->wc_options_serialized->to_array();
        update_option($this->wc_options_serialized->wc_options_slug, serialize($wc_new_options));
    }

    private function wc_add_new_phrases() {
        if ($this->wc_db_helper->is_phrase_exists('wc_leave_a_reply_text')) {
            $wc_saved_phrases = $this->wc_db_helper->get_phrases();
            $this->wc_options_serialized->init_phrases();
            $wc_phrases = $this->wc_options_serialized->wc_phrases;
            $wc_new_phrases = array_merge($wc_phrases, $wc_saved_phrases);
            $this->wc_db_helper->update_phrases($wc_new_phrases);
        }
    }

    /*
     * register new session
     */

    public function register_session() {
        if (!session_id() && !is_user_logged_in()) {
            @session_start();
        }
    }

    /**
     * change comment type 
     */
// MUST BE CHANGED IN NEXT VERSION OF PLUGIN
    public function wc_new_comment($commentdata) {

        $commentdata['comment_type'] = isset($commentdata['comment_type']) ? $commentdata['comment_type'] : '';
        $comment_post = get_post($commentdata['comment_post_ID']);
        if ($comment_post->post_type === 'product' && $commentdata['comment_type'] != 'woodiscuz') {
            $com_parent = $commentdata['comment_parent'];
            if ($com_parent != 0) {
                $parent_comment = get_comment($com_parent);
                if ($parent_comment->comment_type == 'woodiscuz') {
                    $commentdata['comment_type'] = 'woodiscuz';
                } else {
                    $commentdata['comment_type'] = 'woodiscuz_review';
                }
            } else {
                $commentdata['comment_type'] = 'woodiscuz_review';
            }
        }

        return $commentdata;
    }

    /**
     * register options page for plugin
     */
    public function add_plugin_options_page() {
        if (function_exists('add_options_page')) {
            add_menu_page('WpDiscuz', 'WpDiscuz', 'manage_options', 'wpdiscuz_options_page', array(&$this->wc_options, 'main_options_form'), plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/plugin-icon/plugin-icon-20.png'), 1246);
            if (!$this->wc_options_serialized->wc_is_use_po_mo) {
                add_submenu_page('wpdiscuz_options_page', 'Phrases', 'Phrases', 'manage_options', 'wpdiscuz_phrases_page', array(&$this->wc_options, 'phrases_options_form'));
            }
        }
    }

    /**
     * Styles and scripts registration to use on front page
     */
    public function front_end_styles_scripts() {
        if (is_singular()) {
            $u_agent = $_SERVER['HTTP_USER_AGENT'];

            wp_register_style('wpdiscuz-frontend-css', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/css/wpdiscuz.min.css'));
            wp_enqueue_style('wpdiscuz-frontend-css');

            if (is_rtl()) {
                wp_register_style('wpdiscuz-frontend-rtl-css', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/css/wpdiscuz-rtl.min.css'));
                wp_enqueue_style('wpdiscuz-frontend-rtl-css');
            }

            if ($this->wc_options_serialized->wc_comment_list_update_type != 0) {
                wp_enqueue_script('wpdiscuz-jquery-ui', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/third-party/jquery-ui/jquery-ui.min.js'), array('jquery'), '1.11.2', false);
            }

            if (preg_match('/MSIE/i', $u_agent)) {
                wp_enqueue_script('wpdiscuz-html5-js', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/third-party/tooltipster/js/html5.min.js'), array('jquery'), '1.2', false);

                wp_register_style('wpdiscuz-modal-css-ie', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/third-party/modal-box/modal-box-ie.min.css'));
                wp_enqueue_style('wpdiscuz-modal-css-ie');
            }

            wp_register_style('wpdiscuz-modal-box-css', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/third-party/modal-box/modal-box.min.css'));
            wp_enqueue_style('wpdiscuz-modal-box-css');

            wp_enqueue_script('wpdiscuz-validator-js', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/js/validator.min.js'), array('jquery'), '1.0.0', false);

            wp_register_style('wpdiscuz-validator-style', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/css/fv.min.css'));
            wp_enqueue_style('wpdiscuz-validator-style');

            wp_enqueue_script('wpdiscuz-cookie-js', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/js/jquery.cookie.min.js'), array('jquery'), '1.4.1', false);

            wp_register_style('wpdiscuz-tooltipster-style', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/third-party/tooltipster/css/tooltipster.min.css'));
            wp_enqueue_style('wpdiscuz-tooltipster-style');

            wp_enqueue_script('wpdiscuz-tooltipster-js', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/third-party/tooltipster/js/jquery.tooltipster.min.js'), array('jquery'), '1.2', false);

            wp_enqueue_script('autogrowtextarea-js', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/js/jquery.autogrowtextarea.min.js'), array('jquery'), '3.0', false);
            wp_enqueue_script('wpdiscuz-frontend-js', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/js/wc-frontend.min.js'), array('jquery'));

            wp_enqueue_script('wpdiscuz-ajax-js', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/js/wc-ajax.min.js'), array('jquery'), get_option($this->wc_version_slug), false);
            wp_localize_script('wpdiscuz-ajax-js', 'wc_ajax_obj', array('url' => admin_url('admin-ajax.php')));
        }
    }

    /**
     * Scripts and styles registration on administration pages
     */
    public function admin_page_styles_scripts() {

        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        if (preg_match('/MSIE/i', $u_agent)) {
            wp_register_style('wpdiscuz-modal-css-ie', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/third-party/modal-box/modal-box-ie.min.css'));
            wp_enqueue_style('wpdiscuz-modal-css-ie');
        }

        wp_register_style('wpdiscuz-modal-box-css', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/third-party/modal-box/modal-box.min.css'));
        wp_enqueue_style('wpdiscuz-modal-box-css');

        wp_register_style('wpdiscuz-colorpicker-css', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/third-party/colorpicker/css/colorpicker.min.css'));
        wp_enqueue_style('wpdiscuz-colorpicker-css');

        wp_register_script('wpdiscuz-colorpicker-js', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/third-party/colorpicker/js/colorpicker.min.js'), array('jquery'), '2.0.0.9', false);
        wp_enqueue_script('wpdiscuz-colorpicker-js');

        wp_register_style('wpdiscuz-options-css', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/css/options-css.min.css'));
        wp_enqueue_style('wpdiscuz-options-css');

        wp_register_script('wpdiscuz-scripts-js', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/js/wc-scripts.min.js'), array('jquery'));
        wp_enqueue_script('wpdiscuz-scripts-js');

        wp_register_style('wpdiscuz-easy-responsive-tabs-css', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/third-party/easy-responsive-tabs/css/easy-responsive-tabs.min.css'), true);
        wp_enqueue_style('wpdiscuz-easy-responsive-tabs-css');

        wp_register_script('wpdiscuz-easy-responsive-tabs-js', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/third-party/easy-responsive-tabs/js/easy-responsive-tabs.min.js'), array('jquery'), '1.0.0', true);
        wp_enqueue_script('wpdiscuz-easy-responsive-tabs-js');
        wp_enqueue_script('thickbox');
    }

    /*
     * post comment via ajax
     */

    public function comment_submit_via_ajax() {
        $message_array = array();
        $comment_post_ID = intval(filter_input(INPUT_POST, 'comment_post_ID'));
        $comment_parent = intval(filter_input(INPUT_POST, 'comment_parent'));
        $comment_depth = intval(filter_input(INPUT_POST, 'comment_depth'));
        $is_in_same_container = 1;
        if ($comment_depth > $this->wc_options_serialized->wc_comments_max_depth) {
            $comment_depth = $this->wc_options_serialized->wc_comments_max_depth;
            $is_in_same_container = 0;
        }
        $notification_type = isset($_POST['notification_type']) ? $_POST['notification_type'] : '';


        if (!$this->wc_options_serialized->wc_captcha_show_hide) {
            if (!is_user_logged_in()) {
                $sess_captcha = $_SESSION['wc_captcha'][$comment_post_ID . '-' . $comment_parent];
                $captcha = filter_input(INPUT_POST, 'captcha');
                if (md5(strtolower($captcha)) !== $sess_captcha) {
                    $message_array['code'] = -1;
                    $message_array['message'] = $this->wc_options_serialized->wc_phrases['wc_invalid_captcha'];
                    echo json_encode($message_array);
                    exit;
                }
            }
        }
        $comment_content = filter_input(INPUT_POST, 'comment');
        $website_url = '';
        if (is_user_logged_in()) {
            $user_id = get_current_user_id();
            $user = get_userdata($user_id);
            $name = $user->display_name;
            $email = $user->user_email;
        } else {
            if ($this->wc_options_serialized->wc_is_name_field_required) {
                $name = filter_input(INPUT_POST, 'name');
            } else {
                $name = !(filter_input(INPUT_POST, 'name')) ? __('Anonymous', WC_Core::$TEXT_DOMAIN) : filter_input(INPUT_POST, 'name');
            }
            if ($this->wc_options_serialized->wc_is_email_field_required) {
                $email = filter_input(INPUT_POST, 'email');
            } else {
                $email = !(filter_input(INPUT_POST, 'email')) ? 'anonymous_' . md5(uniqid() . time()) . '@example.com' : filter_input(INPUT_POST, 'email');
            }
            $user_id = 0;
            $website_url = filter_input(INPUT_POST, 'website');
        }

        if ($website_url != '' && (strpos($website_url, 'http://') !== '' && strpos($website_url, 'http://') !== 0) && (strpos($website_url, 'https://') !== '' && strpos($website_url, 'https://') !== 0)) {
            $website_url = 'http://' . $website_url;
        }
        if ($website_url != '' && (filter_var($website_url, FILTER_VALIDATE_URL) === false)) {
            $message_array['code'] = -1;
            $message_array['message'] = $this->wc_options_serialized->wc_phrases['wc_error_url_text'];
            echo json_encode($message_array);
            exit;
        }

        $comment_content = wp_kses($comment_content, $this->wc_helper->wc_allowed_tags);
        $wc_comment_text_max_length = intval($this->wc_options_serialized->wc_comment_text_max_length);

        if ($wc_comment_text_max_length && $wc_comment_text_max_length > 0 && mb_strlen(trim($comment_content)) > $wc_comment_text_max_length) {
            $message_array['code'] = -1;
            $message_array['message'] = $this->wc_options_serialized->wc_phrases['wc_msg_comment_text_max_length'];
            echo json_encode($message_array);
            exit;
        }

        if ($name && filter_var($email, FILTER_VALIDATE_EMAIL) && $comment_content && filter_var($comment_post_ID)) {

            $author_ip = WC_Helper::get_real_ip_addr();

            $new_commentdata = array(
                'user_id' => $user_id,
                'comment_post_ID' => $comment_post_ID,
                'comment_parent' => $comment_parent,
                'comment_author' => $name,
                'comment_author_email' => $email,
                'comment_content' => $comment_content,
                'comment_author_url' => $website_url,
                'comment_author_IP' => $author_ip,
                'comment_agent' => $this->wc_user_agent
            );

            $new_comment_id = wp_new_comment($new_commentdata);
            $new_inserted_comment = get_comment($new_comment_id);
            $held_moderate = 1;
            if ($new_inserted_comment->comment_approved) {
                $held_moderate = 0;
            }
            $wc_notification_inserted_id = 0;
            if ($notification_type == 'post' && !$this->wc_db_helper->wc_has_post_notification($comment_post_ID, $email)) {
                if (class_exists('Prompt_Comment_Form_Handling') && $this->wc_options_serialized->wc_use_postmatic_for_comment_notification) {
                    $_POST[Prompt_Comment_Form_Handling::SUBSCRIBE_CHECKBOX_NAME] = 1;
                    Prompt_Comment_Form_Handling::handle_form($new_comment_id, $new_inserted_comment->comment_approved);
                } else {
                    $wc_notification_inserted_id = $this->wc_db_helper->wc_add_email_notification($comment_post_ID, $comment_post_ID, $email, 1);
                }
            } else if ($notification_type == 'all_comment' && !$this->wc_db_helper->wc_has_all_comments_notification($comment_post_ID, $email)) {
                $wc_notification_inserted_id = $this->wc_db_helper->wc_add_email_notification($comment_post_ID, $comment_post_ID, $email, 2);
            } else if ($notification_type == 'reply' && !$this->wc_db_helper->wc_has_comment_notification($comment_post_ID, $new_comment_id, $email)) {
                $wc_notification_inserted_id = $this->wc_db_helper->wc_add_email_notification($new_comment_id, $comment_post_ID, $email, 3);
            }

            if ($wc_notification_inserted_id) {
                $this->wc_confirm_email_sender($wc_notification_inserted_id, $email, $comment_post_ID, $new_comment_id, $notification_type);
            }

            $new_comment = get_comment($new_comment_id, OBJECT);
            if ($held_moderate) {
                $message_array['code'] = -2;
                $message_array['message'] = $this->wc_options_serialized->wc_phrases['wc_held_for_moderate'];
            } else {
                $message_array['code'] = 1;
                $message_array['message'] = $this->comment_tpl_builder->get_comment_template($new_comment, null, $comment_depth);
                $message_array['is_in_same_container'] = $is_in_same_container;
                $message_array['wc_all_comments_count_new'] = $this->wc_db_helper->get_comments_count($comment_post_ID, null, null);
            }
            $message_array['wc_new_comment_id'] = $new_comment_id;
        } else {
            $message_array['code'] = -1;
            $message_array['wc_new_comment_id'] = -1;
            $message_array['message'] = $this->wc_options_serialized->wc_phrases['wc_invalid_field'];
        }

        echo json_encode($message_array);
        exit;
    }

    /**
     * redirect first commenter to the selected page from options
     */
    public function wpdiscuz_comment_redirect() {
        $message_array = array();
        $wc_comment_id = intval(filter_input(INPUT_POST, 'wc_new_comment_id'));
        if ($wc_comment_id) {
            $comment = get_comment($wc_comment_id);
            if ($comment->comment_ID) {
                $wc_user_comment_count = get_comments(array('author_email' => $comment->comment_author_email, 'count' => true));
                if ($this->wc_options_serialized->wpdiscuz_redirect_page && $wc_user_comment_count == 1) {
                    $message_array['code'] = 1;
                    $message_array['redirect_to'] = get_permalink($this->wc_options_serialized->wpdiscuz_redirect_page);
                }
            }
        }
        echo json_encode($message_array);
        exit();
    }

    /**
     * vote on comment via ajax
     */
// MUST BE CHANGED IN NEXT VERSION OF PLUGIN
    public function vote_on_comment() {
        if ($this->wc_options_serialized->wc_voting_buttons_show_hide) {
            exit();
        }
        $a = get_locale();
        $this->wc_options_serialized->init_phrases_on_load();
        $messageArray = array();
        $messageArray['code'] = -1;
        $comment_id = '';
        if (!$this->wc_options_serialized->wc_is_guest_can_vote && !is_user_logged_in()) {
            $messageArray['message'] = $this->wc_options_serialized->wc_phrases['wc_login_to_vote'];
            echo json_encode($messageArray);
            exit();
        }
        if (isset($_POST['comment_ID']) && isset($_POST['vote_type']) && intval($_POST['comment_ID']) && intval($_POST['vote_type'])) {
            $comment_id = $_POST['comment_ID'];
            $user_id_or_ip = is_user_logged_in() ? get_current_user_id() : WC_Helper::get_real_ip_addr();
            $vote_type = $_POST['vote_type'];

            $is_user_voted = $this->wc_db_helper->is_user_voted($user_id_or_ip, $comment_id);
            $comment = get_comment($comment_id);
            if (!is_user_logged_in() && $comment->comment_author_IP == $user_id_or_ip) {
                $messageArray['message'] = $this->wc_options_serialized->wc_phrases['wc_deny_voting_from_same_ip'];
                echo json_encode($messageArray);
                exit();
            }
            if ($comment->user_id == $user_id_or_ip) {
                $messageArray['message'] = $this->wc_options_serialized->wc_phrases['wc_self_vote'];
                echo json_encode($messageArray);
                exit();
            }

            if ($is_user_voted != '') {
                $vote = intval($is_user_voted) + intval($vote_type);
                if ($vote >= -1 && $vote <= 1) {
                    $this->wc_db_helper->update_vote_type($user_id_or_ip, $comment_id, $vote);
                    $vote_count = intval(get_comment_meta($comment_id, 'wpdiscuz_votes', true)) + intval($vote_type);
                    update_comment_meta($comment_id, 'wpdiscuz_votes', '' . $vote_count);
                    $messageArray['code'] = 1;
                    $messageArray['message'] = $this->wc_options_serialized->wc_phrases['wc_vote_counted'];
                } else {
                    $messageArray['message'] = $this->wc_options_serialized->wc_phrases['wc_vote_only_one_time'];
                }
            } else {
                $this->wc_db_helper->add_vote_type($user_id_or_ip, $comment_id, $vote_type);
                $vote_count = get_comment_meta($comment_id, 'wpdiscuz_votes', true);
                if ($vote_count == '') {
                    add_comment_meta($comment_id, 'wpdiscuz_votes', '' . $vote_type);
                } else {
                    $vote_count = intval($vote_count) + intval($vote_type);
                    update_comment_meta($comment_id, 'wpdiscuz_votes', '' . $vote_count);
                }
                $messageArray['code'] = 1;
                $messageArray['message'] = $this->wc_options_serialized->wc_phrases['wc_vote_counted'];
            }
        } else {
            $messageArray['message'] = $this->wc_options_serialized->wc_phrases['wc_voting_error'];
        }

        echo json_encode($messageArray);
        exit();
    }

// MUST BE CHANGED IN NEXT VERSION OF PLUGIN
    public function live_update() {
        global $current_user;
        get_currentuserinfo();
        $message_array = array();
        $wc_post_id = isset($_POST['wc_post_id']) ? intval($_POST['wc_post_id']) : 0;
        $wc_comment_list_update_type = $this->wc_options_serialized->wc_comment_list_update_type;

        $wc_all_new_comments_count = $this->wc_db_helper->get_comments_count($wc_post_id, null, null);
        $wc_last_comment_id = isset($_POST['wc_last_comment_id']) ? intval($_POST['wc_last_comment_id']) : 0;
        $wc_last_new_comment_id = isset($_POST['wc_last_new_comment_id']) ? intval($_POST['wc_last_new_comment_id']) : 0;
        $wc_last_new_reply_id = isset($_POST['wc_last_new_reply_id']) ? intval($_POST['wc_last_new_reply_id']) : 0;

        if (is_user_logged_in()) {
            $wc_author_email = $current_user->user_email;
        } else {
            $wc_author_email = isset($_POST['wc_author_email']) ? $_POST['wc_author_email'] : '';
        }

        $c_offset = intval($_POST['wc_comments_offset']);
        $c_offset = ($c_offset) ? $c_offset : 1;
        $wc_curr_user_comment_count = isset($_POST['wc_curr_user_comment_count']) ? $_POST['wc_curr_user_comment_count'] : 0;
        $wc_limit = $c_offset * $this->wc_options_serialized->wc_comment_count + $wc_curr_user_comment_count;
        $wc_new_comments = $this->wc_db_helper->wc_get_new_comments($wc_post_id, $wc_last_comment_id, $wc_author_email);

        $wc_visible_parent_comment_ids = $this->wc_db_helper->wc_get_visible_parent_comment_ids($wc_post_id, $wc_limit);
        $wc_hidden_new_comment_data = $this->get_invisible_comment_count($wc_new_comments, $wc_author_email, $wc_visible_parent_comment_ids, $wc_last_new_comment_id, $wc_last_new_reply_id);
        $wc_hidden_new_comment_count = $wc_hidden_new_comment_data['new_comments_count'];

        if ($wc_new_comments) {
            if ($wc_comment_list_update_type == 1) {

                $wc_wp_comments = $this->get_wp_comments($c_offset, $wc_post_id, $wc_curr_user_comment_count, $wc_hidden_new_comment_count);
                $message_array['code'] = 1;
                $message_array['wc_last_comment_id'] = $this->wc_db_helper->get_last_comment_id_by_post_id($wc_post_id);
                $message_array['message'] = $wc_wp_comments['wc_list'];
                $message_array['wc_all_comments_count_new'] = $wc_all_new_comments_count;
            } else if ($wc_comment_list_update_type == 2) {

                $wc_user_comments_replies_count = count($wc_hidden_new_comment_data['wc_new_replies_ids']);
                $wc_all_new_comments_count = count($wc_hidden_new_comment_data['wc_new_comments_ids']);
                $wc_all_new_comments_count_text = ($wc_all_new_comments_count > 1) ? $this->wc_options_serialized->wc_phrases['wc_new_comments_button_text'] : $this->wc_options_serialized->wc_phrases['wc_new_comment_button_text'];
                $wc_user_comments_replies_count_text = ($wc_user_comments_replies_count > 1) ? $this->wc_options_serialized->wc_phrases['wc_new_replies_button_text'] : $this->wc_options_serialized->wc_phrases['wc_new_reply_button_text'];

                $message_array['code'] = 2;
                $message_array['wc_new_comment_button_text'] = $wc_all_new_comments_count_text;
                $message_array['wc_new_comment_count'] = $wc_all_new_comments_count;
                $message_array['wc_new_reply_button_text'] = $wc_user_comments_replies_count_text;
                $message_array['wc_new_reply_count'] = $wc_user_comments_replies_count;
            }
        } else {
            $message_array['code'] = 2;
            $message_array['wc_new_comment_count'] = 0;
            $message_array['wc_new_reply_count'] = 0;
        }
        echo json_encode($message_array);
        exit();
    }

    /**
     * list new comments 
     */
// MUST BE CHANGED IN NEXT VERSION OF PLUGIN
    public function wc_list_new_comments() {
        global $current_user;
        get_currentuserinfo();
        $message_array = array();
        $wc_post_id = isset($_POST['wc_post_id']) ? intval($_POST['wc_post_id']) : 0;
        $wc_last_comment_id = isset($_POST['wc_last_comment_id']) ? intval($_POST['wc_last_comment_id']) : 0;
        $wc_requested_comments_type = isset($_POST['wc_requested_comments_type']) ? intval($_POST['wc_requested_comments_type']) : 0;
        $wc_curr_user_comment_count = isset($_POST['wc_curr_user_comment_count']) ? intval($_POST['wc_curr_user_comment_count']) : 0;
        $wc_comments_offset = isset($_POST['wc_comments_offset']) ? $_POST['wc_comments_offset'] : 1;
        $wc_limit = $wc_comments_offset * $this->wc_options_serialized->wc_comment_count + $wc_curr_user_comment_count;
        $wc_comments_max_depth = $this->wc_options_serialized->wc_comments_max_depth ? $this->wc_options_serialized->wc_comments_max_depth : 2;

        $wc_new_comments_ids = array();
        if (is_user_logged_in()) {
            $wc_author_email = $current_user->user_email;
        } else {
            $wc_author_email = isset($_POST['wc_author_email']) ? $_POST['wc_author_email'] : '';
        }

        $wc_visible_comment_ids = isset($_POST['wc_visible_comments_ids']) ? $_POST['wc_visible_comments_ids'] : '';
        $wc_visible_parent_comment_ids = array_filter(explode(',', $wc_visible_comment_ids));

        $wc_new_comments = $this->wc_db_helper->wc_get_new_comments($wc_post_id, $wc_last_comment_id, $wc_author_email);

        $wc_new_comments = $this->get_invisible_comment_count($wc_new_comments, $wc_author_email, $wc_visible_parent_comment_ids, $wc_last_comment_id, $wc_last_comment_id);
        if ($wc_requested_comments_type == 1) {
            $message_array['code'] = 1;
            $wc_new_comments_ids = $wc_new_comments['wc_new_comments_ids'];
        } elseif ($wc_requested_comments_type == 2) {
            $message_array['code'] = 2;
            $wc_new_comments_ids = $wc_new_comments['wc_new_replies_ids'];
        } else {
            $message_array['code'] = 0;
        }

        if ($message_array['code'] != 0) {
            $wc_parent_comments = array();

            if (count($wc_visible_parent_comment_ids)) {
                foreach ($wc_visible_parent_comment_ids as $wc_visible_parent_comment_id) {
                    $wc_vpcommid = $wc_visible_parent_comment_id;
                    $parent_comment = get_comment($wc_vpcommid);
                    if (!$parent_comment->comment_parent) {
                        $wc_parent_comments[] = $parent_comment;
                    }
                }
            }

            foreach ($wc_new_comments_ids as $wc_new_comment_id) {
                $parent_comment = WC_Helper::get_comment_root_id($wc_new_comment_id);
                if (!in_array($parent_comment, $wc_parent_comments)) {
                    $wc_parent_comments[] = $parent_comment;
                }
            }

            $comm_list_args = array(
                'callback' => array(&$this, 'wc_comment_callback'),
                'style' => 'div',
                'per_page' => -1,
                'max_depth' => $wc_comments_max_depth,
                'reverse_top_level' => false,
                'echo' => false,
                'page' => 1,
                'wc_visible_parent_comment_ids' => $wc_visible_parent_comment_ids
            );

            $wc_child_comments = array();
            $wc_parent_comments = $this->wc_helper->wc_sort_parent_comments($wc_parent_comments);

            if ($this->wc_options_serialized->wc_comment_list_order === 'desc') {
                $wc_parent_comments = array_reverse($wc_parent_comments);
            }

            $wc_parent_comments = $this->get_comments_tree($wc_parent_comments, $wc_child_comments);
            $this->init_wc_comments($wc_parent_comments);
            $message_array['wc_last_comment_id'] = max($wc_new_comments_ids);
            $message_array['message'] = wp_list_comments($comm_list_args, $wc_parent_comments);
            $wc_post_parent_comments_count = $this->wc_db_helper->get_post_parent_comments_count($wc_post_id);

            if ($wc_post_parent_comments_count > $this->wc_options_serialized->wc_comment_count * $wc_comments_offset + $wc_curr_user_comment_count) {

                $unique_id = $wc_post_id . '_' . 0;
                $load_more_button_text = ($this->wc_options_serialized->wc_load_all_comments) ? $this->wc_options_serialized->wc_phrases['wc_load_rest_comments_submit_text'] : $this->wc_options_serialized->wc_phrases['wc_load_more_submit_text'];
                $load_more = '<div class="wc-load-more-submit-wrap">';
                $load_more .= '<button name="submit" id="wc-load-more-submit-' . $unique_id . '" class="wc-load-more-submit button">';
                $load_more .= $load_more_button_text;
                $load_more .= '</button>';
                $load_more .= '</div>';
                $message_array['message'] .= $load_more;
            }
        }
        echo json_encode($message_array);
        exit();
    }

    /**
     * recursively get new comments tree
     */
    public function get_comments_tree($wc_parent_comments, &$wc_child_comments) {
        if (!$wc_parent_comments) {
            return $wc_child_comments;
        }
        $child_comments = array();
        foreach ($wc_parent_comments as $parent_comment) {
            $child_comments = get_comments(array('parent' => $parent_comment->comment_ID, 'order' => $wc_comment_list_order = $this->wc_options_serialized->wc_comment_list_order));
            if (!$this->has_comment($wc_child_comments, $parent_comment)) {
                $wc_child_comments[] = $parent_comment;
            }
            foreach ($child_comments as $child_comment) {
                if (!$this->has_comment($wc_child_comments, $child_comment)) {
                    $wc_child_comments[] = $child_comment;
                }
            }
            if ($child_comments) {
                $this->get_comments_tree($child_comments, $wc_child_comments);
            }
        }
        return $this->get_comments_tree($child_comments, $wc_child_comments);
    }

    public function has_comment($comments, $comment) {
        foreach ($comments as $c) {
            if ($c->comment_ID == $comment->comment_ID)
                return true;
        }
        return false;
    }

// MUST BE CHANGED IN NEXT VERSION OF PLUGIN
    public function get_invisible_comment_count($wc_new_comments, $wc_author_email = null, $visible_parent_comment_ids = array(), $wc_last_new_comment_id = 0, $wc_last_new_reply_id = 0) {
        $wc_new_comments_data = array();
        $wc_new_comments_count = 0;
        $wc_visible_parent_comment_ids = $visible_parent_comment_ids;
        $wc_visible_pcomment_ids = WC_Helper::wc_get_array($wc_visible_parent_comment_ids);

        $wc_new_comments_data['wc_new_comments_ids'] = array();
        $wc_new_comments_data['wc_new_replies_ids'] = array();
        $wc_new_comments_data['last_comment_id'] = 0;

        foreach ($wc_new_comments as $wc_new_comment) {
            $cid = $wc_new_comment['comment_id']; // new comment id
            $cpid = $wc_new_comment['comment_parent']; // new comment parent id
            $parent_comment = WC_Helper::get_comment_root_id($cid);
            $pid = $parent_comment->comment_ID;
            if (!(in_array($pid, $wc_visible_pcomment_ids))) {
                $wc_new_comments_count++;
            } else {
                if ($wc_new_comments_data['last_comment_id'] < $cid && $cid != 0) {
                    $wc_new_comments_data['last_comment_id'] = $cid;
                }
            }

            if ($cpid) {
                $current_new_comment_parent = get_comment($cpid);
                $current_new_comment_author_email = $current_new_comment_parent->comment_author_email;
            } else {
                $current_new_comment_author_email = '';
            }

            if ($cid > $wc_last_new_comment_id && $wc_author_email != $current_new_comment_author_email || !$wc_author_email) {
                $wc_new_comments_data['wc_new_comments_ids'][] = $cid;
            }

            if ($cid > $wc_last_new_reply_id && $wc_author_email == $current_new_comment_author_email) {
                $wc_new_comments_data['wc_new_replies_ids'][] = $cid;
            }
        }
        $wc_new_comments_data['new_comments_count'] = $wc_new_comments_count;
        return $wc_new_comments_data;
    }

    /**
     * get comments by comment type
     */
// MUST BE CHANGED IN NEXT VERSION OF PLUGIN
    public function get_wp_comments($comments_offset, $post_id = null, $wc_curr_user_comment_count = 0, $wc_hidden_new_comment_count = 0) {
        global $post;
        $this->wc_options_serialized->init_phrases_on_load();
        if (!$post_id) {
            $post_id = $post->ID;
        }
        $wc_comment_count = $this->wc_options_serialized->wc_comment_count;
        $wc_comment_list_order = $this->wc_options_serialized->wc_comment_list_order;
        $wc_comments_max_depth = $this->wc_options_serialized->wc_comments_max_depth ? $this->wc_options_serialized->wc_comments_max_depth : 2;

        $comm_list_args = array(
            'callback' => array(&$this, 'wc_comment_callback'),
            'style' => 'div',
            'per_page' => $comments_offset ? $comments_offset * $wc_comment_count + $wc_curr_user_comment_count : '',
            'max_depth' => $wc_comments_max_depth,
            'reverse_top_level' => false,
            'page' => 1,
            'echo' => false
        );

        $wc_wp_comments = array();
        $comments = get_comments(array('post_id' => $post_id, 'status' => 'approve', 'order' => $wc_comment_list_order));
        $this->init_wc_comments($comments);
        $wc_wp_comments['wc_list'] = wp_list_comments($comm_list_args, $comments);
        $wc_button_comments_count_style = $wc_hidden_new_comment_count > 0 ? "inline-block" : "none";

        if ($this->wc_parent_comments_count > $this->wc_options_serialized->wc_comment_count * $comments_offset + $wc_curr_user_comment_count && $comments_offset) {

            $unique_id = $post_id . '_' . 0;
            $load_more = '<div class="wc-load-more-submit-wrap">';
            $load_more .= '<button name="submit" id="wc-load-more-submit-' . $unique_id . '" class="wc-load-more-submit button">';
            $load_more_button_text = ($this->wc_options_serialized->wc_load_all_comments) ? $this->wc_options_serialized->wc_phrases['wc_load_rest_comments_submit_text'] : $this->wc_options_serialized->wc_phrases['wc_load_more_submit_text'];
            $load_more .= $load_more_button_text;
            if ($this->wc_options_serialized->wc_comment_list_update_type == 1) {
                $load_more .= '<span style="display:' . $wc_button_comments_count_style . ';" id="wc_button_new_comments_text" class="wc_button_new_comments_text">&nbsp;&nbsp;-&nbsp;&nbsp;' . $this->wc_options_serialized->wc_phrases['wc_new_comments_text'] . ' : ';
                $load_more .= '<span id="wc_button_new_comments_count" class="wc_button_new_comments_count">' . $wc_hidden_new_comment_count . '</span></span>';
            }
            $load_more .= '</button>';
            $load_more .= '</div>';
            $wc_wp_comments['wc_list'] .= $load_more;
        }

        $wc_wp_comments['wc_parent_comments_count'] = $this->wc_parent_comments_count + $wc_curr_user_comment_count;
        return $wc_wp_comments;
    }

    /**
     * load more comments by offset
     */
// MUST BE CHANGED IN NEXT VERSION OF PLUGIN
    public function load_more_comments() {
        $c_offset = intval($_POST['comments_offset']);
        $c_offset = ($c_offset) ? $c_offset : 1;
        if ($this->wc_options_serialized->wc_load_all_comments) {
            $c_offset = '';
        }
        $post_id = intval($_POST['wc_post_id']);
        $message_array = array();
        if ($post_id) {
            $this->wc_helper->get_comment_author_avatar();
            $wc_limit = $c_offset ? $c_offset * $this->wc_options_serialized->wc_comment_count : $this->wc_db_helper->get_comments_count($post_id);
            $wc_last_comment_id = isset($_POST['wc_last_comment_id']) ? $_POST['wc_last_comment_id'] : 0;
            $wc_curr_user_comment_count = isset($_POST['wc_curr_user_comment_count']) ? $_POST['wc_curr_user_comment_count'] : 0;
            $wc_new_comments = $this->wc_db_helper->wc_get_new_comments($post_id, $wc_last_comment_id);
            $wc_visible_parent_comment_ids = $this->wc_db_helper->wc_get_visible_parent_comment_ids($post_id, $wc_limit);
            $wc_hidden_new_comment_data = $this->get_invisible_comment_count($wc_new_comments, null, $wc_visible_parent_comment_ids);

            $message_array['code'] = 1;
            if ($this->wc_options_serialized->wc_comment_list_update_type == 2) {
                $message_array['wc_last_comment_id'] = ($wc_hidden_new_comment_data['last_comment_id']) ? $wc_hidden_new_comment_data['last_comment_id'] : $wc_last_comment_id;
            } else {
                $message_array['wc_last_comment_id'] = $this->wc_db_helper->get_last_comment_id_by_post_id($post_id);
            }

            $wc_hidden_new_comment_count = $wc_hidden_new_comment_data['new_comments_count'];
            $wc_wp_comments = $this->get_wp_comments($c_offset, $post_id, $wc_curr_user_comment_count, $wc_hidden_new_comment_count);
            $message_array['message'] = $wc_wp_comments['wc_list'];
        }
        echo json_encode($message_array);
        exit();
    }

    /**
     * initialize WPC comments 
     */
    public function init_wc_comments($comments) {
        if ($comments) {
            foreach ($comments as $comment) {
                if (!$comment->comment_parent) {
                    $this->wc_parent_comments_count++;
                }
            }
        }
    }

    public function wc_comment_callback($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        echo $this->comment_tpl_builder->get_comment_template($comment, $args, $depth);
    }

    public function is_guest_can_comment() {
        $user_can_comment = TRUE;
        if ($this->wc_options_serialized->wc_user_must_be_registered) {
            if (!is_user_logged_in()) {
                $user_can_comment = FALSE;
            }
        }
        return $user_can_comment;
    }

    public function init_plugin_dir_name() {
        $plugin_dir_path = plugin_dir_path(__FILE__);
        $path_array = array_values(array_filter(explode(DIRECTORY_SEPARATOR, $plugin_dir_path)));
        $path_last_part = $path_array[count($path_array) - 1];
        WC_Core::$PLUGIN_DIRECTORY = untrailingslashit($path_last_part);
    }

    public function init_current_post_type() {
        global $post;
        if ($post && in_array($post->post_type, $this->wc_options_serialized->wc_post_types) && is_singular()) {
            add_filter('comments_template', array(&$this, 'remove_comments_template_on_pages'), 10);
        }
    }

    public function remove_comments_template_on_pages($file) {
        $file = dirname(__FILE__) . '/comment-form/form.php';
        return $file;
    }

    /**
     * Check notification type and send email to post new comments subscribers
     */
    public function wc_check_notification_type() {
        $comment_id = intval($_POST['wc_comment_id']);
        $post_id = intval($_POST['wc_post_id']);
        $notification_type = isset($_POST['wc_notifcattion_type']) ? $_POST['wc_notifcattion_type'] : '';
        $current_user = wp_get_current_user();


        if ($current_user->user_email) {
            $email = $current_user->user_email;
        } else {
            $email = isset($_POST['wc_email']) ? $_POST['wc_email'] : '';
        }

        if ($comment_id && $email && $post_id) {
            $comment = get_comment($comment_id);
            $parent_comment_id = $comment->comment_parent;
            if ($comment->comment_approved) {
                $this->wc_notify_on_new_comments($post_id, $comment_id, $email);
            }
            if ($comment->comment_approved && $parent_comment_id) {
                $this->wc_notify_on_new_reply($parent_comment_id, $comment->comment_ID, $email);
                $parent_comment = get_comment($parent_comment_id);
                $parent_comment_email = $parent_comment->comment_author_email;
                if ($parent_comment_email != $email) {
                    $this->wc_notify_on_all_new_reply($post_id, $comment_id, $parent_comment_email);
                }
            }
        }
        exit();
    }

    /**
     * notify on new comments
     */
    public function wc_notify_on_new_comments($post_id, $comment_id, $email) {
        $emails_array = $this->wc_db_helper->wc_get_post_new_comment_notification($post_id, $email);
        $subject = ($this->wc_options_serialized->wc_phrases['wc_email_subject']) ? $this->wc_options_serialized->wc_phrases['wc_email_subject'] : 'New Comment';
        $message = ($this->wc_options_serialized->wc_phrases['wc_email_message']) ? $this->wc_options_serialized->wc_phrases['wc_email_message'] : 'New comment on the discussion section you\'ve been interested in';
        foreach ($emails_array as $e_row) {
            $this->wc_email_sender($e_row, $comment_id, $subject, $message);
        }
    }

    /**
     * notify on comment new replies
     */
    public function wc_notify_on_all_new_reply($post_id, $new_comment_id, $email) {
        $emails_array = $this->wc_db_helper->wc_get_post_all_new_comment_notification($post_id, $email);
        $subject = ($this->wc_options_serialized->wc_phrases['wc_new_reply_email_subject']) ? $this->wc_options_serialized->wc_phrases['wc_new_reply_email_subject'] : 'New Reply';
        $message = ($this->wc_options_serialized->wc_phrases['wc_new_reply_email_message']) ? $this->wc_options_serialized->wc_phrases['wc_new_reply_email_message'] : 'New reply on the discussion section you\'ve been interested in';
        foreach ($emails_array as $e_row) {
            $this->wc_email_sender($e_row, $new_comment_id, $subject, $message);
        }
    }

    /**
     * notify on comment new replies
     */
    public function wc_notify_on_new_reply($parent_comment_id, $new_comment_id, $email) {
        $emails_array = $this->wc_db_helper->wc_get_post_new_reply_notification($parent_comment_id, $email);
        $subject = ($this->wc_options_serialized->wc_phrases['wc_new_reply_email_subject']) ? $this->wc_options_serialized->wc_phrases['wc_new_reply_email_subject'] : 'New Reply';
        $message = ($this->wc_options_serialized->wc_phrases['wc_new_reply_email_message']) ? $this->wc_options_serialized->wc_phrases['wc_new_reply_email_message'] : 'New reply on the discussion section you\'ve been interested in';
        foreach ($emails_array as $e_row) {
            $this->wc_email_sender($e_row, $new_comment_id, $subject, $message);
        }
    }

    public function wc_confirm_email_sender($subscrib_id, $email, $post_id, $new_comment_id, $subscribtion_type) {
        $curr_post = get_post($post_id);
        $curr_post_author = get_userdata($curr_post->post_author);

        $subject = isset($this->wc_options_serialized->wc_phrases['wc_confirm_email_subject']) ? $this->wc_options_serialized->wc_phrases['wc_confirm_email_subject'] : __('Subscribe Confirmation', WC_Core::$TEXT_DOMAIN);
        $message = isset($this->wc_options_serialized->wc_phrases['wc_confirm_email_message']) ? $this->wc_options_serialized->wc_phrases['wc_confirm_email_message'] : __('Hi, <br/> You just subscribed for new comments on our website. This means you will receive an email when new comments are posted according to subscription option you\'ve chosen. <br/> To activate, click confirm below. If you believe this is an error, ignore this message and we\'ll never bother you again.', WC_Core::$TEXT_DOMAIN);

        if ($subscribtion_type == 'post' || $subscribtion_type = '') {
            $comment_or_post_subscrib_id = $post_id;
        } else {
            $comment_or_post_subscrib_id = $new_comment_id;
        }
        $confirm_url = $this->wc_db_helper->wc_confirm_link($subscrib_id);
        $unsubscribe_url = $this->wc_db_helper->wc_unsubscribe_link($comment_or_post_subscrib_id, $email, $subscribtion_type);
        $post_permalink = get_permalink($post_id);
        $message .= "<br/><br/><a href='$post_permalink'>$post_permalink</a>";
        $message .= "<br/><br/><a href='$confirm_url'>" . $this->wc_options_serialized->wc_phrases['wc_confirm_email'] . "</a>";
        $message .= "<br/><br/><a href='$unsubscribe_url'>" . $this->wc_options_serialized->wc_phrases['wc_ignore_subscription'] . "</a>";
        $headers = array();
        $content_type = apply_filters('wp_mail_content_type', 'text/html');
        $from_name = apply_filters('wp_mail_from_name', get_bloginfo('name'));
        $headers[] = "Content-Type:  $content_type; charset=UTF-8";
        $headers[] = "From: " . $from_name . "\r\n";
        wp_mail($email, $subject, $message, $headers);
    }

    /**
     * send email
     */
    public function wc_email_sender($email_data, $wc_new_comment_id, $subject, $message) {
        $comment = get_comment($wc_new_comment_id);
        $curr_post = get_post($comment->comment_post_ID);
        $curr_post_author = get_userdata($curr_post->post_author);

        if ($email_data['email'] == $curr_post_author->user_email) {
            if (get_option('moderation_notify') && !$comment->comment_approved) {
                return;
            } else if (get_option('comments_notify') && $comment->comment_approved) {
                return;
            }
        }

        $wc_new_comment_content = $comment->comment_content;
        $permalink = get_comment_link($wc_new_comment_id);
        $unsubscribe_url = get_permalink($comment->comment_post_ID) . "?wpdiscuzSubscribeID=" . $email_data['id'] . "&key=" . $email_data['activation_key'] . '&#wc_unsubscribe_message';
        $message .= "<br/><br/><a href='$permalink'>$permalink</a>";
        $message .= "<br/><br/>$wc_new_comment_content";
        $message .= "<br/><br/><a href='$unsubscribe_url'>" . $this->wc_options_serialized->wc_phrases['wc_unsubscribe'] . "</a>";
        $headers = array();
        $content_type = apply_filters('wp_mail_content_type', 'text/html');
        $from_name = apply_filters('wp_mail_from_name', get_bloginfo('name'));
        $headers[] = "Content-Type:  $content_type; charset=UTF-8";
        $headers[] = "From: " . $from_name . "\r\n";
        wp_mail($email_data['email'], $subject, $message, $headers);
    }

    public function wc_notify_to_subscriber($new_status, $old_status, $comment) {
        if ($old_status != $new_status) {
            if ($new_status == 'approved') {
                $post_id = $comment->comment_post_ID;
                $comment_id = $comment->comment_ID;
                $email = $comment->comment_author_email;
                $parent_comment = get_comment($comment->comment_parent);
                $this->wc_notify_on_new_comments($post_id, $comment_id, $email);
                if ($parent_comment) {
                    $this->wc_notify_on_new_reply($parent_comment->comment_ID, $comment_id, $email);
                    $parent_comment_email = $parent_comment->comment_author_email;
                    if ($parent_comment_email != $email) {
                        $this->wc_notify_on_all_new_reply($post_id, $comment_id, $parent_comment_email);
                    }
                }
            }
        }
    }

    public function wc_unsubscribe($id, $activation_key) {
        $this->wc_db_helper->wc_unsubscribe($id, $activation_key);
    }

// Add settings link on plugin page
    public function wc_add_plugin_settings_link($links) {
        $settings_link = '<a href="' . admin_url() . 'admin.php?page=wpdiscuz_options_page">' . __('Settings', WC_Core::$TEXT_DOMAIN) . '</a>';
        if (!$this->wc_options_serialized->wc_is_use_po_mo) {
            $settings_link .= ' | <a href="' . admin_url() . 'admin.php?page=wpdiscuz_phrases_page">' . __('Phrases', WC_Core::$TEXT_DOMAIN) . '</a>';
        }
        array_unshift($links, $settings_link);
        return $links;
    }

    /**
     * get comment text from db
     */
    public function wc_get_editable_comment_content() {
        $current_user = wp_get_current_user();
        $message_array = array();
        $comment_ID = intval(filter_input(INPUT_POST, 'comment_id'));
        if ($comment_ID) {
            $comment = get_comment($comment_ID);
            if (isset($current_user) && $comment->user_id == $current_user->ID && $this->wc_helper->is_comment_editable($comment)) {
                $message_array['code'] = 1;
                $message_array['message'] = $comment->comment_content;
            } else {
                $message_array['code'] = -1;
                $message_array['phrase_message'] = $this->wc_options_serialized->wc_phrases['wc_comment_edit_not_possible'];
            }
        } else {
            $message_array['code'] = -1;
            $message_array['phrase_message'] = $this->wc_options_serialized->wc_phrases['wc_comment_edit_not_possible'];
        }
        echo json_encode($message_array);
        exit();
    }

    /**
     * save edited comment via ajax
     */
    public function wc_save_edited_comment() {
        $message_array = array();
        $comment_ID = intval(filter_input(INPUT_POST, 'comment_id'));
        $comment_content = filter_input(INPUT_POST, 'comment_content');
        $comment = get_comment($comment_ID);
        $current_user = wp_get_current_user();
        $trimmed_comment_content = trim($comment_content);
        // Change messages in next version - shoud be diff. messages for each specific error
        if ($trimmed_comment_content && isset($current_user) && $comment->user_id == $current_user->ID) {
            if ($trimmed_comment_content != $comment->comment_content) {
                $comment_content = wp_kses($comment_content, $this->wc_helper->wc_allowed_tags);

                $author_ip = WC_Helper::get_real_ip_addr();
                $this->wc_user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
                $commentarr = array(
                    'comment_ID' => $comment_ID,
                    'comment_content' => apply_filters('pre_comment_content', $comment_content),
                    'comment_author_IP' => apply_filters('pre_comment_user_ip', $author_ip),
                    'comment_agent' => apply_filters('pre_comment_user_agent', $this->wc_user_agent),
                    'comment_approved' => $comment->comment_approved
                );
                if (wp_update_comment($commentarr)) {
                    $message_array['code'] = 1;
                    $message_array['message'] = $this->wc_helper->make_clickable($comment_content);
                } else {
                    $message_array['code'] = -1;
                    $message_array['phrase_message'] = $this->wc_options_serialized->wc_phrases['wc_comment_not_updated'];
                }
            } else {
                $message_array['code'] = -2;
                $message_array['phrase_message'] = $this->wc_options_serialized->wc_phrases['wc_comment_not_edited'];
            }
        } else {
            $message_array['code'] = -1;
            $message_array['phrase_message'] = $this->wc_options_serialized->wc_phrases['wc_comment_edit_not_possible'];
        }

        echo json_encode($message_array);
        exit;
    }

}

$wc_core = new WC_Core();
?>