<?php
class WC_Options {

    public $wc_options_serialized;
    public $wc_db_helper;
    private $wc_post_types;

    public function __construct($wc_options_serialized, $wc_db_helper) {
        $this->wc_db_helper = $wc_db_helper;
        $this->wc_options_serialized = $wc_options_serialized;
    }

    /**
     * Builds options page
     */
    public function main_options_form() {

        $default_post_types = get_post_types('', 'names');
        foreach ($default_post_types as $post_type) {
            if ($post_type != 'revision' && $post_type != 'nav_menu_item') {
                $this->wc_post_types[] = $post_type;
            }
        }

        if (isset($_POST['wc_submit_options'])) {

            if (function_exists('current_user_can') && !current_user_can('manage_options')) {
                die(_e('Hacker?', WC_Core::$TEXT_DOMAIN));
            }

            if (function_exists('check_admin_referer')) {
                check_admin_referer('wc_options_form');
            }

            $this->wc_options_serialized->wc_post_types = isset($_POST['wc_post_types']) ? $_POST['wc_post_types'] : array();
            $this->wc_options_serialized->wc_comment_list_order = isset($_POST['wc_comment_list_order']) ? $_POST['wc_comment_list_order'] : 'desc';
            $this->wc_options_serialized->wc_comment_list_update_type = isset($_POST['wc_comment_list_update_type']) ? $_POST['wc_comment_list_update_type'] : 0;
            $this->wc_options_serialized->wc_comment_list_update_timer = isset($_POST['wc_comment_list_update_timer']) ? $_POST['wc_comment_list_update_timer'] : 30;
            $this->wc_options_serialized->wc_comment_editable_time = isset($_POST['wc_comment_editable_time']) ? $_POST['wc_comment_editable_time'] : 900;
            $this->wc_options_serialized->wpdiscuz_redirect_page = isset($_POST['wpdiscuz_redirect_page']) ? $_POST['wpdiscuz_redirect_page'] : 0;
            $this->wc_options_serialized->wc_is_guest_can_vote = isset($_POST['wc_is_guest_can_vote']) ? $_POST['wc_is_guest_can_vote'] : 0;
            $this->wc_options_serialized->wc_load_all_comments = isset($_POST['wc_load_all_comments']) ? $_POST['wc_load_all_comments'] : 0;
            $this->wc_options_serialized->wc_voting_buttons_show_hide = isset($_POST['wc_voting_buttons_show_hide']) ? $_POST['wc_voting_buttons_show_hide'] : 0;
            $this->wc_options_serialized->wc_share_buttons_show_hide = isset($_POST['wc_share_buttons_show_hide']) ? $_POST['wc_share_buttons_show_hide'] : 0;
            $this->wc_options_serialized->wc_captcha_show_hide = isset($_POST['wc_captcha_show_hide']) ? $_POST['wc_captcha_show_hide'] : 0;
            $this->wc_options_serialized->wc_weburl_show_hide = isset($_POST['wc_weburl_show_hide']) ? $_POST['wc_weburl_show_hide'] : 0;
            $this->wc_options_serialized->wc_header_text_show_hide = isset($_POST['wc_header_text_show_hide']) ? $_POST['wc_header_text_show_hide'] : 0;
            $this->wc_options_serialized->wc_avatar_show_hide = isset($_POST['wc_avatar_show_hide']) ? $_POST['wc_avatar_show_hide'] : 0;
            $this->wc_options_serialized->wc_user_must_be_registered = isset($_POST['wc_user_must_be_registered']) ? $_POST['wc_user_must_be_registered'] : 0;
            $this->wc_options_serialized->wc_is_name_field_required = isset($_POST['wc_is_name_field_required']) ? $_POST['wc_is_name_field_required'] : 0;
            $this->wc_options_serialized->wc_is_email_field_required = isset($_POST['wc_is_email_field_required']) ? $_POST['wc_is_email_field_required'] : 0;
            $this->wc_options_serialized->wc_show_hide_loggedin_username = isset($_POST['wc_show_hide_loggedin_username']) ? $_POST['wc_show_hide_loggedin_username'] : 0;
            $this->wc_options_serialized->wc_reply_button_guests_show_hide = isset($_POST['wc_reply_button_guests_show_hide']) ? $_POST['wc_reply_button_guests_show_hide'] : 0;
            $this->wc_options_serialized->wc_reply_button_members_show_hide = isset($_POST['wc_reply_button_members_show_hide']) ? $_POST['wc_reply_button_members_show_hide'] : 0;
            $this->wc_options_serialized->wc_author_titles_show_hide = isset($_POST['wc_author_titles_show_hide']) ? $_POST['wc_author_titles_show_hide'] : 0;
            $this->wc_options_serialized->wc_comment_count = isset($_POST['wc_comment_count']) ? $_POST['wc_comment_count'] : 10;
            $this->wc_options_serialized->wc_comments_max_depth = isset($_POST['wc_comments_max_depth']) ? $_POST['wc_comments_max_depth'] : 2;
            $this->wc_options_serialized->wc_simple_comment_date = isset($_POST['wc_simple_comment_date']) ? $_POST['wc_simple_comment_date'] : 0;
            $this->wc_options_serialized->wc_comment_reply_checkboxes_default_checked = isset($_POST['wc_comment_reply_checkboxes_default_checked']) ? $_POST['wc_comment_reply_checkboxes_default_checked'] : 0;
            $this->wc_options_serialized->wc_show_hide_comment_checkbox = isset($_POST['wc_show_hide_comment_checkbox']) ? $_POST['wc_show_hide_comment_checkbox'] : 0;
            $this->wc_options_serialized->wc_show_hide_all_reply_checkbox = isset($_POST['wc_show_hide_all_reply_checkbox']) ? $_POST['wc_show_hide_all_reply_checkbox'] : 0;
            $this->wc_options_serialized->wc_show_hide_reply_checkbox = isset($_POST['wc_show_hide_reply_checkbox']) ? $_POST['wc_show_hide_reply_checkbox'] : 0;
            $this->wc_options_serialized->wc_use_postmatic_for_comment_notification = isset($_POST['wc_use_postmatic_for_comment_notification']) ? $_POST['wc_use_postmatic_for_comment_notification'] : 0;
            $this->wc_options_serialized->wc_form_bg_color = isset($_POST['wc_form_bg_color']) ? $_POST['wc_form_bg_color'] : '#f9f9f9';
            $this->wc_options_serialized->wc_comment_text_size = isset($_POST['wc_comment_text_size']) ? $_POST['wc_comment_text_size'] : '14px';
            $this->wc_options_serialized->wc_comment_bg_color = isset($_POST['wc_comment_bg_color']) ? $_POST['wc_comment_bg_color'] : '#fefefe';
            $this->wc_options_serialized->wc_reply_bg_color = isset($_POST['wc_reply_bg_color']) ? $_POST['wc_reply_bg_color'] : '#f8f8f8';
            $this->wc_options_serialized->wc_comment_text_color = isset($_POST['wc_comment_text_color']) ? $_POST['wc_comment_text_color'] : '#555';
            $this->wc_options_serialized->wc_author_title_color = isset($_POST['wc_author_title_color']) ? $_POST['wc_author_title_color'] : '#00B38F';
            $this->wc_options_serialized->wc_vote_reply_color = isset($_POST['wc_vote_reply_color']) ? $_POST['wc_vote_reply_color'] : '#666666';
            $this->wc_options_serialized->wc_input_border_color = isset($_POST['wc_input_border_color']) ? $_POST['wc_input_border_color'] : '#d9d9d9';
            $this->wc_options_serialized->wc_new_loaded_comment_bg_color = isset($_POST['wc_new_loaded_comment_bg_color']) ? $_POST['wc_new_loaded_comment_bg_color'] : 'rgb(254,254,254)';
            $this->wc_options_serialized->wc_custom_css = isset($_POST['wc_custom_css']) ? $_POST['wc_custom_css'] : '.comments-area{width:auto; margin: 0 auto;}';
            $this->wc_options_serialized->wc_show_plugin_powerid_by = isset($_POST['wc_show_plugin_powerid_by']) ? $_POST['wc_show_plugin_powerid_by'] : 0;
            $this->wc_options_serialized->wc_is_use_po_mo = isset($_POST['wc_is_use_po_mo']) ? $_POST['wc_is_use_po_mo'] : 0;
            $this->wc_options_serialized->wc_comment_text_max_length = (isset($_POST['wc_comment_text_max_length']) && intval($_POST['wc_comment_text_max_length']) && intval($_POST['wc_comment_text_max_length']) > 0) ? intval($_POST['wc_comment_text_max_length']) : '';

            $this->wc_options_serialized->update_options();
        }
        ?>

        <div class="wrap wpdiscuz_options_page">

            <div style="float:left; width:50px; height:55px; margin:10px 10px 20px 0px;">
                <img src="<?php echo plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/plugin-icon/plugin-icon-48.png'); ?>"/>
            </div>
            <h2 style="padding-bottom:20px; padding-top:15px;"><?php _e('wpDiscuz General Settings', WC_Core::$TEXT_DOMAIN); ?></h2>
            <br style="clear:both" />


            <link rel="stylesheet" href="<?php echo plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/'); ?>bxslider/jquery.bxslider.css" type="text/css" />
            <script src="<?php echo plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/'); ?>bxslider/jquery.min.js"></script>
            <script src="<?php echo plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/'); ?>bxslider/jquery.bxslider.js"></script>
            <table width="100%" border="0" cellspacing="1" class="widefat">
                <tr>
                    <td style="padding:10px; padding-left:0px; vertical-align:top; width:500px;">
                        <div class="slider">
                            <ul class="bxslider">
                                <li><a href="https://wordpress.org/plugins/woodiscuz-woocommerce-comments/screenshots/"><img src="<?php echo plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/'); ?>files/img/gc/3.png" title="Free Download from Wordpress.org" style="padding:0px 0px 20px 20px;" /></a></li>
                                <li><a href="https://wordpress.org/plugins/woocommerce-category-slider/screenshots/"><img src="<?php echo plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/'); ?>files/img/gc/5.png" title="Free Download from Wordpress.org" style="padding:0px 0px 20px 20px;" /></a></li>
                                <li><a href="https://wordpress.org/plugins/woocommerce-pdf-print/"><img src="<?php echo plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/'); ?>files/img/gc/4.png" title="Free Download from Wordpress.org" style="padding:0px 0px 20px 20px;" /></a></li>
                                <li><a href="https://wordpress.org/plugins/advanced-content-pagination/screenshots/"><img src="<?php echo plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/'); ?>files/img/gc/1.png" title="Free Download from Wordpress.org" style="padding:0px 0px 20px 20px;" /></a></li>
                                <li><a href="https://wordpress.org/plugins/author-and-post-statistic-widgets/"><img src="<?php echo plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/'); ?>files/img/gc/2.png" title="Free Download from Wordpress.org" style="padding:0px 0px 20px 20px;" /></a></li>
                            </ul>
                        </div>
                        <div style="clear:both"></div>
                    </td>
                    <td valign="top" style="padding:20px;">

                        <table width="100%" border="0" cellspacing="1" class="widefat">
                            <thead>
                                <tr>
                                    <th style="font-size:14px; background-color:#FEFCE7">&nbsp;Information</th>
                                </tr>
                            </thead>
                            <tr valign="top">
                                <td style="background:#FFF; text-align:left; font-size:13px;">
                                    wpDiscuz is also available for WooCommerce. The WooCommerce Comments plugin name is <a href="https://wordpress.org/plugins/woodiscuz-woocommerce-comments/" style="color:#993399; text-decoration:underline;"><strong>WooDiscuz</strong></a>. It adds a new "Discussion" Tab on product page and allows your customers ask Pre-Sale Questions and discuss about your products. 
                                </td>
                            </tr>
                        </table><br />

                        <table width="100%" border="0" cellspacing="1" class="widefat">
                            <thead>
                                <tr>
                                    <th style="font-size:16px; background-color:#FEFCE7;"><strong>Like wpDiscuz?</strong> <br /><span style="font-size:15px">We really need your reviews!</span></th>
                                </tr>
                            </thead>
                            <tr valign="top">
                                <td style="background:#FFF; text-align:left; font-size:13px;">
                                    We do our best to make wpDiscuz the best self-hosted comment plugin for Wordpress. Thousands users are currently satisfied with wpDiscuz but only about 1% of them give us 5 start rating.
                                    However we have a very few users who for some very specific reasons are not satisfied and they are very active in decreasing wpDiscuz rating. 
                                    Please help us keep plugin rating high, encouraging us to develop and maintain this plugin. Take a one minute to leave <a href="https://wordpress.org/support/view/plugin-reviews/wpdiscuz?filter=5" title="Go to wpDiscuz Reviews section on Wordpress.org"><img src="<?php echo plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/'); ?>files/img/gc/5s.png" border="0" align="absmiddle" /></a> star review on <a href="https://wordpress.org/support/view/plugin-reviews/wpdiscuz?filter=5">Wordpress.org</a>. Thank You!
                                    <hr style="border-style:dotted;" />
                                    <div style="width:200px; float:right;">
                                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                            <input type="hidden" name="cmd" value="_s-xclick"><input type="hidden" name="hosted_button_id" value="UC44WQM5XJFPA"><input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!"><img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                        </form>
                                    </div>
                                    We spend as much of my spare time as possible working on wpDiscuz and any donation is appreciated. Donations play a crucial role in supporting Free and Open Source Software projects.            
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>
            </table>
            <script>
                $('.bxslider').bxSlider({
                    mode: 'fade',
                    captions: false,
                    auto: true
                });
            </script>
            <br />

            <?php
            if (isset($_GET['wpdiscuz_reset_options']) && $_GET['wpdiscuz_reset_options'] == 1 && current_user_can('manage_options')) {
                delete_option($this->wc_options_serialized->wc_options_slug);
                $this->wc_options_serialized->wc_post_types = array('post');
                $this->wc_options_serialized->add_options();
                $this->wc_options_serialized->init_options(get_option($this->wc_options_serialized->wc_options_slug));
                $this->wc_options_serialized->wc_show_plugin_powerid_by = 1;
                $this->wc_options_serialized->update_options();
            }
            ?>

            <form action="<?php echo admin_url(); ?>admin.php?page=wpdiscuz_options_page&updated=true" method="post" name="wpdiscuz_options_page" class="wc-main-settings-form wc-form">
                <?php
                if (function_exists('wp_nonce_field')) {
                    wp_nonce_field('wc_options_form');
                }
                ?>

                <h2>&nbsp;</h2>

                <div id="parentHorizontalTab">
                    <ul class="resp-tabs-list hor_1">
                        <li><?php _e('General settings', WC_Core::$TEXT_DOMAIN); ?></li>
                        <li><?php _e('Live Update', WC_Core::$TEXT_DOMAIN); ?></li>
                        <li><?php _e('Show/Hide Components', WC_Core::$TEXT_DOMAIN); ?></li>
                        <li><?php _e('Email Subscription', WC_Core::$TEXT_DOMAIN); ?> <?php if (class_exists('Prompt_Comment_Form_Handling')): ?> <?php _e('and Postmatic', WC_Core::$TEXT_DOMAIN); ?> <?php endif; ?></li>
                        <li><?php _e('Background and Colors', WC_Core::$TEXT_DOMAIN); ?></li>
                        <li><?php _e('Social Login', WC_Core::$TEXT_DOMAIN); ?></li>
                    </ul>
                    <div class="resp-tabs-container hor_1">                            
                        <?php
                        include 'options-layouts/settings-general.php';
                        include 'options-layouts/settings-live-update.php';
                        include 'options-layouts/settings-show-hide.php';
                        include 'options-layouts/settings-subscription.php';
                        include 'options-layouts/settings-style.php';
                        include 'options-layouts/settings-social.php';
                        ?>
                    </div>
                </div>
                <script type="text/javascript">
                    jQuery(document).ready(function ($) {
                        //Horizontal Tab
                        $('#parentHorizontalTab').easyResponsiveTabs({
                            type: 'default', //Types: default, vertical, accordion
                            width: 'auto', //auto or any width like 600px
                            fit: true, // 100% fit in a container
                            tabidentify: 'hor_1', // The tab groups identifier
                        });
                    });
                </script>
                <table class="form-table wc-form-table">
                    <tbody>
                        <tr valign="top">
                            <td colspan="4">
                                <p class="submit">
                                    <input type="submit" class="button button-primary" name="wc_submit_options" value="<?php _e('Save Changes', WC_Core::$TEXT_DOMAIN); ?>" />
                                    <a style="float: right;" class="button button-secondary" href="<?php echo admin_url(); ?>admin.php?page=wpdiscuz_options_page&wpdiscuz_reset_options=1"><?php _e('Reset Options', WC_Core::$TEXT_DOMAIN); ?></a>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" name="action" value="update" />
            </form>            
        </div>

        <?php
    }

