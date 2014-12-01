<?php global $post, $wc_core; ?>
<?php $wc_core->wc_options->wc_options_serialized->wc_phrases = $wc_core->wc_db_helper->get_phrases(); ?>
<script type="text/javascript">
//    initialize the validator function
    validator.message['invalid'] = '<?php echo $wc_core->wc_options->wc_options_serialized->wc_phrases['wc_invalid_field']; ?>';
    validator.message['empty'] = '<?php echo $wc_core->wc_options->wc_options_serialized->wc_phrases['wc_error_empty_text']; ?>';
    validator.message['email'] = '<?php echo $wc_core->wc_options->wc_options_serialized->wc_phrases['wc_error_email_text']; ?>';

    jQuery(document).ready(function ($) {
        $(document).delegate('.wc-toggle', 'click', function () {
            var toggleID = $(this).attr('id');
            var uniqueID = toggleID.substring(toggleID.lastIndexOf('-') + 1);
            $('#wc-comm-' + uniqueID + ' .wc-reply').slideToggle(500, function () {
                if ($(this).is(':hidden')) {
                    $('#' + toggleID).html('<?php echo $wc_core->wc_options->wc_options_serialized->wc_phrases['wc_show_replies_text']; ?> &or;');
                } else {
                    $('#' + toggleID).html('<?php echo $wc_core->wc_options->wc_options_serialized->wc_phrases['wc_hide_replies_text']; ?> &and;');
                }
            });
        });

        if ($.cookie('wc_author_name') !== '' && $.cookie('wc_author_email')) {
            $('#wpcomm .wc_name').val($.cookie('wc_author_name'));
            $('#wpcomm .wc_email').val($.cookie('wc_author_email'));
        }
    });
