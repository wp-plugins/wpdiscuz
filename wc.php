<?php

/*
  Plugin Name: wpDiscuz - Wordpress Comments
  Description: Better comment system. Wordpress post comments and discussion plugin. Allows your visitors discuss, vote for comments and share.
  Version: 1.0.9
  Author: gVectors Team (A. Chakhoyan, G. Zakaryan, H. Martirosyan)
  Author URI: http://www.gvectors.com/
  Plugin URI: http://www.gvectors.com/wpdiscuz/
 */

include_once 'wc-options.php';
include_once 'helper/wc-helper.php';
include_once 'includes/wc-db-helper.php';
include_once 'comment-form/tpl-comment.php';
include_once 'dto/wc-comment.php';
include_once 'wc-css.php';

class WC_Core {

    public $wc_options;
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
    public $post_type;

    function __construct() {
        add_action('init', array(&$this, 'init_plugin_dir_name'), 1);

        $this->wc_options = new WC_Options();
        $this->wc_db_helper = $this->wc_options->wc_db_helper;

        register_activation_hook(__FILE__, array($this, 'db_operations'));


        $this->wc_helper = new WC_Helper($this->wc_options->wc_options_serialized);
        $this->wc_css = new WC_CSS($this->wc_options);
        $this->comment_tpl_builder = new WC_Comment_Template_Builder($this->wc_helper, $this->wc_db_helper, $this->wc_options);

        add_action('init', array(&$this, 'register_session'), 2);

        add_action('admin_enqueue_scripts', array(&$this, 'admin_page_styles_scripts'), 2315);
        add_action('wp_enqueue_scripts', array(&$this, 'front_end_styles_scripts'));
        add_action('wp_enqueue_scripts', array(&$this->wc_css, 'init_styles'));

        add_action('admin_menu', array(&$this, 'add_plugin_options_page'), -191);

        add_action('wp_ajax_wc_comms_via_ajax', array(&$this, 'comment_submit_via_ajax'));
        add_action('wp_ajax_nopriv_wc_comms_via_ajax', array(&$this, 'comment_submit_via_ajax'));

        add_action('wp_ajax_wc_load_more_comments', array(&$this, 'load_more_comments'));
        add_action('wp_ajax_nopriv_wc_load_more_comments', array(&$this, 'load_more_comments'));

        add_action('wp_ajax_wc_vote_via_ajax', array(&$this, 'vote_on_comment'));
        add_action('wp_ajax_nopriv_wc_vote_via_ajax', array(&$this, 'vote_on_comment'));

        add_action('wp_ajax_email_notification', array(&$this, 'email_notification'));
        add_action('wp_ajax_nopriv_email_notification', array(&$this, 'email_notification'));
        add_filter('preprocess_comment', array(&$this, 'wc_new_comment'));

        add_action('wp_head', array(&$this, 'init_current_post_type'));
    }

    /**
     * create table
     * updates the comments to set comment type review if comment id is exists in comment meta table
     */
    public function db_operations() {
        $this->wc_db_helper->create_tables();
    }

    /*
     * register new session
     */

    public function register_session() {
        if (!session_id()) {
            @session_start();
        }
    }

