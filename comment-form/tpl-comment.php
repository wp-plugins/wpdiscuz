<?php

class WC_Comment_Template_Builder {

    public $wc_helper;
    public $wc_db_helper;
    public $wc_options;
    public $wc_options_serialized;
    private $wc_validate_comment_text_length;

    function __construct($wc_helper, $wc_db_helper, $wc_options, $wc_options_serialized) {
        $this->wc_helper = $wc_helper;
        $this->wc_db_helper = $wc_db_helper;
        $this->wc_options = $wc_options;
        $this->wc_options_serialized = $wc_options_serialized;
        add_action('plugins_loaded', array(&$this->wc_options_serialized, 'init_phrases_on_load'), 2129);
        $this->wc_validate_comment_text_length = (intval($this->wc_options_serialized->wc_comment_text_max_length)) ? 'data-validate-length-range="1,' . $this->wc_options_serialized->wc_comment_text_max_length . '"' : '';
    }

    /**
     * @param type $comment the current comment object
     * @param type $args
     * @return single comment template
     */
    public function get_comment_template($comment, $args, $depth) {
        global $current_user;
        get_currentuserinfo();


        $comment_content = wp_kses($comment->comment_content, $this->wc_helper->wc_allowed_tags);

        $comment_content = $this->wc_helper->make_clickable($comment_content);
        $comment_content = apply_filters('comment_text', $comment_content, $comment, $args);
        $hide_avatar_style = $this->wc_options_serialized->wc_avatar_show_hide ? 'style = "margin-left : 0;"' : '';

        $vote_cls = '';
        $vote_title_text = '';
        $user = get_user_by('id', $comment->user_id);
        $wc_author_class = '';
        $wc_comment_author_url = ('http://' == $comment->comment_author_url) ? '' : $comment->comment_author_url;
        $wc_comment_author_url = esc_url($wc_comment_author_url, array('http', 'https'));
        $wc_comment_author_url = apply_filters('get_comment_author_url', $wc_comment_author_url, $comment->comment_ID, $comment);
        if ($user) {
            $wc_comment_author_url = $wc_comment_author_url ? $wc_comment_author_url : $user->user_url;
            $post = get_post($comment->comment_post_ID);
            if ($user->ID == $post->post_author) {
                $wc_author_class = 'wc-post-author';
                $author_title = $this->wc_options_serialized->wc_phrases['wc_user_title_author_text'];
            } else if (in_array('administrator', $user->roles)) {
                $wc_author_class = 'wc-blog-admin';
                $author_title = $this->wc_options_serialized->wc_phrases['wc_user_title_admin_text'];
            } else {
                $wc_author_class = 'wc-blog-member';
                $author_title = $this->wc_options_serialized->wc_phrases['wc_user_title_member_text'];
            }
        } else {
            $wc_author_class = 'wc-blog-guest';
            $author_title = $this->wc_options_serialized->wc_phrases['wc_user_title_guest_text'];
        }

        if ($this->wc_options_serialized->wc_simple_comment_date) {
            $date_format = get_option('date_format');
            $time_format = get_option('time_format');
            if (WC_Helper::is_posted_today($comment)) {
                $posted_date = $this->wc_options_serialized->wc_phrases['wc_posted_today_text'] . ' ' . mysql2date($time_format, $comment->comment_date);
            } else {
                $posted_date = get_comment_date($date_format, $comment->comment_ID);
            }
        } else {
            $posted_date = $this->wc_helper->dateDiff(time(), strtotime($comment->comment_date_gmt), 2);
        }

        $reply_text = $this->wc_options_serialized->wc_phrases['wc_reply_text'];
        $share_text = $this->wc_options_serialized->wc_phrases['wc_share_text'];
        $comment_wrapper_class = ($comment->comment_parent) ? 'wc-comment wc-reply' : 'wc-comment';
        $textarea_placeholder = $this->get_textarea_placeholder($comment);
        $vote_count_meta = get_comment_meta($comment->comment_ID, 'wpdiscuz_votes', true);
        $vote_count = $vote_count_meta ? $vote_count_meta : 0;
        $unique_id = $this->get_unique_id($comment);

        $wc_author_name = $this->get_author_name($comment);
        $wc_profile_url = $this->get_profile_url($user);

        if ($wc_profile_url) {
            $wc_comm_author_avatar = "<a href='$wc_profile_url'>" . $this->wc_helper->get_comment_author_avatar($comment) . "</a>";
        } else {
            $wc_comm_author_avatar = $this->wc_helper->get_comment_author_avatar($comment);
        }

        if ($wc_comment_author_url) {
            $wc_author_name = "<a href='$wc_comment_author_url'>" . $wc_author_name . "</a>";
        } else {
            if ($wc_profile_url) {
                $wc_author_name = "<a href='$wc_profile_url'>" . $wc_author_name . "</a>";
            }
        }

        $child_comments = get_comments(array(
            'parent' => $comment->comment_ID,
            'status' => 'approve'
        ));

        if (!$this->wc_options_serialized->wc_is_guest_can_vote && !is_user_logged_in()) {
            $vote_cls = ' wc_tooltipster';
            $vote_title_text = $this->wc_options_serialized->wc_phrases['wc_login_to_vote'];
            $vote_up = $vote_title_text;
            $vote_down = $vote_title_text;
        } else {
            $vote_cls = ' wc_vote wc_tooltipster';
            $vote_up = $this->wc_options_serialized->wc_phrases['wc_vote_up'];
            $vote_down = $this->wc_options_serialized->wc_phrases['wc_vote_down'];
        }

        $parent_comment = (!$comment->comment_parent && count($child_comments)) ? ' parnet_comment' : '';

        $wc_visible_parent_comment_ids = isset($args['wc_visible_parent_comment_ids']) ? $args['wc_visible_parent_comment_ids'] : null;
        $comment_content_class = ($wc_visible_parent_comment_ids != null && !in_array($comment->comment_ID, $wc_visible_parent_comment_ids)) ? ' wc_new_loaded_comment' : '';

        $output = '<div id="wc-comm-' . $unique_id . '" class="' . $comment_wrapper_class . ' ' . $wc_author_class . ' ' . $parent_comment . ' wc_comment_level-' . $depth . '">';
        if (!$this->wc_options_serialized->wc_avatar_show_hide) {
            $output .= '<div class="wc-comment-left" id="comment-' . $comment->comment_ID . '">' . $wc_comm_author_avatar;
            if (!$this->wc_options_serialized->wc_author_titles_show_hide) {
                $output .= '<div class="' . $wc_author_class . ' wc-comment-label">' . $author_title . '</div>';
            }
            if (class_exists('userpro_api') && $comment->user_id) {
                $output .= userpro_show_badges($comment->user_id, $inline = true);
            }
            $output .= '</div>';
        }
        $output .= '<div class="wc-comment-right ' . $comment_content_class . '" ' . $hide_avatar_style . '>';
        $output .= '<div class="wc-comment-header"><div class="wc-comment-author">' . $wc_author_name . '</div><div class="wc-comment-date">' . $posted_date . '</div><div style="clear:both"></div></div>';
        $output .= '<div class="wc-comment-text">' . $comment_content . '</div>';
        $output .= '<div class="wc-comment-footer">';
        if (!$this->wc_options_serialized->wc_voting_buttons_show_hide) {
            $output .= '<div id="vote-count-' . $unique_id . '" class="wc-vote-result">' . $vote_count . '</div>';
            $output .= ' <span id="wc-up-' . $unique_id . '" class="wc-vote-link wc-up ' . $vote_cls . '" title="' . $vote_up . '"><img src="' . plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/thumbs-up.png') . '"  align="absmiddle" class="wc-vote-img-up" /></span> &nbsp;|&nbsp; <span id="wc-down-' . $unique_id . '" class="wc-vote-link wc-down ' . $vote_cls . '" title="' . $vote_down . '"><img src="' . plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/thumbs-down.png') . '"  align="absmiddle" class="wc-vote-img-down" /></span>&nbsp;';
        }