</script>
<?php
$textarea_placeholder = '';
if ($post->comment_count) {
    $textarea_placeholder = $wc_core->wc_options->wc_options_serialized->wc_phrases['wc_comment_join_text'];
} else {
    $textarea_placeholder = $wc_core->wc_options->wc_options_serialized->wc_phrases['wc_comment_start_text'];
}
$unique_id = $post->ID . '_' . 0;
$header_text = $post->comment_count . ' ';
$header_text .= $wc_core->wc_options->wc_options_serialized->wc_phrases['wc_header_text'];
$header_text .= ($post->comment_count > 1) ? $wc_core->wc_options->wc_options_serialized->wc_phrases['wc_plural_text'] : '';
$header_text .= ' ' . $wc_core->wc_options->wc_options_serialized->wc_phrases['wc_header_on_text'];
$header_text .= ' "' . get_the_title($post) . '"';
?>
<div style="clear:both"></div>
<div class="comments-area">
    <h3 class="wc-comment-header"><?php echo $wc_core->wc_options->wc_options_serialized->wc_phrases['wc_leave_a_reply_text']; ?></h3>
    <div id="wpcomm">    
        <p class="wc-comment-title"><?php echo ($post->comment_count) ? $header_text : $wc_core->wc_options->wc_options_serialized->wc_phrases['wc_be_the_first_text']; ?></p>
        <div class="wc-form-wrapper">
            <?php
            if ($wc_core->is_guest_can_comment()) {
                ?>

                <form action="" method="post" id="wc_comm_form-<?php echo $unique_id; ?>" class="wc_comm_form">
                    <div class="wc-field-comment">
                        <div style="width:60px; float:left; position:absolute;">
                            <?php echo $wc_core->wc_helper->get_comment_author_avatar(); ?>                        
                        </div>
                        <div style="margin-left:65px;" class="item"><textarea id="wc_comment-<?php echo $unique_id; ?>" class="wc_comment" name="wc_comment" required="required" placeholder="<?php echo $textarea_placeholder; ?>"></textarea></div>
                        <div style="clear:both"></div>
                    </div>
                    <div id="wc-form-footer-<?php echo $unique_id; ?>" class="wc-form-footer">
                        <?php if (!is_user_logged_in()) { ?>
                            <div class="wc-author-data">
                                <div class="wc-field-name item"><input id="wc_name-<?php echo $unique_id; ?>" class="wc_name" name="wc_name" required="required" value="" type="text" placeholder="<?php echo $wc_core->wc_options->wc_options_serialized->wc_phrases['wc_name_text'] ?>"/></div>
                                <div class="wc-field-email item"><input id="wc_email-<?php echo $unique_id; ?>" class="wc_email email" name="wc_email" required="required" value="" type="email" placeholder="<?php echo $wc_core->wc_options->wc_options_serialized->wc_phrases['wc_email_text']; ?>"/></div>
                                <div style="clear:both"></div>
                            </div>
                        <?php } ?>
                        <div class="wc-form-submit">
                            <?php if (!$wc_core->wc_options->wc_options_serialized->wc_captcha_show_hide) { ?>
                                <?php if (!is_user_logged_in()) { ?>
                                    <div class="wc-field-captcha item">
                                        <input id="wc_captcha-<?php echo $unique_id; ?>" name="wc_captcha" required="required" value="" type="text" />
                                        <span class="wc-label wc-captcha-label">
                                            <img src="<?php echo plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/captcha/captcha.php?comm_id=' . $post->ID . '-' . 0); ?>" id="wc_captcha_img-<?php echo $unique_id; ?>" />
                                            <img src="<?php echo plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/refresh-16x16.png'); ?>" id="wc_captcha_refresh_img-<?php echo $unique_id; ?>" class="wc_captcha_refresh_img" />
                                        </span>
                                        <span class="captcha_msg"><?php echo $wc_core->wc_options->wc_options_serialized->wc_phrases['wc_captcha_text']; ?></span>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <div class="wc-field-submit"><input type="button" name="submit" value="<?php echo $wc_core->wc_options->wc_options_serialized->wc_phrases['wc_submit_text']; ?>" id="wc_comm-<?php echo $unique_id; ?>" class="wc_comm_submit button alt"/></div>
                            <div style="clear:both"></div>
                        </div>
                    </div>           
                    <input type="hidden" name="wc_home_url" value="<?php echo plugins_url(); ?>" id="wc_home_url" />
                    <input type="hidden" name="wc_plugin_dir_url" value="<?php echo WC_Core::$PLUGIN_DIRECTORY; ?>" id="wc_plugin_dir_url" />
                    <input type="hidden" name="wc_comment_post_ID" value="<?php echo $post->ID; ?>" id="wc_comment_post_ID-<?php echo $unique_id; ?>" />
                    <input type="hidden" name="wc_comment_parent"  value="0" id="wc_comment_parent-<?php echo $unique_id; ?>" />
                </form>
            <?php } else { ?>
                <p class="wc-must-login"><?php echo $wc_core->wc_options->wc_options_serialized->wc_phrases['wc_you_must_be_text']; ?> <a href="<?php echo wp_login_url(); ?>"><?php echo $wc_core->wc_options->wc_options_serialized->wc_phrases['wc_logged_in_text']; ?></a> <?php echo $wc_core->wc_options->wc_options_serialized->wc_phrases['wc_to_post_comment_text']; ?></p>
            <?php } ?>
        </div>
        <hr/>

        <div class="wc-thread-wrapper">
            <?php $wc_parent_comments_count = $wc_core->get_wp_comments(1); ?>
        </div>

        <?php if ($wc_parent_comments_count > $wc_core->wc_options->wc_options_serialized->wc_comment_count) { ?>
            <div class="wc-load-more-submit-wrap">
                <input type="button" name="submit" value="<?php echo $wc_core->wc_options->wc_options_serialized->wc_phrases['wc_load_more_submit_text']; ?>" id="wc-load-more-submit-<?php echo $unique_id; ?>" class="wc-load-more-submit button"/>
                <input type="hidden" name="wc_comments_offset" id="wc_comments_offset" value="1" />
                <input type="hidden" name="wc_parent_per_page" id="wc_parent_per_page" value="<?php echo $wc_core->wc_options->wc_options_serialized->wc_comment_count; ?>" />
                <input type="hidden" name="wc_parent_comments_count" id="wc_parent_comments_count" value="<?php echo $wc_parent_comments_count; ?>" />
            </div>
        <?php } ?>

        <div style="clear:both"></div>
        <div class="by-wpdiscuz"><a href="http://gvectors.com/wpdiscuz/">wpDiscuz</a></div>

        <div id="wc_openModalFormAction" class="modalDialog">
            <div id="wc_response_info" class="wc_modal">
                <div id="wc_response_info_box">
                    <a href="#close" title="Close" class="close">&nbsp;</a>
                    <img width="64" height="64" src="<?php echo plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/loader/ajax-loader-200x200.gif'); ?>" />
                </div>
            </div>
        </div>
    </div>
</div>