    public function phrases_options_form() {

        if (isset($_POST['wc_submit_phrases'])) {

            if (function_exists('current_user_can') && !current_user_can('manage_options')) {
                die(_e('Hacker?', WC_Core::$TEXT_DOMAIN));
            }

            if (function_exists('check_admin_referer')) {
                check_admin_referer('wc_phrases_form');
            }

            $this->wc_options_serialized->wc_phrases['wc_leave_a_reply_text'] = $_POST['wc_leave_a_reply_text'];
            $this->wc_options_serialized->wc_phrases['wc_be_the_first_text'] = $_POST['wc_be_the_first_text'];
            $this->wc_options_serialized->wc_phrases['wc_header_text'] = $_POST['wc_header_text'];
            $this->wc_options_serialized->wc_phrases['wc_header_text_plural'] = $_POST['wc_header_text_plural'];
            $this->wc_options_serialized->wc_phrases['wc_header_on_text'] = $_POST['wc_header_on_text'];
            $this->wc_options_serialized->wc_phrases['wc_comment_start_text'] = $_POST['wc_comment_start_text'];
            $this->wc_options_serialized->wc_phrases['wc_comment_join_text'] = $_POST['wc_comment_join_text'];
            $this->wc_options_serialized->wc_phrases['wc_email_text'] = $_POST['wc_email_text'];
            $this->wc_options_serialized->wc_phrases['wc_name_text'] = $_POST['wc_name_text'];
            $this->wc_options_serialized->wc_phrases['wc_website_text'] = $_POST['wc_website_text'];
            $this->wc_options_serialized->wc_phrases['wc_captcha_text'] = $_POST['wc_captcha_text'];
            $this->wc_options_serialized->wc_phrases['wc_submit_text'] = $_POST['wc_submit_text'];
            $this->wc_options_serialized->wc_phrases['wc_manage_subscribtions'] = $_POST['wc_manage_subscribtions'];
            $this->wc_options_serialized->wc_phrases['wc_notify_none'] = $_POST['wc_notify_none'];
            $this->wc_options_serialized->wc_phrases['wc_notify_on_new_comment'] = $_POST['wc_notify_on_new_comment'];
            $this->wc_options_serialized->wc_phrases['wc_notify_on_all_new_reply'] = $_POST['wc_notify_on_all_new_reply'];
            $this->wc_options_serialized->wc_phrases['wc_notify_on_new_reply'] = $_POST['wc_notify_on_new_reply'];
            $this->wc_options_serialized->wc_phrases['wc_load_more_submit_text'] = $_POST['wc_load_more_submit_text'];
            $this->wc_options_serialized->wc_phrases['wc_load_rest_comments_submit_text'] = $_POST['wc_load_rest_comments_submit_text'];
            $this->wc_options_serialized->wc_phrases['wc_reply_text'] = $_POST['wc_reply_text'];
            $this->wc_options_serialized->wc_phrases['wc_share_text'] = $_POST['wc_share_text'];
            $this->wc_options_serialized->wc_phrases['wc_edit_text'] = $_POST['wc_edit_text'];
            $this->wc_options_serialized->wc_phrases['wc_share_facebook'] = $_POST['wc_share_facebook'];
            $this->wc_options_serialized->wc_phrases['wc_share_twitter'] = $_POST['wc_share_twitter'];
            $this->wc_options_serialized->wc_phrases['wc_share_google'] = $_POST['wc_share_google'];
            $this->wc_options_serialized->wc_phrases['wc_share_vk'] = $_POST['wc_share_vk'];
            $this->wc_options_serialized->wc_phrases['wc_share_ok'] = $_POST['wc_share_ok'];
            $this->wc_options_serialized->wc_phrases['wc_hide_replies_text'] = $_POST['wc_hide_replies_text'];
            $this->wc_options_serialized->wc_phrases['wc_show_replies_text'] = $_POST['wc_show_replies_text'];
            $this->wc_options_serialized->wc_phrases['wc_user_title_guest_text'] = $_POST['wc_user_title_guest_text'];
            $this->wc_options_serialized->wc_phrases['wc_user_title_member_text'] = $_POST['wc_user_title_member_text'];
            $this->wc_options_serialized->wc_phrases['wc_user_title_author_text'] = $_POST['wc_user_title_author_text'];
            $this->wc_options_serialized->wc_phrases['wc_user_title_admin_text'] = $_POST['wc_user_title_admin_text'];
            $this->wc_options_serialized->wc_phrases['wc_email_subject'] = $_POST['wc_email_subject'];
            $this->wc_options_serialized->wc_phrases['wc_email_message'] = $_POST['wc_email_message'];
            $this->wc_options_serialized->wc_phrases['wc_new_reply_email_subject'] = $_POST['wc_new_reply_email_subject'];
            $this->wc_options_serialized->wc_phrases['wc_new_reply_email_message'] = $_POST['wc_new_reply_email_message'];
            $this->wc_options_serialized->wc_phrases['wc_subscribed_on_comment'] = $_POST['wc_subscribed_on_comment'];
            $this->wc_options_serialized->wc_phrases['wc_subscribed_on_all_comment'] = $_POST['wc_subscribed_on_all_comment'];
            $this->wc_options_serialized->wc_phrases['wc_subscribed_on_post'] = $_POST['wc_subscribed_on_post'];
            $this->wc_options_serialized->wc_phrases['wc_unsubscribe'] = $_POST['wc_unsubscribe'];
            $this->wc_options_serialized->wc_phrases['wc_ignore_subscription'] = $_POST['wc_ignore_subscription'];
            $this->wc_options_serialized->wc_phrases['wc_unsubscribe_message'] = $_POST['wc_unsubscribe_message'];
            $this->wc_options_serialized->wc_phrases['wc_confirm_email'] = $_POST['wc_confirm_email'];
            $this->wc_options_serialized->wc_phrases['wc_comfirm_success_message'] = $_POST['wc_comfirm_success_message'];
            $this->wc_options_serialized->wc_phrases['wc_confirm_email_subject'] = $_POST['wc_confirm_email_subject'];
            $this->wc_options_serialized->wc_phrases['wc_confirm_email_message'] = $_POST['wc_confirm_email_message'];
            $this->wc_options_serialized->wc_phrases['wc_error_empty_text'] = $_POST['wc_error_empty_text'];
            $this->wc_options_serialized->wc_phrases['wc_error_email_text'] = $_POST['wc_error_email_text'];
            $this->wc_options_serialized->wc_phrases['wc_error_url_text'] = $_POST['wc_error_url_text'];
            $this->wc_options_serialized->wc_phrases['wc_year_text']['datetime'][0] = $_POST['wc_year_text'];
            $this->wc_options_serialized->wc_phrases['wc_year_text_plural']['datetime'][0] = $_POST['wc_year_text_plural'];
            $this->wc_options_serialized->wc_phrases['wc_month_text']['datetime'][0] = $_POST['wc_month_text'];
            $this->wc_options_serialized->wc_phrases['wc_month_text_plural']['datetime'][0] = $_POST['wc_month_text_plural'];
            $this->wc_options_serialized->wc_phrases['wc_day_text']['datetime'][0] = $_POST['wc_day_text'];
            $this->wc_options_serialized->wc_phrases['wc_day_text_plural']['datetime'][0] = $_POST['wc_day_text_plural'];
            $this->wc_options_serialized->wc_phrases['wc_hour_text']['datetime'][0] = $_POST['wc_hour_text'];
            $this->wc_options_serialized->wc_phrases['wc_hour_text_plural']['datetime'][0] = $_POST['wc_hour_text_plural'];
            $this->wc_options_serialized->wc_phrases['wc_minute_text']['datetime'][0] = $_POST['wc_minute_text'];
            $this->wc_options_serialized->wc_phrases['wc_minute_text_plural']['datetime'][0] = $_POST['wc_minute_text_plural'];
            $this->wc_options_serialized->wc_phrases['wc_second_text']['datetime'][0] = $_POST['wc_second_text'];
            $this->wc_options_serialized->wc_phrases['wc_second_text_plural']['datetime'][0] = $_POST['wc_second_text_plural'];
            $this->wc_options_serialized->wc_phrases['wc_right_now_text'] = $_POST['wc_right_now_text'];
            $this->wc_options_serialized->wc_phrases['wc_ago_text'] = $_POST['wc_ago_text'];
            $this->wc_options_serialized->wc_phrases['wc_posted_today_text'] = $_POST['wc_posted_today_text'];
            $this->wc_options_serialized->wc_phrases['wc_you_must_be_text'] = $_POST['wc_you_must_be_text'];
            $this->wc_options_serialized->wc_phrases['wc_logged_in_as'] = $_POST['wc_logged_in_as'];
            $this->wc_options_serialized->wc_phrases['wc_log_out'] = $_POST['wc_log_out'];
            $this->wc_options_serialized->wc_phrases['wc_logged_in_text'] = $_POST['wc_logged_in_text'];
            $this->wc_options_serialized->wc_phrases['wc_to_post_comment_text'] = $_POST['wc_to_post_comment_text'];
            $this->wc_options_serialized->wc_phrases['wc_vote_counted'] = $_POST['wc_vote_counted'];
            $this->wc_options_serialized->wc_phrases['wc_vote_up'] = $_POST['wc_vote_up'];
            $this->wc_options_serialized->wc_phrases['wc_vote_down'] = $_POST['wc_vote_down'];
            $this->wc_options_serialized->wc_phrases['wc_held_for_moderate'] = $_POST['wc_held_for_moderate'];
            $this->wc_options_serialized->wc_phrases['wc_vote_only_one_time'] = $_POST['wc_vote_only_one_time'];
            $this->wc_options_serialized->wc_phrases['wc_voting_error'] = $_POST['wc_voting_error'];
            $this->wc_options_serialized->wc_phrases['wc_self_vote'] = $_POST['wc_self_vote'];
            $this->wc_options_serialized->wc_phrases['wc_deny_voting_from_same_ip'] = $_POST['wc_deny_voting_from_same_ip'];
            $this->wc_options_serialized->wc_phrases['wc_login_to_vote'] = $_POST['wc_login_to_vote'];
            $this->wc_options_serialized->wc_phrases['wc_invalid_captcha'] = $_POST['wc_invalid_captcha'];
            $this->wc_options_serialized->wc_phrases['wc_invalid_field'] = $_POST['wc_invalid_field'];
            $this->wc_options_serialized->wc_phrases['wc_new_comment_button_text'] = $_POST['wc_new_comment_button_text'];
            $this->wc_options_serialized->wc_phrases['wc_new_comments_button_text'] = $_POST['wc_new_comments_button_text'];
            $this->wc_options_serialized->wc_phrases['wc_new_reply_button_text'] = $_POST['wc_new_reply_button_text'];
            $this->wc_options_serialized->wc_phrases['wc_new_replies_button_text'] = $_POST['wc_new_replies_button_text'];
            $this->wc_options_serialized->wc_phrases['wc_new_comments_text'] = $_POST['wc_new_comments_text'];
            $this->wc_options_serialized->wc_phrases['wc_comment_not_updated'] = $_POST['wc_comment_not_updated'];
            $this->wc_options_serialized->wc_phrases['wc_comment_edit_not_possible'] = $_POST['wc_comment_edit_not_possible'];
            $this->wc_options_serialized->wc_phrases['wc_comment_not_edited'] = $_POST['wc_comment_not_edited'];
            $this->wc_options_serialized->wc_phrases['wc_comment_edit_save_button'] = $_POST['wc_comment_edit_save_button'];
            $this->wc_options_serialized->wc_phrases['wc_comment_edit_cancel_button'] = $_POST['wc_comment_edit_cancel_button'];
            $this->wc_options_serialized->wc_phrases['wc_msg_comment_text_max_length'] = $_POST['wc_msg_comment_text_max_length'];

            $this->wc_db_helper->update_phrases($this->wc_options_serialized->wc_phrases);
        }
            $this->wc_options_serialized->init_phrases_on_load();
        ?>
        <div class="wrap wpdiscuz_options_page">

            <div style="float:left; width:50px; height:55px; margin:10px 10px 20px 0px;">
                <img src="<?php echo plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/plugin-icon/plugin-icon-48.png'); ?>" style="height:43px;"/>
            </div>
            <h2 style="padding-bottom:20px; padding-top:15px;"><?php _e('WpDiscuz Front-end Phrases', WC_Core::$TEXT_DOMAIN); ?></h2>
            <br style="clear:both" />
            <form action="<?php echo admin_url(); ?>admin.php?page=wpdiscuz_phrases_page&updated=true" method="post" name="wpdiscuz_phrases_page" class="wc-phrases-settings-form wc-form">
                <?php
                if (function_exists('wp_nonce_field')) {
                    wp_nonce_field('wc_phrases_form');
                }
                ?>
                <div id="parentHorizontalTab1">
                    <ul class="resp-tabs-list hor_2">
                        <li><?php _e('General', WC_Core::$TEXT_DOMAIN); ?></li>
                        <li><?php _e('Form', WC_Core::$TEXT_DOMAIN); ?></li>
                        <li><?php _e('Comment', WC_Core::$TEXT_DOMAIN); ?></li>
                        <li><?php _e('Date/Time', WC_Core::$TEXT_DOMAIN); ?></li>
                        <li><?php _e('Email', WC_Core::$TEXT_DOMAIN); ?></li>
                        <li><?php _e('Notification', WC_Core::$TEXT_DOMAIN); ?></li>
                    </ul>
                    <div class="resp-tabs-container hor_2">  
                        <?php include 'phrases-layout/phrases-general.php'; ?>
                        <?php include 'phrases-layout/phrases-form.php'; ?>
                        <?php include 'phrases-layout/phrases-comment.php'; ?>
                        <?php include 'phrases-layout/phrases-datetime.php'; ?>
                        <?php include 'phrases-layout/phrases-email.php'; ?>
                        <?php include 'phrases-layout/phrases-notification.php'; ?>
                    </div>
                </div>
                <script type="text/javascript">
                    jQuery(document).ready(function ($) {
                        //Horizontal Tab
                        $('#parentHorizontalTab1').easyResponsiveTabs({
                            type: 'default', //Types: default, vertical, accordion
                            width: 'auto', //auto or any width like 600px
                            fit: true, // 100% fit in a container
                            tabidentify: 'hor_2', // The tab groups identifier
                        });
                    });
                </script>
                <table class="form-table wc-form-table">
                    <tbody>
                        <tr valign="top">
                            <td colspan="4">
                                <p class="submit">
                                    <input type="submit" class="button button-primary" name="wc_submit_phrases" value="<?php _e('Save Changes', WC_Core::$TEXT_DOMAIN); ?>" />                                    
                                </p>
                            </td>
                        </tr>
                    <input type="hidden" name="action" value="update" />
                    </tbody>
                </table>
            </form>

        </div>
        <?php
    }

}
?>