        if (comments_open($comment->comment_post_ID)) {
            if ($this->wc_options_serialized->wc_user_must_be_registered) {
                if (!$this->wc_options_serialized->wc_reply_button_members_show_hide && is_user_logged_in()) {
                    $output .= '&nbsp;&nbsp;<span id="wc-comm-reply-' . $unique_id . '" class="wc-reply-link" title="' . $reply_text . '">' . $reply_text . '</span> &nbsp;&nbsp;';
                } else if ($this->is_user_can_reply_by_role('administrator')) {
                    $output .= '&nbsp;&nbsp;<span id="wc-comm-reply-' . $unique_id . '" class="wc-reply-link" title="' . $reply_text . '">' . $reply_text . '</span> &nbsp;&nbsp;';
                }
            } else {
                if (!$this->wc_options_serialized->wc_reply_button_members_show_hide && !$this->wc_options_serialized->wc_reply_button_guests_show_hide) {
                    $output .= '&nbsp;&nbsp;<span id="wc-comm-reply-' . $unique_id . '" class="wc-reply-link" title="' . $reply_text . '">' . $reply_text . '</span> &nbsp;&nbsp;';
                } else if (!$this->wc_options_serialized->wc_reply_button_members_show_hide && is_user_logged_in()) {
                    $output .= '&nbsp;&nbsp;<span id="wc-comm-reply-' . $unique_id . '" class="wc-reply-link" title="' . $reply_text . '">' . $reply_text . '</span> &nbsp;&nbsp;';
                } else if (!$this->wc_options_serialized->wc_reply_button_guests_show_hide && !is_user_logged_in()) {
                    $output .= '&nbsp;&nbsp;<span id="wc-comm-reply-' . $unique_id . '" class="wc-reply-link" title="' . $reply_text . '">' . $reply_text . '</span> &nbsp;&nbsp;';
                } else if ($this->is_user_can_reply_by_role('administrator')) {
                    $output .= '&nbsp;&nbsp;<span id="wc-comm-reply-' . $unique_id . '" class="wc-reply-link" title="' . $reply_text . '">' . $reply_text . '</span> &nbsp;&nbsp;';
                }
            }
        }

