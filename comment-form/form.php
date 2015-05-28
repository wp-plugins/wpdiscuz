<?php
global $post, $wc_core, $current_user;
get_currentuserinfo();

error_reporting(0);
$wc_core->wc_options_serialized->init_phrases_on_load();
$wc_comment_list_update_type = $wc_core->wc_options_serialized->wc_comment_list_update_type;
$wc_form_avatar = $wc_core->wc_helper->get_comment_author_avatar();
?>
<script type="text/javascript">
//    initialize the wpdiscuzValidator function
    wpdiscuzValidator.message['invalid'] = '<?php echo $wc_core->wc_options_serialized->wc_phrases['wc_invalid_field']; ?>';
    wpdiscuzValidator.message['empty'] = '<?php echo $wc_core->wc_options_serialized->wc_phrases['wc_error_empty_text']; ?>';
    wpdiscuzValidator.message['email'] = '<?php echo $wc_core->wc_options_serialized->wc_phrases['wc_error_email_text']; ?>';
    wpdiscuzValidator.message['url'] = '<?php echo $wc_core->wc_options_serialized->wc_phrases['wc_error_url_text']; ?>';
    wpdiscuzValidator.message['max'] = '<?php echo sprintf($wc_core->wc_options_serialized->wc_phrases['wc_msg_comment_text_max_length'], $wc_core->wc_options_serialized->wc_comment_text_max_length); ?>';

    jQuery(document).ready(function ($) {
        $(document).delegate('.wc-toggle', 'click', function () {
            var toggleID = $(this).attr('id');
            var uniqueID = toggleID.substring(toggleID.lastIndexOf('-') + 1);
            $('#wc-comm-' + uniqueID + ' .wc-reply').slideToggle(500, function () {
                if ($(this).is(':hidden')) {
                    $('#' + toggleID).html('<?php echo $wc_core->wc_options_serialized->wc_phrases['wc_show_replies_text']; ?> &or;');
                } else {
                    $('#' + toggleID).html('<?php echo $wc_core->wc_options_serialized->wc_phrases['wc_hide_replies_text']; ?> &and;');
                }
            });
        });

        if ($.cookie('wc_author_name') !== '' && $.cookie('wc_author_email')) {
            $('#wpcomm .wc_name').val($.cookie('wc_author_name'));
            $('#wpcomm .wc_email').val($.cookie('wc_author_email'));
        }

        $('#wc_unsubscribe_message').delay(7000).fadeOut(1500, function () {
            $(this).remove();
        });

    });
</script>
<?php
$textarea_placeholder = '';
if ($post->comment_count) {
    $textarea_placeholder = $wc_core->wc_options_serialized->wc_phrases['wc_comment_join_text'];
} else {
    $textarea_placeholder = $wc_core->wc_options_serialized->wc_phrases['wc_comment_start_text'];
}
$unique_id = $post->ID . '_' . 0;
$header_text = '<span class="wc_header_text_count">' . $post->comment_count . '</span> ';
$header_text .= ($post->comment_count > 1) ? $wc_core->wc_options_serialized->wc_phrases['wc_header_text_plural'] : $wc_core->wc_options_serialized->wc_phrases['wc_header_text'];
$header_text .= ' ' . $wc_core->wc_options_serialized->wc_phrases['wc_header_on_text'];
$header_text .= ' "' . get_the_title($post) . '"';

$wc_is_name_field_required = ($wc_core->wc_options_serialized->wc_is_name_field_required) ? 'required="required"' : '';
$wc_is_email_field_required = ($wc_core->wc_options_serialized->wc_is_email_field_required) ? 'required="required"' : '';

if( ini_get('output_buffering') ){ $wc_ob_allowed = true; ob_start(); do_action('comment_form_top'); $wc_comment_form_top_content = ob_get_contents(); ob_clean(); $wc_comment_form_top_content = wpdiscuz_close_divs($wc_comment_form_top_content); } else{ $wc_ob_allowed = false; }
$wc_validate_comment_text_length = (intval($wc_core->wc_options_serialized->wc_comment_text_max_length)) ? 'data-validate-length-range="1,' . $wc_core->wc_options_serialized->wc_comment_text_max_length . '"' : '';
?>
<div style="clear:both"></div>