    /**
     * change comment type 
     */
    public function wc_new_comment($commentdata) {

        $commentdata['comment_type'] = isset($commentdata['comment_type']) ? $commentdata['comment_type'] : '';
        $comment_post = get_post($commentdata['comment_post_ID']);
        if ($comment_post->post_type === 'product' && $commentdata['comment_type'] != 'wpdiscuz') {
            $com_parent = $commentdata['comment_parent'];
            if ($com_parent != 0) {
                $parent_comment = get_comment($com_parent);
                if ($parent_comment->comment_type == 'wpdiscuz') {
                    $commentdata['comment_type'] = 'wpdiscuz';
                } else {
                    $commentdata['comment_type'] = 'wpdiscuz_review';
                }
            } else {
                $commentdata['comment_type'] = 'wpdiscuz_review';
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
            add_submenu_page('wpdiscuz_options_page', 'Phrases', 'Phrases', 'manage_options', 'wpdiscuz_phrases_page', array(&$this->wc_options, 'phrases_options_form'));
        }
    }

    /**
     * Styles and scripts registration to use on front page
     */
    public function front_end_styles_scripts() {


        $u_agent = $_SERVER['HTTP_USER_AGENT'];

        if (preg_match('/MSIE/i', $u_agent)) {
            wp_enqueue_script('wc-html5-js', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/third-party/tooltipster/js/html5.js'), array('jquery'), '1.2', false);

            wp_register_style('modal-css-ie', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/third-party/modal-box/modal-box-ie.css'));
            wp_enqueue_style('modal-css-ie');
        }

        wp_register_style('modal-box-css', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/third-party/modal-box/modal-box.css'));
        wp_enqueue_style('modal-box-css');

        wp_enqueue_script('form-validator-js', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/js/validator.js'), array('jquery'), '1.0.0', false);

        wp_register_style('validator-style', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/css/fv.css'));
        wp_enqueue_style('validator-style');

        wp_enqueue_script('wc-ajax-js', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/js/wc-ajax.js'), array('jquery'), '1.0.8', false);
        wp_localize_script('wc-ajax-js', 'wc_ajax_obj', array('url' => admin_url('admin-ajax.php')));

        wp_enqueue_script('wc-cookie-js', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/js/jquery.cookie.js'), array('jquery'), '1.4.1', false);

        wp_register_style('wc-tooltipster-style', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/third-party/tooltipster/css/tooltipster.css'));
        wp_enqueue_style('wc-tooltipster-style');

        wp_enqueue_script('wc-tooltipster-js', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/third-party/tooltipster/js/jquery.tooltipster.min.js'), array('jquery'), '1.2', false);

        wp_enqueue_script('autogrowtextarea-js', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/js/jquery.autogrowtextarea.min.js'), array('jquery'), '3.0', false);
    }

    /**
     * Scripts and styles registration on administration pages
     */
    public function admin_page_styles_scripts() {

        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        if (preg_match('/MSIE/i', $u_agent)) {
            wp_register_style('modal-css-ie', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/third-party/modal-box/modal-box-ie.css'));
            wp_enqueue_style('modal-css-ie');
        }

        wp_register_style('modal-box-css', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/third-party/modal-box/modal-box.css'));
        wp_enqueue_style('modal-box-css');

        wp_register_style('colorpicker-css', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/third-party/colorpicker/css/colorpicker.css'));
        wp_enqueue_style('colorpicker-css');

        wp_register_script('wc-colorpicker-js', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/third-party/colorpicker/js/colorpicker.js'), array('jquery'), '2.0.0.9', false);
        wp_enqueue_script('wc-colorpicker-js');

        wp_register_style('wc-options-css', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/css/options-css.css'));
        wp_enqueue_style('wc-options-css');

        wp_register_script('wc-option-js', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/js/options-js.js'), array('jquery'));
        wp_enqueue_script('wc-option-js');

        wp_register_script('wc-scripts-js', plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/js/wc-scripts.js'), array('jquery'));
        wp_enqueue_script('wc-scripts-js');
    }

    /*
     * post comment via ajax
     */

    public function comment_submit_via_ajax() {

        $message_array = array();
        $comment_post_ID = intval(filter_input(INPUT_POST, 'comment_post_ID'));
        $comment_parent = intval(filter_input(INPUT_POST, 'comment_parent'));
        if (!$this->wc_options->wc_options_serialized->wc_captcha_show_hide) {
            if (!is_user_logged_in()) {
                $sess_captcha = $_SESSION['wc_captcha'][$comment_post_ID . '-' . $comment_parent];
                $captcha = filter_input(INPUT_POST, 'captcha');
                if (md5(strtolower($captcha)) !== $sess_captcha) {
                    $message_array['code'] = -1;
                    $message_array['message'] = $this->wc_options->wc_options_serialized->wc_phrases['wc_invalid_captcha'];
                    echo json_encode($message_array);
                    exit;
                }
            }
        }
        $comment = filter_input(INPUT_POST, 'comment');

        if (is_user_logged_in()) {
            $user_id = get_current_user_id();
            $user = get_userdata($user_id);
            $name = $user->display_name;
            $email = $user->user_email;
            $user_url = $user->user_url;
        } else {
            $name = filter_input(INPUT_POST, 'name');
            $email = filter_input(INPUT_POST, 'email');
            $user_id = 0;
            $user_url = '';
        }

        $comment = preg_replace('|[\n]+|', '<br />', wp_kses($comment, 'default'));

        if ($name && filter_var($email, FILTER_VALIDATE_EMAIL) && $comment && filter_var($comment_post_ID)) {

            $held_moderate = 1;
            if ($this->wc_options->wc_options_serialized->wc_held_comment_to_moderate) {
                $held_moderate = 0;
            }

            $new_commentdata = array(
                'user_id' => $user_id,
                'comment_post_ID' => $comment_post_ID,
                'comment_parent' => $comment_parent,
                'comment_author' => $name,
                'comment_author_email' => $email,
                'comment_content' => $comment,
                'comment_author_url' => $user_url,
                'comment_approved' => $held_moderate
            );
            if (!$held_moderate) {
                $new_comment_id = wp_new_comment($new_commentdata);
                $new_inserted_comment = get_comment($new_comment_id);
                if ($new_inserted_comment->comment_approved) {
                    $held_moderate = 1;
                }
            } else {
                $new_comment_id = wp_insert_comment($new_commentdata);
            }
            $new_comment = new WC_Comment(get_comment($new_comment_id, OBJECT));

            if (!$held_moderate) {
                $message_array['code'] = -2;
                $message_array['message'] = $this->wc_options->wc_options_serialized->wc_phrases['wc_held_for_moderate'];
            } else {
                $message_array['code'] = 1;
                $message_array['message'] = $this->comment_tpl_builder->get_comment_template($new_comment);
            }
            $message_array['wc_new_comment_id'] = $new_comment_id;
        } else {
            $message_array['code'] = -1;
            $message_array['wc_new_comment_id'] = -1;
            $message_array['message'] = $this->wc_options->wc_options_serialized->wc_phrases['wc_invalid_field'];
        }
        echo json_encode($message_array);
        exit;
    }

    /**
     * notify on new comments
     */
    public function email_notification() {

        $wc_new_comment_id = isset($_POST['wc_new_comment_id']) ? intval($_POST['wc_new_comment_id']) : -1;
        $wc_comment_parent = isset($_POST['wc_comment_parent']) ? intval($_POST['wc_comment_parent']) : -1;
        if ($wc_new_comment_id !== -1 && $wc_comment_parent !== -1) {
            if ($this->wc_options->wc_options_serialized->wc_notify_moderator) {
                wp_notify_postauthor($wc_new_comment_id);
            }
            if ($this->wc_options->wc_options_serialized->wc_notify_comment_author && $wc_comment_parent) {
                $wc_new_comment_content = get_comment($wc_new_comment_id)->comment_content;
                $comment = get_comment($wc_comment_parent);
                $to = $comment->comment_author_email;
                $subject = $this->wc_options->wc_options_serialized->wc_phrases['wc_email_subject'];
                $permalink = get_comment_link($wc_comment_parent);
                $message = $this->wc_options->wc_options_serialized->wc_phrases['wc_email_message'];
                $message .= "<br/><br/><a href='$permalink'>$permalink</a>";
                $message .= "<br/><br/>$wc_new_comment_content";
                $headers = array();
                $headers[] = "Content-Type: text/html; charset=UTF-8";
                $headers[] = "From: " . get_bloginfo('name') . "\r\n";
                wp_mail($to, $subject, $message, $headers);
            }
        }
    }

    /**
     * vote on comment via ajax
     */
    public function vote_on_comment() {
        if ($this->wc_db_helper->is_phrase_exists('wc_leave_a_reply_text')) {
            $this->wc_options->wc_options_serialized->wc_phrases = $this->wc_db_helper->get_phrases();
        }
        $messageArray = array();
        $messageArray['code'] = -1;
        $comment_id = '';
        if (!is_user_logged_in()) {
            $messageArray['message'] = $this->wc_options->wc_options_serialized->wc_phrases['wc_login_to_vote'];
            echo json_encode($messageArray);
            exit();
        }
        if (isset($_POST['comment_ID']) && isset($_POST['vote_type']) && intval($_POST['comment_ID']) && intval($_POST['vote_type'])) {
            $comment_id = $_POST['comment_ID'];
            $user_id = get_current_user_id();
            $vote_type = $_POST['vote_type'];

            $is_user_voted = $this->wc_db_helper->is_user_voted($user_id, $comment_id);
            $comment = get_comment($comment_id);
            if ($comment->user_id == $user_id) {
                $messageArray['message'] = $this->wc_options->wc_options_serialized->wc_phrases['wc_self_vote'];
                echo json_encode($messageArray);
                exit();
            }

            if ($is_user_voted != '') {
                $vote = intval($is_user_voted) + intval($vote_type);
                if ($vote >= -1 && $vote <= 1) {
                    $this->wc_db_helper->update_vote_type($user_id, $comment_id, $vote);
                    $vote_count = intval(get_comment_meta($comment_id, 'wpdiscuz_votes', true)) + intval($vote_type);
                    update_comment_meta($comment_id, 'wpdiscuz_votes', '' . $vote_count);
                    $messageArray['code'] = 1;
                    $messageArray['message'] = $this->wc_options->wc_options_serialized->wc_phrases['wc_vote_counted'];
                } else {
                    $messageArray['message'] = $this->wc_options->wc_options_serialized->wc_phrases['wc_vote_only_one_time'];
                }
            } else {
                $this->wc_db_helper->add_vote_type($user_id, $comment_id, $vote_type);
                $vote_count = get_comment_meta($comment_id, 'wpdiscuz_votes', true);
                if ($vote_count == '') {
                    add_comment_meta($comment_id, 'wpdiscuz_votes', '' . $vote_type);
                } else {
                    $vote_count = intval($vote_count) + intval($vote_type);
                    update_comment_meta($comment_id, 'wpdiscuz_votes', '' . $vote_count);
                }
                $messageArray['code'] = 1;
                $messageArray['message'] = $this->wc_options->wc_options_serialized->wc_phrases['wc_vote_counted'];
            }
        } else {
            $messageArray['message'] = $this->wc_options->wc_options_serialized->wc_phrases['wc_voting_error'];
        }

        echo json_encode($messageArray);
        exit();
    }

    /**
     * get comments by comment type
     */
    public function get_wp_comments($comments_offset, $post_id = null) {
        global $post;
        if ($this->wc_db_helper->is_phrase_exists('wc_leave_a_reply_text')) {
            $this->wc_options->wc_options_serialized->wc_phrases = $this->wc_db_helper->get_phrases();
        }

        if (!$post_id) {
            $post_id = $post->ID;
        }
        $wc_comment_count = $this->wc_options->wc_options_serialized->wc_comment_count;
        $wc_comment_list_order = $this->wc_options->wc_options_serialized->wc_comment_list_order;

        $comm_list_args = array(
            'callback' => array(&$this, 'wc_comment_callback'),
            'style' => 'div',
            'per_page' => $comments_offset * $wc_comment_count,
            'max_depth' => 2,
            'reverse_top_level' => false
        );



        $comments = get_comments(array('post_id' => $post_id, 'status' => 'approve', 'order' => $wc_comment_list_order));

        $wc_comments = $this->init_wc_comments($comments);
        wp_list_comments($comm_list_args, $wc_comments);

        return $this->wc_parent_comments_count;
    }

    /**
     * load more comments by offset
     */
    public function load_more_comments() {
        $c_offset = intval($_POST['comments_offset']);
        $c_offset = ($c_offset) ? $c_offset : 1;
        $post_id = intval($_POST['wc_post_id']);
        if ($c_offset && $post_id) {
            $this->get_wp_comments($c_offset, $post_id);
        }
        exit();
    }

    /**
     * initialize WPC comments 
     */
    public function init_wc_comments($comments) {
        $wc_comments = array();
        if ($comments) {
            foreach ($comments as $comment) {
                if (!$comment->comment_parent) {
                    $this->wc_parent_comments_count++;
                }
                $wc_comments[] = new WC_Comment($comment);
            }
        }
        return $wc_comments;
    }

    public function wc_comment_callback($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        echo $this->comment_tpl_builder->get_comment_template($comment);
    }

    public function is_guest_can_comment() {
        $user_can_comment = TRUE;
        if ($this->wc_options->wc_options_serialized->wc_user_must_be_registered) {
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
        if (in_array($post->post_type, $this->wc_options->wc_options_serialized->wc_post_types) && comments_open($post->ID)) {
            add_filter('comments_template', array(&$this, 'remove_comments_template_on_pages'), 1);
//            add_action('comment_form', array(&$this, 'remove_comments_template_on_pages'), 1);
        }
    }

    function remove_comments_template_on_pages($file) {
        $file = dirname(__FILE__) . '/comment-form/form.php';
        return $file;
    }

}



$wc_core = new WC_Core();
?>