        if (!$this->wc_options_serialized->wc_share_buttons_show_hide) {
            $output .= '-&nbsp;&nbsp; <span id="wc-comm-share-' . $unique_id . '" class="wc-share-link" title="' . $share_text . '">' . $share_text . '</span> &nbsp;&nbsp;';

            $twitt_content = strip_tags($comment_content) . ' ' . get_comment_link($comment);

            $output .= '<span id="share_buttons_box-' . $unique_id . '" class="share_buttons_box">';
            $output .= '<a target="_blank" href="http://www.facebook.com/sharer.php" title="' . $this->wc_options_serialized->wc_phrases['wc_share_facebook'] . '"><img src="' . plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/social-icons/fb-18x18.png') . '" onmouseover="this.src=\'' . plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/social-icons/fb-18x18-orig.png') . '\'" onmouseout="this.src=\'' . plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/social-icons/fb-18x18.png') . '\'"/></a>&nbsp;&nbsp;';
            $output .= '<a target="_blank" href="https://twitter.com/home?status=' . $twitt_content . '" title="' . $this->wc_options_serialized->wc_phrases['wc_share_twitter'] . '"><img src="' . plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/social-icons/twitter-18x18.png') . '" onmouseover="this.src=\'' . plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/social-icons/twitter-18x18-orig.png') . '\'" onmouseout="this.src=\'' . plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/social-icons/twitter-18x18.png') . '\'"/></a>&nbsp;&nbsp;';
            $output .= '<a target="_blank" href="https://plus.google.com/share?url=' . get_permalink($comment->comment_post_ID) . '" title="' . $this->wc_options_serialized->wc_phrases['wc_share_google'] . '"><img src="' . plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/social-icons/google-18x18.png') . '" onmouseover="this.src=\'' . plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/social-icons/google-18x18-orig.png') . '\'" onmouseout="this.src=\'' . plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/social-icons/google-18x18.png') . '\'"/></a>&nbsp;&nbsp;';
            $output .= '<a target="_blank" href="http://vk.com/share.php?url=' . get_permalink($comment->comment_post_ID) . '" title="' . $this->wc_options_serialized->wc_phrases['wc_share_vk'] . '"><img src="' . plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/social-icons/vk-18x18.png') . '" onmouseover="this.src=\'' . plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/social-icons/vk-18x18-orig.png') . '\'" onmouseout="this.src=\'' . plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/social-icons/vk-18x18.png') . '\'"/></a>&nbsp;&nbsp;';
            $output .= '<a target="_blank" href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl=' . get_permalink($comment->comment_post_ID) . '" title="' . $this->wc_options_serialized->wc_phrases['wc_share_ok'] . '"><img src="' . plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/social-icons/ok-18x18.png') . '" onmouseover="this.src=\'' . plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/social-icons/ok-18x18-orig.png') . '\'" onmouseout="this.src=\'' . plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/social-icons/ok-18x18.png') . '\'"/></a>&nbsp;&nbsp;';
            $output .= '</span>';
        }

