<?php
include_once 'wc-options-serialize.php';
include_once 'includes/wc-db-helper.php';

class WC_Options {

    public $wc_options_serialized;
    public $wc_db_helper;
    private $wc_post_types;

    public function __construct() {
        $this->wc_db_helper = new WC_DB_Helper();
        $this->wc_options_serialized = new WC_Options_Serialize($this->wc_db_helper);
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
            $this->wc_options_serialized->wc_voting_buttons_show_hide = isset($_POST['wc_voting_buttons_show_hide']) ? $_POST['wc_voting_buttons_show_hide'] : 0;
            $this->wc_options_serialized->wc_share_buttons_show_hide = isset($_POST['wc_share_buttons_show_hide']) ? $_POST['wc_share_buttons_show_hide'] : 0;
            $this->wc_options_serialized->wc_captcha_show_hide = isset($_POST['wc_captcha_show_hide']) ? $_POST['wc_captcha_show_hide'] : 0;
            $this->wc_options_serialized->wc_user_must_be_registered = isset($_POST['wc_user_must_be_registered']) ? $_POST['wc_user_must_be_registered'] : 0;
            $this->wc_options_serialized->wc_show_hide_loggedin_username = isset($_POST['wc_show_hide_loggedin_username']) ? $_POST['wc_show_hide_loggedin_username'] : 0;
            $this->wc_options_serialized->wc_held_comment_to_moderate = isset($_POST['wc_held_comment_to_moderate']) ? $_POST['wc_held_comment_to_moderate'] : 0;
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
            $this->wc_options_serialized->wc_form_bg_color = isset($_POST['wc_form_bg_color']) ? $_POST['wc_form_bg_color'] : '#f9f9f9';
            $this->wc_options_serialized->wc_comment_text_size = isset($_POST['wc_comment_text_size']) ? $_POST['wc_comment_text_size'] : '14px';            
            $this->wc_options_serialized->wc_comment_bg_color = isset($_POST['wc_comment_bg_color']) ? $_POST['wc_comment_bg_color'] : '#fefefe';
            $this->wc_options_serialized->wc_reply_bg_color = isset($_POST['wc_reply_bg_color']) ? $_POST['wc_reply_bg_color'] : '#f8f8f8';
            $this->wc_options_serialized->wc_comment_text_color = isset($_POST['wc_comment_text_color']) ? $_POST['wc_comment_text_color'] : '#555';
            $this->wc_options_serialized->wc_author_title_color = isset($_POST['wc_author_title_color']) ? $_POST['wc_author_title_color'] : '#00B38F';
            $this->wc_options_serialized->wc_vote_reply_color = isset($_POST['wc_vote_reply_color']) ? $_POST['wc_vote_reply_color'] : '#666666';
            $this->wc_options_serialized->wc_new_loaded_comment_bg_color = isset($_POST['wc_new_loaded_comment_bg_color']) ? $_POST['wc_new_loaded_comment_bg_color'] : 'rgb(254,254,254)';
            $this->wc_options_serialized->wc_custom_css = isset($_POST['wc_custom_css']) ? $_POST['wc_custom_css'] : '.comments-area{width: 100%;margin: 0 auto;}';

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
                                    <th style="font-size:18px;">&nbsp;Information</th>
                                </tr>
                            </thead>
                            <tr valign="top">
                                <td style="background:#FFF; text-align:left; font-size:14px;">
                                    wpDiscuz is alsow available for WooCommerce. The WooCommerce Comments plugin name is <a href="https://wordpress.org/plugins/woodiscuz-woocommerce-comments/" style="color:#993399; text-decoration:underline;"><strong>WooDiscuz</strong></a>. It adds a new "Discussion" Tab on product page and allows your customers ask Pre-Sale Questions and discuss about your products. 
                                </td>
                            </tr>
                        </table><br />

                        <table width="100%" border="0" cellspacing="1" class="widefat">
                            <thead>
                                <tr>
                                    <th>&nbsp;Like wpDiscuz plugin?</th>
                                </tr>
                            </thead>
                            <tr valign="top">
                                <td style="background:#FFF; text-align:left; font-size:12px;">
                                    <ul>
                                        <li>If you like wpDiscuz and want to encourage us to develop and maintain it,why not do any or all of the following:</li>
                                        <li>- Link to it so other folks can find out about it.</li>
                                        <li>- Give it a good rating on <a href="https://wordpress.org/plugins/wpdiscuz/" target="_blank">WordPress.org.</a></li>
                                        <li>- We spend as much of my spare time as possible working on wpDiscuz and any donation is appreciated. Donations play a crucial role in supporting Free and Open Source Software projects. <div style="width:200px; float:right;">
                                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"><input type="hidden" name="cmd" value="_s-xclick"><input type="hidden" name="hosted_button_id" value="UC44WQM5XJFPA"><input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!"><img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1"></form></div>
                                    </ul>
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
            <form action="<?php echo admin_url(); ?>admin.php?page=wpdiscuz_options_page&updated=true" method="post" name="wpdiscuz_options_page" class="wc-main-settings-form wc-form">
                <?php
                if (function_exists('wp_nonce_field')) {
                    wp_nonce_field('wc_options_form');
                }
                ?>
                <table cellspacing="0" class="wp-list-table widefat plugins">
                    <thead>
                        <tr>
                            <th colspan="4" scope="col">&nbsp;</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="4">&nbsp;</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php include 'options-templates/options-template-main.php'; ?>
                        <tr valign="top">
                            <td colspan="4">
                                <p class="submit">
                                    <input type="submit" class="button button-primary" name="wc_submit_options" value="<?php _e('Save Changes', WC_Core::$TEXT_DOMAIN); ?>" />
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
            $this->wc_options_serialized->wc_phrases['wc_header_on_text'] = $_POST['wc_header_on_text'];
            $this->wc_options_serialized->wc_phrases['wc_comment_start_text'] = $_POST['wc_comment_start_text'];
            $this->wc_options_serialized->wc_phrases['wc_comment_join_text'] = $_POST['wc_comment_join_text'];
            $this->wc_options_serialized->wc_phrases['wc_email_text'] = $_POST['wc_email_text'];
            $this->wc_options_serialized->wc_phrases['wc_name_text'] = $_POST['wc_name_text'];
            $this->wc_options_serialized->wc_phrases['wc_captcha_text'] = $_POST['wc_captcha_text'];
            $this->wc_options_serialized->wc_phrases['wc_submit_text'] = $_POST['wc_submit_text'];            
            $this->wc_options_serialized->wc_phrases['wc_manage_subscribtions'] = $_POST['wc_manage_subscribtions'];
            $this->wc_options_serialized->wc_phrases['wc_notify_on_new_comment'] = $_POST['wc_notify_on_new_comment'];
            $this->wc_options_serialized->wc_phrases['wc_notify_on_all_new_reply'] = $_POST['wc_notify_on_all_new_reply'];
            $this->wc_options_serialized->wc_phrases['wc_notify_on_new_reply'] = $_POST['wc_notify_on_new_reply'];                                    
            $this->wc_options_serialized->wc_phrases['wc_load_more_submit_text'] = $_POST['wc_load_more_submit_text'];
            $this->wc_options_serialized->wc_phrases['wc_reply_text'] = $_POST['wc_reply_text'];
            $this->wc_options_serialized->wc_phrases['wc_share_text'] = $_POST['wc_share_text'];
            $this->wc_options_serialized->wc_phrases['wc_share_facebook'] = $_POST['wc_share_facebook'];
            $this->wc_options_serialized->wc_phrases['wc_share_twitter'] = $_POST['wc_share_twitter'];
            $this->wc_options_serialized->wc_phrases['wc_share_google'] = $_POST['wc_share_google'];
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
            $this->wc_options_serialized->wc_phrases['wc_unsubscribe_message'] = $_POST['wc_unsubscribe_message'];
            $this->wc_options_serialized->wc_phrases['wc_error_empty_text'] = $_POST['wc_error_empty_text'];
            $this->wc_options_serialized->wc_phrases['wc_error_email_text'] = $_POST['wc_error_email_text'];
            $this->wc_options_serialized->wc_phrases['wc_year_text']['datetime'][0] = $_POST['wc_year_text'];
            $this->wc_options_serialized->wc_phrases['wc_month_text']['datetime'][0] = $_POST['wc_month_text'];
            $this->wc_options_serialized->wc_phrases['wc_day_text']['datetime'][0] = $_POST['wc_day_text'];
            $this->wc_options_serialized->wc_phrases['wc_hour_text']['datetime'][0] = $_POST['wc_hour_text'];
            $this->wc_options_serialized->wc_phrases['wc_minute_text']['datetime'][0] = $_POST['wc_minute_text'];
            $this->wc_options_serialized->wc_phrases['wc_second_text']['datetime'][0] = $_POST['wc_second_text'];
            $this->wc_options_serialized->wc_phrases['wc_plural_text'] = $_POST['wc_plural_text'];
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
            $this->wc_options_serialized->wc_phrases['wc_login_to_vote'] = $_POST['wc_login_to_vote'];
            $this->wc_options_serialized->wc_phrases['wc_invalid_captcha'] = $_POST['wc_invalid_captcha'];
            $this->wc_options_serialized->wc_phrases['wc_invalid_field'] = $_POST['wc_invalid_field'];            
            $this->wc_options_serialized->wc_phrases['wc_new_comment_button_text'] = $_POST['wc_new_comment_button_text'];
            $this->wc_options_serialized->wc_phrases['wc_new_comments_button_text'] = $_POST['wc_new_comments_button_text'];
            $this->wc_options_serialized->wc_phrases['wc_new_reply_button_text'] = $_POST['wc_new_reply_button_text'];
            $this->wc_options_serialized->wc_phrases['wc_new_replies_button_text'] = $_POST['wc_new_replies_button_text'];
            
            $this->wc_options_serialized->wc_phrases['wc_new_comments_text'] = $_POST['wc_new_comments_text'];

            $this->wc_db_helper->update_phrases($this->wc_options_serialized->wc_phrases);
        }
        if ($this->wc_db_helper->is_phrase_exists('wc_leave_a_reply_text')) {
            $this->wc_options_serialized->wc_phrases = $this->wc_db_helper->get_phrases();
        }
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
                <table cellspacing="0" class="wp-list-table widefat plugins">
                    <thead>
                        <tr>
                            <th colspan="4" scope="col">&nbsp;</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="4">&nbsp;</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php include 'options-templates/options-template-phrases.php'; ?>

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