<?php if (comments_open($post->ID)) { ?>
    <div id="comments" class="comments-area">
        <?php
        if (isset($_GET['wpdiscuzSubscribeID']) && isset($_GET['key'])) {
            $wc_core->wc_unsubscribe($_GET['wpdiscuzSubscribeID'], $_GET['key']);
            ?>
            <div id="wc_unsubscribe_message">
                <span class="wc_unsubscribe_message"><?php echo $wc_core->wc_options_serialized->wc_phrases['wc_unsubscribe_message']; ?></span>
            </div>
            <?php
        }
        ?>

        <?php
        if (isset($_GET['wpdiscuzConfirmID']) && isset($_GET['wpdiscuzConfirmKey']) && isset($_GET['wpDiscuzComfirm'])) {
            $wc_core->wc_db_helper->wc_notification_confirm($_GET['wpdiscuzConfirmID'], $_GET['wpdiscuzConfirmKey']);
            ?>
            <div id="wc_unsubscribe_message">
                <span class="wc_unsubscribe_message"><?php echo $wc_core->wc_options_serialized->wc_phrases['wc_comfirm_success_message']; ?></span>
            </div>
            <?php
        }
        ?>

        <?php if (comments_open($post->ID)) { ?>
            <h3 id="wc-comment-header"><?php echo $wc_core->wc_options_serialized->wc_phrases['wc_leave_a_reply_text']; ?></h3>    
        <?php } ?>
        <?php
        if ($wc_core->wc_options_serialized->wc_show_hide_loggedin_username) {
            if (is_user_logged_in()) {
                global $current_user;
                get_currentuserinfo();
                $user_url = get_author_posts_url($current_user->ID);
                ?>
                <div id="wc_show_hide_loggedin_username">
                    <span class="wc_show_hide_loggedin_username">
                        <?php echo $wc_core->wc_options_serialized->wc_phrases['wc_logged_in_as'] . ' <a href="' . $user_url . '">' . $current_user->display_name . '</a> | <a href="' . wp_logout_url() . '">' . $wc_core->wc_options_serialized->wc_phrases['wc_log_out'] . '</a>'; ?> 
                    </span>
                </div>
                <?php
            }
        }
        ?>
        <div id="wpcomm">
            <?php if (!$wc_core->wc_options_serialized->wc_header_text_show_hide) { ?>
                <div class="wc-comment-bar">
                    <p class="wc-comment-title">
                        <?php echo ($post->comment_count) ? $header_text : $wc_core->wc_options_serialized->wc_phrases['wc_be_the_first_text']; ?>
                    </p>
                    <div style="clear:both"></div>
                </div> 
            <?php } ?>
            <?php do_action('comment_form_before'); ?>
            <div class="wc_social_plugin_wrapper">
                <?php if( $wc_ob_allowed ){ echo $wc_comment_form_top_content; } else{ do_action('comment_form_top'); }?>
            </div>
            <div class="wc-form-wrapper">
                <?php
                if ($wc_core->is_guest_can_comment()) {
                    ?>

                    <form action="" method="post" id="wc_comm_form-<?php echo $unique_id; ?>" class="wc_comm_form wc_main_comm_form">
                        <div class="wc-field-comment">
                            <?php if (!$wc_core->wc_options_serialized->wc_avatar_show_hide) { ?>
                                <div class="wc-field-avatararea">
                                    <?php echo $wc_form_avatar; ?>                        
                                </div>
                            <?php } ?>
                            <div class="wpdiscuz-item wc-field-textarea" <?php
                            if ($wc_core->wc_options_serialized->wc_avatar_show_hide) {
                                echo ' style="margin-left: 0;"';
                            }
                            ?>><textarea <?php echo $wc_validate_comment_text_length; ?> id="wc_comment-<?php echo $unique_id; ?>" class="wc_comment wc_field_input" name="wc_comment" required="required" placeholder="<?php echo $textarea_placeholder; ?>"></textarea></div>
                            <div style="clear:both"></div>
                        </div>
                        <div id="wc-form-footer-<?php echo $unique_id; ?>" class="wc-form-footer">
                            <?php if (!is_user_logged_in()) { ?>
                                <div class="wc-author-data">
                                    <div class="wc-field-name wpdiscuz-item"><input id="wc_name-<?php echo $unique_id; ?>" class="wc_name wc_field_input" name="wc_name" <?php echo $wc_is_name_field_required; ?> value="" type="text" placeholder="<?php echo $wc_core->wc_options_serialized->wc_phrases['wc_name_text'] ?>"/></div>
                                    <div class="wc-field-email wpdiscuz-item"><input id="wc_email-<?php echo $unique_id; ?>" class="wc_email wc_field_input email" name="wc_email" <?php echo $wc_is_email_field_required; ?> value="" type="email" placeholder="<?php echo $wc_core->wc_options_serialized->wc_phrases['wc_email_text']; ?>"/></div>
                                    <div style="clear:both"></div>
                                </div>
                            <?php } ?>
                            <div class="wc-form-submit">
                                <?php if (!$wc_core->wc_options_serialized->wc_captcha_show_hide) { ?>
                                    <?php if (!is_user_logged_in()) { ?>
                                        <div class="wc-field-captcha wpdiscuz-item">
                                            <input id="wc_captcha-<?php echo $unique_id; ?>" class="wc_field_input wc_field_captcha" name="wc_captcha" required="required" value="" type="text" maxlength="5"/>
                                            <span class="wc-label wc-captcha-label">
                                                <img src="<?php echo plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/captcha/captcha.php?comm_id=' . $post->ID . '-' . 0); ?>" id="wc_captcha_img-<?php echo $unique_id; ?>" rel="nofollow" noimageindex />
                                                <img src="<?php echo plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/refresh-16x16.png'); ?>" id="wc_captcha_refresh_img-<?php echo $unique_id; ?>" class="wc_captcha_refresh_img" rel="nofollow" noimageindex/>
                                            </span>
                                            <span class="captcha_msg"><?php echo $wc_core->wc_options_serialized->wc_phrases['wc_captcha_text']; ?></span>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                                <div class="wc-field-submit">
                                    <?php if (!is_user_logged_in() && !$wc_core->wc_options_serialized->wc_weburl_show_hide) { ?>
                                        <div class="wc-field-website wpdiscuz-item"><input id="wc_website-<?php echo $unique_id; ?>" class="wc_website wc_field_input" name="wc_website" value="" type="url" placeholder="<?php echo $wc_core->wc_options_serialized->wc_phrases['wc_website_text'] ?>"/></div>
                                    <?php } ?>
                                    <input type="button" name="submit" value="<?php echo $wc_core->wc_options_serialized->wc_phrases['wc_submit_text']; ?>" id="wc_comm-<?php echo $unique_id; ?>" class="wc_comm_submit button alt"/>
                                </div>
                                <div style="clear:both"></div>
                            </div>
                            <?php if ($wc_core->wc_options_serialized->wc_show_hide_comment_checkbox || $wc_core->wc_options_serialized->wc_show_hide_reply_checkbox || $wc_core->wc_options_serialized->wc_show_hide_all_reply_checkbox) { ?>
                                <span class="wc_manage_subscribtions" <?php if (class_exists('Prompt_Comment_Form_Handling') && $wc_core->wc_options_serialized->wc_use_postmatic_for_comment_notification) echo 'style="display:none"' ?>><?php echo $wc_core->wc_options_serialized->wc_phrases['wc_manage_subscribtions']; ?> &or;</span>
                            <?php } ?>
                            <div class="wc_notification_checkboxes" <?php if (class_exists('Prompt_Comment_Form_Handling') && $wc_core->wc_options_serialized->wc_use_postmatic_for_comment_notification) echo 'style="display:block"' ?>>
                                <?php
                                $wc_is_user_subscription_confirmed = $wc_core->wc_db_helper->wc_is_user_subscription_confirmed($post->ID, $current_user->user_email);
                                $wc_subscription_phrase = ($wc_is_user_subscription_confirmed == 1) ? $wc_core->wc_options_serialized->wc_phrases['wc_unsubscribe'] : $wc_core->wc_options_serialized->wc_phrases['wc_ignore_subscription'];

                                if ($wc_core->wc_options_serialized->wc_comment_reply_checkboxes_default_checked == 1) {
                                    $none_status = '';
                                    $post_sub_status = 'checked="checked"';
                                } else {
                                    $none_status = 'checked="checked"';
                                    $post_sub_status = '';
                                }

                                if (class_exists('Prompt_Comment_Form_Handling') && $wc_core->wc_options_serialized->wc_use_postmatic_for_comment_notification) {
                                    ?>
                                    <input id="wc_notification_new_comment-<?php echo $unique_id; ?>" class="wc_notification_new_comment" value="wc_notification_new_comment" <?php echo $post_sub_status; ?> type="checkbox" name="wc_comment_reply_notification-<?php echo $unique_id; ?>"/> <label class="wc-label-comment-notify" for="wc_notification_new_comment-<?php echo $unique_id; ?>"><?php _e('Participate in this discussion via email', WC_Core::$TEXT_DOMAIN); ?></label>
                                    <?php
                                } else {
                                    if ($current_user->ID && $wc_core->wc_db_helper->wc_has_post_notification($post->ID, $current_user->user_email)) {
                                        $wc_confirmation_phrase = ($wc_is_user_subscription_confirmed == 1) ? $wc_core->wc_options_serialized->wc_phrases['wc_subscribed_on_post'] : $wc_core->wc_options_serialized->wc_phrases['wc_confirm_email'];
                                        ?>
                                        <label class="wc-label-comment-notify" style="cursor: default;"><?php echo $wc_confirmation_phrase; ?> | <a href="<?php echo $wc_core->wc_db_helper->wc_unsubscribe_link($post->ID, $current_user->user_email, 'post'); ?>" rel="nofollow" class="unsubscribe"><?php echo $wc_subscription_phrase; ?></a></label>
                                        <?php
                                    } else {
                                        if ($current_user->ID && $wc_core->wc_db_helper->wc_has_all_comments_notification($post->ID, $current_user->user_email)) {
                                            $wc_confirmation_phrase = ($wc_is_user_subscription_confirmed == 1) ? $wc_core->wc_options_serialized->wc_phrases['wc_subscribed_on_all_comment'] : $wc_core->wc_options_serialized->wc_phrases['wc_confirm_email'];
                                            ?>
                                            <label class="wc-label-all-reply-notify" style="cursor: default;"><?php echo $wc_confirmation_phrase; ?> | <a href="<?php echo $wc_core->wc_db_helper->wc_unsubscribe_link($post->ID, $current_user->user_email, 'all_comment'); ?>" rel="nofollow" class="unsubscribe"><?php echo $wc_subscription_phrase; ?></a></label><br/>
                                            <?php
                                        } else {
                                            if ($wc_core->wc_options_serialized->wc_show_hide_reply_checkbox || $wc_core->wc_options_serialized->wc_show_hide_all_reply_checkbox || $wc_core->wc_options_serialized->wc_show_hide_comment_checkbox) {
                                                ?>
                                                <input id="wc_notification_none-<?php echo $unique_id; ?>" class="wc_notification_none" <?php echo $none_status; ?> value="wc_notification_none" type="radio" name="wc_comment_reply_notification-<?php echo $unique_id; ?>"/> <label class="wc-notification-none" for="wc_notification_none-<?php echo $unique_id; ?>"><?php echo $wc_core->wc_options_serialized->wc_phrases['wc_notify_none']; ?></label><br />
                                                <?php
                                            }
                                            if ($wc_core->wc_options_serialized->wc_show_hide_reply_checkbox) {
                                                ?>
                                                <input id="wc_notification_new_reply-<?php echo $unique_id; ?>" class="wc_notification_new_reply" value="wc_notification_new_reply" type="radio" name="wc_comment_reply_notification-<?php echo $unique_id; ?>"/> <label class="wc-label-reply-notify" for="wc_notification_new_reply-<?php echo $unique_id; ?>"><?php echo $wc_core->wc_options_serialized->wc_phrases['wc_notify_on_new_reply']; ?></label><br />
                                                <?php
                                            }

                                            if ($wc_core->wc_options_serialized->wc_show_hide_all_reply_checkbox) {
                                                ?>
                                                <input id="wc_notification_all_new_reply-<?php echo $unique_id; ?>" class="wc_notification_all_new_reply" value="wc_notification_all_new_reply" type="radio" name="wc_comment_reply_notification-<?php echo $unique_id; ?>"/> <label class="wc-label-all-reply-notify" for="wc_notification_all_new_reply-<?php echo $unique_id; ?>"><?php echo $wc_core->wc_options_serialized->wc_phrases['wc_notify_on_all_new_reply']; ?></label><br />
                                                <?php
                                            }

                                            if ($wc_core->wc_options_serialized->wc_show_hide_comment_checkbox) {
                                                ?>                                
                                                <input id="wc_notification_new_comment-<?php echo $unique_id; ?>" class="wc_notification_new_comment" value="wc_notification_new_comment" <?php echo $post_sub_status; ?> type="radio" name="wc_comment_reply_notification-<?php echo $unique_id; ?>"/> <label class="wc-label-comment-notify" for="wc_notification_new_comment-<?php echo $unique_id; ?>"><?php echo $wc_core->wc_options_serialized->wc_phrases['wc_notify_on_new_comment']; ?></label><br />
                                                <?php
                                            }
                                        }
                                    }
                                }
                                ?>

                            </div>

                        </div> 
                        <input type="hidden" name="wc_comment_post_ID" value="<?php echo $post->ID; ?>" id="wc_comment_post_ID-<?php echo $unique_id; ?>" />
                        <input type="hidden" name="wc_comment_parent"  value="0" id="wc_comment_parent-<?php echo $unique_id; ?>" />
                    </form>

                <?php } else { ?>
                    <p class="wc-must-login"><?php echo $wc_core->wc_options_serialized->wc_phrases['wc_you_must_be_text']; ?> <a href="<?php echo wp_login_url(); ?>"><?php echo $wc_core->wc_options_serialized->wc_phrases['wc_logged_in_text']; ?></a> <?php echo $wc_core->wc_options_serialized->wc_phrases['wc_to_post_comment_text']; ?></p>
                    <?php
                }
                ?>
            </div>
            <?php do_action('comment_form_after'); ?>
            <hr/>
            <?php if ($wc_comment_list_update_type == 2) { ?>
                <div class="wc_new_comment_and_replies">
                    <div class="wc_new_comment"><span class="wc_new_comment_button_text"></span></div>
                    <div class="wc_new_reply"><span class="wc_new_reply_button_text"></span></div>
                    <div style="clear:both"></div>
                </div>
                <div style="clear:both"></div>
            <?php } ?>
        <?php } else { ?>
            <?php if ($post->comment_count > 0) { ?>
                <div class="comments-area" style="border:none;">
                    <?php do_action('comment_form_closed'); ?>
                <?php } else { ?>
                    <div class="comments-area" style="display:none">
                        <?php do_action('comment_form_closed'); ?>
                    <?php } ?>
                    <div id="wpcomm" style="border:none;">    
                    <?php } ?>
                    <div class="wc-thread-wrapper">
                        <?php
                        $wc_wp_comments = $wc_core->get_wp_comments(1);
                        $wc_parent_comments_count = $wc_wp_comments['wc_parent_comments_count'];
                        echo $wc_wp_comments['wc_list'];
                        ?>
                    </div>
                    <span style="display: none;">
                        <input type="hidden" name="wc_home_url" value="<?php echo plugins_url(); ?>" id="wc_home_url" />
                        <input type="hidden" name="wc_plugin_dir_url" value="<?php echo WC_Core::$PLUGIN_DIRECTORY; ?>" id="wc_plugin_dir_url" />
                        <input type="hidden" name="wc_comments_offset" id="wc_comments_offset" value="1" />
                        <input type="hidden" name="wc_parent_per_page" id="wc_parent_per_page" value="<?php echo $wc_core->wc_options_serialized->wc_comment_count; ?>" />
                        <input type="hidden" name="wc_parent_comments_count" id="wc_parent_comments_count" value="<?php echo $wc_parent_comments_count; ?>" />
                        <input type="hidden" name="wc_curr_user_comment_count" id="wc_curr_user_comment_count" class="wc_curr_user_comment_count" value="0" />
                        <?php
                        $wc_all_comments_count_old = $post->comment_count;
                        $wc_last_comment_id = $wc_core->wc_db_helper->get_last_comment_id_by_post_id($post->ID);
                        ?>                            
                        <input type="hidden" name="wc_last_comment_id" value="<?php echo $wc_last_comment_id; ?>" id="wc_last_comment_id" />                    
                        <input type="hidden" name="wc_last_comment_id_before_update" value="<?php echo $wc_last_comment_id; ?>" id="wc_last_comment_id_before_update" />                    
                        <input type="hidden" name="wc_all_comments_count_old" value="<?php echo $wc_all_comments_count_old; ?>" id="wc_all_comments_count_old" />                
                        <input type="hidden" name="wc_comment_list_update_type" value="<?php echo $wc_comment_list_update_type; ?>" id="wc_comment_list_update_type" />                
                        <input type="hidden" name="wc_comment_list_update_timer" value="<?php echo $wc_core->wc_options_serialized->wc_comment_list_update_timer; ?>" id="wc_comment_list_update_timer" />

                        <input type="hidden" name="wc_last_new_comment_id" value="<?php echo $wc_last_comment_id; ?>" id="wc_last_new_comment_id" />
                        <input type="hidden" name="wc_last_new_reply_id" value="<?php echo $wc_last_comment_id; ?>" id="wc_last_new_reply_id" />
                        <input type="hidden" name="wc_comment_reply_checkboxes_default_checked" value="<?php echo $wc_core->wc_options_serialized->wc_comment_reply_checkboxes_default_checked; ?>" id="wc_comment_reply_checkboxes_default_checked" />
                        <input type="hidden" value="<?php echo $post->ID; ?>" id="wpdiscuz_current_post_id"/>
                    </span>
                    <div style="clear:both"></div>
                    <?php if (comments_open($post->ID)) { ?>
                        <?php if ($wc_core->wc_options_serialized->wc_show_plugin_powerid_by) { ?>
                            <div class="by-wpdiscuz"><span id="awpdiscuz" onclick='javascript:document.getElementById("bywpdiscuz").style.display = "inline";
                                            document.getElementById("awpdiscuz").style.display = "none";'><img src="<?php echo plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/plugin-icon/icon_info.png'); ?>" align="absmiddle" class="wpdimg"/></span>&nbsp;<a href="http://gvectors.com/wpdiscuz/" id="bywpdiscuz" title="wpDiscuz v<?php echo get_option($wc_core->wc_version_slug); ?> - Interactive Comment System">wpDiscuz</a></div>
                                                       <?php } ?>
                                                   <?php } ?>
                    <div id="wc_openModalFormAction" class="modalDialog">
                        <div id="wc_response_info" class="wc_modal">
                            <div id="wc_response_info_box">
                                <a href="#close" title="Close" class="close">&nbsp;</a>
                                <img width="64" height="64" src="<?php echo plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/loader/ajax-loader-200x200.gif'); ?>" />
                            </div>
                        </div>
                    </div>
                </div><!-- wpcomm -->
            </div><!-- comments-area -->      
            <?php

            function wpdiscuz_close_divs($html) {
                @preg_match_all('|<div|is', $html, $wc_div_open, PREG_SET_ORDER);
                @preg_match_all('|</div|is', $html, $wc_div_close, PREG_SET_ORDER);
                $wc_div_open = count((array) $wc_div_open);
                $wc_div_close = count((array) $wc_div_close);
                $wc_div_delta = $wc_div_open - $wc_div_close;
                if ($wc_div_delta) {
                    $wc_div_end_html = str_repeat('</div>', $wc_div_delta);
                    $html = $html . $wc_div_end_html;
                }
                //Custom case for social login plugin
                if (strpos('champ_login') !== FALSE) {
                    if (preg_match_all('|<li[^><]*>.+?</li>|is', $html, $wc_social_buttons, PREG_SET_ORDER)) {
                        foreach ($wc_social_buttons as $wc_social_button) {
                            $wc_social_buttons_array[] = $wc_social_button[0];
                        } $html = '<div class="wp-social-login-widget"><div class="wp-social-login-connect-with_by_the_champ">' . __('Connect with') . ':</div><div class="wp-social-login-provider-list"><ul class="wc_social_login_by_the_champ">' . implode('', $wc_social_buttons_array) . '</ul><div style="clear:both"></div></div></div>';
                    }
                }
                return $html;
            }
            ?>