        if (current_user_can('edit_comment', $comment->comment_ID)) {
            $output .= '-&nbsp;&nbsp; <a href="' . get_edit_comment_link($comment->comment_ID) . '">' . __('Edit', 'default') . '</a>';
        } else {
            if ($this->wc_helper->is_comment_editable($comment) && $current_user->ID && $current_user->ID == $comment->user_id) {
                $output .= '<span id="wc_editable_comment-' . $unique_id . '" class="wc_editable_comment">-&nbsp;&nbsp;' . $this->wc_options_serialized->wc_phrases['wc_edit_text'] . '</span>';
                $output .= '<span id="wc_cancel_edit-' . $unique_id . '" class="wc_cancel_edit">-&nbsp;&nbsp;' . $this->wc_options_serialized->wc_phrases['wc_comment_edit_cancel_button'] . '</span>';
                $output .= '<span id="wc_save_edited_comment-' . $unique_id . '" class="wc_save_edited_comment" style="display:none;">&nbsp;&nbsp;-&nbsp;&nbsp;' . $this->wc_options_serialized->wc_phrases['wc_comment_edit_save_button'] . '</span>';
            }
        }

        $visibility = 'none';
        if (!$comment->comment_parent && count($child_comments)) {
            $visibility = 'block';
            $output .= '<span id="wc-toggle-' . $unique_id . '" class="wc-toggle" style="display:' . $visibility . ';">' . $this->wc_options_serialized->wc_phrases['wc_hide_replies_text'] . ' &and;</span>';
        }

        $output .= '</div>';
        $output .= '</div>';
        $output .= '<div style="clear:both"></div>';

        $output_form = '';

        if (comments_open($comment->comment_post_ID)) {

            $output_form = '<div class="wc-form-wrapper wc-secondary-forms-wrapper" id="wc-secondary-forms-wrapper-' . $unique_id . '">';
            $output_form .= '<div class="wc-secondary-forms-social-content" id="wc-secondary-forms-social-content-' . $unique_id . '"></div>';
            $output_form .= '<form action="" method="post" id="wc_comm_form-' . $unique_id . '" class="wc_comm_form wc_secondary_form"><div class="wc-field-comment">';
            if (!$this->wc_options_serialized->wc_avatar_show_hide) {
                $output_form .= '<div class="wc-field-avatararea">' .  $this->wc_helper->wc_form_avatar . '</div>';
            }
            $output_form .= '<div class="wc-field-textarea wpdiscuz-item" ' . $hide_avatar_style . '><textarea ' . $this->wc_validate_comment_text_length . ' id="wc_comment-' . $unique_id . '" class="wc_comment wc_field_input" name="wc_comment" required="required" placeholder="' . $textarea_placeholder . '"></textarea></div><div style="clear:both"></div></div>';

            $output_form .= '<div id="wc-form-footer-' . $unique_id . '" class="wc-form-footer">';

            if (!is_user_logged_in()) {
                $wc_is_name_field_required = ($this->wc_options_serialized->wc_is_name_field_required) ? 'required="required"' : '';
                $wc_is_email_field_required = ($this->wc_options_serialized->wc_is_email_field_required) ? 'required="required"' : '';

                $output_form .= '<div class="wc-author-data">';
                $output_form .= '<div class="wc-field-name wpdiscuz-item">';
                $output_form .= '<input id="wc_name-' . $unique_id . '" name="wc_name" class="wc_name wc_field_input" ' . $wc_is_name_field_required . ' value="" type="text" placeholder="' . $this->wc_options_serialized->wc_phrases['wc_name_text'] . '"/>';
                $output_form .= '</div>';
                $output_form .= '<div class="wc-field-email wpdiscuz-item">';
                $output_form .= '<input id="wc_email-' . $unique_id . '" class="wc_email wc_field_input email" name="wc_email" ' . $wc_is_email_field_required . ' value="" type="email" placeholder="' . $this->wc_options_serialized->wc_phrases['wc_email_text'] . '"/>';
                $output_form .= '</div>';
                $output_form .= '<div style="clear:both"></div>';
                $output_form .= '</div>';
            }

            $output_form .= '<div class="wc-form-submit">';

            if (!$this->wc_options_serialized->wc_captcha_show_hide) {
                if (!is_user_logged_in()) {
                    $output_form .= '<div class="wc-field-captcha wpdiscuz-item">';
                    $output_form .= '<input id="wc_captcha-' . $unique_id . '" class="wc_field_input wc_field_captcha" name="wc_captcha" required="required" value="" type="text" maxlength="5" /><span class="wc-label wc-captcha-label">';
                    $output_form .= '<img rel="nofollow" noimageindex src="' . plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/captcha/captcha.php?comm_id=' . $comment->comment_post_ID . '-' . $comment->comment_ID) . '" id="wc_captcha_img-' . $unique_id . '" />';
                    $output_form .= '<img rel="nofollow" noimageindex src="' . plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/refresh-16x16.png') . '" id="wc_captcha_refresh_img-' . $unique_id . '" class="wc_captcha_refresh_img" />';
                    $output_form .= '</span><span class="captcha_msg">' . $this->wc_options_serialized->wc_phrases['wc_captcha_text'] . '</span></div>';
                }
            }

            $output_form .= '<div class="wc-field-submit">';
            if (!is_user_logged_in() && !$this->wc_options_serialized->wc_weburl_show_hide) {
                $output_form .= '<div class="wc-field-website wpdiscuz-item">';
                $output_form .= '<input id="wc_website-' . $unique_id . '" class="wc_website wc_field_input" name="wc_website" value="" type="url" placeholder="' . $this->wc_options_serialized->wc_phrases['wc_website_text'] . '"/>';
                $output_form .= '</div>';
            }
            $output_form .= '<input type="button" name="submit" value="' . $this->wc_options_serialized->wc_phrases['wc_submit_text'] . '" id="wc_comm-' . $unique_id . '" class="wc_comm_submit button alt"/>';
            $output_form .= '</div>';
            $output_form .= '<div style="clear:both"></div>';

            if ($this->wc_options_serialized->wc_show_hide_comment_checkbox || $this->wc_options_serialized->wc_show_hide_reply_checkbox || $this->wc_options_serialized->wc_show_hide_all_reply_checkbox) {
                $output_form .= '<span class="wc_manage_subscribtions" ' . ((class_exists('Prompt_Comment_Form_Handling') && $this->wc_options_serialized->wc_use_postmatic_for_comment_notification) ? 'style="display:none"' : '') . '>' . $this->wc_options_serialized->wc_phrases['wc_manage_subscribtions'] . ' &or;</span>';
            }

            $output_form .= '<div class="wc_notification_checkboxes" ' . ((class_exists('Prompt_Comment_Form_Handling') && $this->wc_options_serialized->wc_use_postmatic_for_comment_notification) ? 'style="display:block"' : '') . '>';


            $wc_is_user_subscription_confirmed = $this->wc_db_helper->wc_is_user_subscription_confirmed($comment->comment_post_ID, $current_user->user_email);
            $wc_subscription_phrase = ($wc_is_user_subscription_confirmed == 1) ? $this->wc_options_serialized->wc_phrases['wc_unsubscribe'] : $this->wc_options_serialized->wc_phrases['wc_ignore_subscription'];

            if ($this->wc_options_serialized->wc_comment_reply_checkboxes_default_checked == 1) {
                $none_status = '';
                $post_sub_status = 'checked="checked"';
            } else {
                $none_status = 'checked="checked"';
                $post_sub_status = '';
            }

            if (class_exists('Prompt_Comment_Form_Handling') && $this->wc_options_serialized->wc_use_postmatic_for_comment_notification) {
                $output_form .= '<input id="wc_notification_new_comment-' . $unique_id . '" class="wc_notification_new_comment" value="wc_notification_new_comment" ' . $post_sub_status . 'type="checkbox" name="wc_comment_reply_notification-' . $unique_id . '"/> <label class="wc-label-comment-notify" for="wc_notification_new_comment-' . $unique_id . '">' . __('Participate in this discussion via email',  WC_Core::$TEXT_DOMAIN) . '</label>';
            } else {
                if ($current_user->ID && $this->wc_db_helper->wc_has_post_notification($comment->comment_post_ID, $current_user->user_email)) {
                    $wc_confirmation_phrase = ($wc_is_user_subscription_confirmed == 1) ? $this->wc_options_serialized->wc_phrases['wc_subscribed_on_post'] : $this->wc_options_serialized->wc_phrases['wc_confirm_email'];
                    $output_form .= '<label class="wc-label-comment-notify" style="cursor: default;">' . $wc_confirmation_phrase . ' | <a href="' . $this->wc_db_helper->wc_unsubscribe_link($comment->comment_post_ID, $current_user->user_email, 'post') . '" rel="nofollow" class="unsubscribe">' . $wc_subscription_phrase . '</a></label>';
                } else {
                    if ($current_user->ID && $this->wc_db_helper->wc_has_all_comments_notification($comment->comment_post_ID, $current_user->user_email) && $current_user->user_email == $comment->comment_author_email) {
                        $wc_confirmation_phrase = ($wc_is_user_subscription_confirmed == 1) ? $this->wc_options_serialized->wc_phrases['wc_subscribed_on_all_comment'] : $this->wc_options_serialized->wc_phrases['wc_confirm_email'];
                        $output_form .= '<label class="wc-label-all-reply-notify" style="cursor: default;">' . $wc_confirmation_phrase . ' | <a href="' . $this->wc_db_helper->wc_unsubscribe_link($comment->comment_post_ID, $current_user->user_email, 'all_comment') . '" rel="nofollow" class="unsubscribe">' . $wc_subscription_phrase . '</a></label><br/>';
                    } else {
                        if ($current_user->ID && $this->wc_db_helper->wc_has_comment_notification($comment->comment_post_ID, $comment->comment_ID, $current_user->user_email) && $current_user->user_email == $comment->comment_author_email) {
                            $wc_confirmation_phrase = ($wc_is_user_subscription_confirmed == 1) ? $this->wc_options_serialized->wc_phrases['wc_subscribed_on_comment'] : $this->wc_options_serialized->wc_phrases['wc_confirm_email'];
                            $output_form .= '<label class="wc-label-reply-notify" style="cursor: default;">' . $wc_confirmation_phrase . ' | <a href="' . $this->wc_db_helper->wc_unsubscribe_link($comment->comment_ID, $current_user->user_email, 'comment') . '" rel="nofollow" class="unsubscribe">' . $wc_subscription_phrase . '</a></label><br/>';
                        } else {
                            if ($this->wc_options_serialized->wc_show_hide_reply_checkbox || $this->wc_options_serialized->wc_show_hide_all_reply_checkbox || $this->wc_options_serialized->wc_show_hide_comment_checkbox) {
                                $output_form .= '<input id="wc_notification_none-' . $unique_id . '" class="wc_notification_none" ' . $none_status . ' value="wc_notification_none" type="radio" name="wc_comment_reply_notification-' . $unique_id . '"/> <label class="wc-notification-none" for="wc_notification_none-' . $unique_id . '">' . $this->wc_options_serialized->wc_phrases['wc_notify_none'] . '</label><br />';
                            }
                            if ($this->wc_options_serialized->wc_show_hide_reply_checkbox) {
                                $output_form .= '<input class="wc-label-reply-notify wc_notification_new_reply" id="wc_notification_new_reply-' . $unique_id . '" value="wc_notification_new_reply" type="radio" name="wc_comment_reply_notification-' . $unique_id . '"/> <label class="wc-label-comment-notify" for="wc_notification_new_reply-' . $unique_id . '">' . $this->wc_options_serialized->wc_phrases['wc_notify_on_new_reply'] . '</label><br />';
                            }
                            if ($this->wc_options_serialized->wc_show_hide_all_reply_checkbox) {
                                $output_form .= '<input id="wc_notification_all_new_reply-' . $unique_id . '" class="wc_notification_all_new_reply" value="wc_notification_all_new_reply" type="radio" name="wc_comment_reply_notification-' . $unique_id . '"/> <label class="wc-label-all-reply-notify" for="wc_notification_all_new_reply-' . $unique_id . '">' . $this->wc_options_serialized->wc_phrases['wc_notify_on_all_new_reply'] . '</label><br />';
                            }

                            if ($this->wc_options_serialized->wc_show_hide_comment_checkbox) {
                                $output_form .= '<input class="wc-label-comment-notify wc_notification_new_comment" id="wc_notification_new_comment-' . $unique_id . '" ' . $post_sub_status . ' value="wc_notification_new_comment" type="radio" name="wc_comment_reply_notification-' . $unique_id . '"/> <label class="wc-label-comment-notify" for="wc_notification_new_comment-' . $unique_id . '">' . $this->wc_options_serialized->wc_phrases['wc_notify_on_new_comment'] . '</label>';
                            }
                        }
                    }
                }
            }

            $output_form .= '</div>';
            $output_form .= '</div>';
            $output_form .= '</div>';

            $output_form .= '<input type="hidden" name="wc_home_url" value="' . plugins_url() . '" id="wc_home_url-' . $unique_id . '" />';
            $output_form .= '<input type="hidden" name="wc_comment_post_ID" value="' . $comment->comment_post_ID . '" id="wc_comment_post_ID-' . $unique_id . '" />';
            $output_form .= '<input type="hidden" name="wc_comment_parent" value="' . $comment->comment_ID . '" id="wc_comment_parent-' . $unique_id . '" />';

            $output_form .= '</form>';
            $output_form .= '</div>';
        }

        if ($this->wc_options_serialized->wc_user_must_be_registered) {
            if (!$this->wc_options_serialized->wc_reply_button_members_show_hide && is_user_logged_in()) {
                $output .= $output_form;
            } else if ($this->is_user_can_reply_by_role('administrator')) {
                $output .= $output_form;
            }
        } else {
            if (!$this->wc_options_serialized->wc_reply_button_members_show_hide && !$this->wc_options_serialized->wc_reply_button_guests_show_hide) {
                $output .= $output_form;
            } else if (!$this->wc_options_serialized->wc_reply_button_members_show_hide && is_user_logged_in()) {
                $output .= $output_form;
            } else if (!$this->wc_options_serialized->c_reply_button_guests_show_hide && !is_user_logged_in()) {
                $output .=

                        $output_form;
            } else if ($this->is_user_can_reply_by_role('administrator')) {
                $output .= $output_form;
            }
        }

        return $output;
    }

    /**
     * User can comment in product  by role
     */
    private function is_user_can_reply_by_role($role) {
        $user_can_comment = FALSE;
        if (is_user_logged_in()) {

            $current_user = wp_get_current_user();
            $roles = $current_user->roles;
            if (in_array($role, $roles)) {
                $user_can_comment = TRUE;
            }
        }
        return $user_can_comment;
    }

    /**
     * 
     * get profile url 
     */
    private function get_profile_url($user) {
        $wc_profile_url = '';
        $wc_profile_url_filter = '';
        if ($user) {
            if (class_exists('BuddyPress')) {
                $wc_profile_url = bp_core_get_user_domain($user->ID);
            } else if (class_exists('XooUserUltra')) {
                global $xoouserultra;
                $wc_profile_url = $xoouserultra->userpanel->get_user_profile_permalink($user->ID);
            } else if (class_exists('userpro_api')) {
                global $userpro;
                $wc_profile_url = $userpro->permalink($user->ID);
            } else if (class_exists('UM_API')) {
                um_fetch_user($user->ID);
                $wc_profile_url = um_user_profile_url();
            } else {
                if (count_user_posts($user->ID)) {
                    $wc_profile_url = get_author_posts_url($user->ID);
                }
            }
            $user_id = $user->ID;
            $wc_profile_url_data = apply_filters('wpdiscuz_profile_url', array('user_id' => $user_id, 'permalink' => ''));

            $wc_profile_url_filter = $wc_profile_url_data['permalink'];
        }

        return $wc_profile_url_filter ? $wc_profile_url_filter : $wc_profile_url;
    }

    public function get_author_name($comment) {
        if (class_exists('UM_API') && isset($comment->user_id) && !empty($comment->user_id)) {
            um_fetch_user($comment->user_id);
            $author_name = um_user('display_name');
            um_reset_user();
        } else {
            $author_name = $comment->comment_author ? $comment->comment_author : __('Anonymous', WC_Core::$TEXT_DOMAIN);
        }
        return $author_name;
    }

    /**
     * returns placeholder for textarea from options page phrases
     */
    public function get_textarea_placeholder($comment) {
        $post = get_post($comment->comment_post_ID);
        if ($post->comment_count) {
            $textarea_placeholder = $this->wc_options_serialized->wc_phrases['wc_comment_join_text'];
        } else {

            $textarea_placeholder = $this->wc_options_serialized->wc_phrases['wc_comment_start_text'];
        }
        return $textarea_placeholder;
    }

    /**
     * returns unique id based on comment and post ids
     */
    public function get_unique_id($comment) {
        $unique_id = $comment->
                comment_post_ID . '_' . $comment->comment_ID;
        return $unique_id;
    }

    /**
     * set wpc helper
     */
    public function set_wc_helper(
    $wc_helper) {
        $this->wc_helper = $wc_helper;
    }

    /**
     * set db helper
     */
    public function set_wc_db_helper($wc_db_helper) {
        $this->wc_db_helper = $wc_db_helper;
    }

    /**
     * set wpc options
     */
    public function set_wc_options($wc_options) {
        $this->wc_options = $wc_options;
    }

}

?>