<?php

class WC_Comment_Template_Builder {

    public $wc_helper;
    public $wc_db_helper;
    public $wc_options;

    function __construct($wc_helper, $wc_db_helper, $wc_options) {
        $this->wc_helper = $wc_helper;
        $this->wc_db_helper = $wc_db_helper;
        $this->wc_options = $wc_options;
    }

    /**
     * @param type $comment the current comment object
     * @param type $args
     * @return single comment template
     */
    public function get_comment_template($comment) {
        $comment_content = $comment->comment_content;

        $vote_cls = '';
        $vote_title_text = '';
        $user = get_user_by('id', $comment->user_id);
        if ($user) {
            $post = get_post($comment->comment_post_ID);
            if ($user->ID == $post->post_author) {
                $author_title = $this->wc_options->wc_options_serialized->wc_phrases['wc_user_title_author_text'];
            } else if (in_array('administrator', $user->roles)) {
                $author_title = $this->wc_options->wc_options_serialized->wc_phrases['wc_user_title_admin_text'];
            } else {
                $author_title = $this->wc_options->wc_options_serialized->wc_phrases['wc_user_title_member_text'];
            }
        } else {
            $author_title = $this->wc_options->wc_options_serialized->wc_phrases['wc_user_title_guest_text'];
        }

        $posted_date = $this->wc_helper->dateDiff(time(), strtotime($comment->comment_date_gmt), 2);

        $reply_text = $this->wc_options->wc_options_serialized->wc_phrases['wc_reply_text'];
        $share_text = $this->wc_options->wc_options_serialized->wc_phrases['wc_share_text'];
        $comment_wrapper_class = ($comment->comment_parent) ? 'wc-comment wc-reply' : 'wc-comment';
        $textarea_placeholder = $this->get_textarea_placeholder($comment);

        $vote_count = ($comment->votes) ? $comment->votes : 0;
        $unique_id = $this->get_unique_id($comment);

        $wc_author_name = $comment->comment_author;

        $wc_comm_author_avatar = $this->wc_helper->get_comment_author_avatar($comment);
        $wc_profile_url = $this->get_profile_url($user);


        if ($wc_profile_url) {
            $wc_comm_author_avatar = "<a target='_blank' href='$wc_profile_url'>" . $this->wc_helper->get_comment_author_avatar($comment) . "</a>";
            $wc_author_name = "<a target='_blank' href='$wc_profile_url'>" . $wc_author_name . "</a>";
        }

        $child_comments = get_comments(array(
            'parent' => $comment->comment_ID,
            'status' => 'approve'
        ));

        if (!is_user_logged_in()) {
            $vote_cls = ' wc_tooltipster';
            $vote_title_text = $this->wc_options->wc_options_serialized->wc_phrases['wc_login_to_vote'];
            $vote_up = $vote_title_text;
            $vote_down = $vote_title_text;
        } else {
            $vote_cls = ' wc_vote';
            $vote_up = $this->wc_options->wc_options_serialized->wc_phrases['wc_vote_up'];
            $vote_down = $this->wc_options->wc_options_serialized->wc_phrases['wc_vote_down'];
        }

        $parent_comment = (!$comment->comment_parent && count($child_comments)) ? ' parnet_comment' : '';

        $output = '<div id="wc-comm-' . $unique_id . '" class="' . $comment_wrapper_class . ' ' . $parent_comment . '">';
        $output .= '<div class="wc-comment-left">' . $wc_comm_author_avatar;
        if (!$this->wc_options->wc_options_serialized->wc_author_titles_show_hide) {
            $output .= '<div class="wc-comment-label">' . $author_title . '</div>';
        }
        $output .= '</div>';
        $output .= '<div class="wc-comment-right">';
        $output .= '<div class="wc-comment-header"><div class="wc-comment-author">' . $wc_author_name . '</div><div class="wc-comment-date">' . $posted_date . '</div><div style="clear:both"></div></div>';
        $output .= '<div class="wc-comment-text">' . $comment_content . '</div>';
        $output .= '<div class="wc-comment-footer">';
        if (!$this->wc_options->wc_options_serialized->wc_voting_buttons_show_hide) {
            $output .= '<div id="vote-count-' . $unique_id . '" class="wc-vote-result">' . $vote_count . '</div>';
            $output .= '<span id="wc-up-' . $unique_id . '" class="wc-vote-link wc-up ' . $vote_cls . '" title="' . $vote_up . '">&and;</span> | <span id="wc-down-' . $unique_id . '" class="wc-vote-link wc-down ' . $vote_cls . '" title="' . $vote_down . '">&or;</span> &nbsp;&nbsp;';
        }

        if ($this->is_guest_can_reply() && $this->is_customer_can_reply()) {
            $output .= '&nbsp;&nbsp;<span id="wc-comm-reply-' . $unique_id . '" class="wc-reply-link" title="' . $reply_text . '">' . $reply_text . '</span> &nbsp;&nbsp;';
        }


        if (!$this->wc_options->wc_options_serialized->wc_share_buttons_show_hide) {
            $output .= '-&nbsp;&nbsp; <span id="wc-comm-share-' . $unique_id . '" class="wc-share-link" title="' . $share_text . '">' . $share_text . '</span> &nbsp;&nbsp;';

            $twitt_content = $comment_content . ' ' . get_comment_link($comment);

            $output .= '<span id="share_buttons_box-' . $unique_id . '" class="share_buttons_box">';
            $output .= '<a target="_blank" href="http://www.facebook.com/sharer.php" title="' . $this->wc_options->wc_options_serialized->wc_phrases['wc_share_facebook'] . '"><img src="' . plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/social-icons/fb-18x18.png') . '"/></a>&nbsp;&nbsp;';
            $output .= '<a target="_blank" href="https://twitter.com/home?status=' . $twitt_content . '" title="' . $this->wc_options->wc_options_serialized->wc_phrases['wc_share_twitter'] . '"><img src="' . plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/social-icons/twitter-18x18.png') . '"/></a>&nbsp;&nbsp;';
            $output .= '<a target="_blank" href="https://plus.google.com/share?url=' . get_permalink($comment->comment_post_ID) . '" title="' . $this->wc_options->wc_options_serialized->wc_phrases['wc_share_google'] . '"><img src="' . plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/social-icons/google-18x18.png') . '"/></a>&nbsp;&nbsp;';
            $output .= '</span>';
        }

        if (current_user_can('edit_comment', $comment->comment_ID)) {
            $output .= '-&nbsp;&nbsp; <a href="' . get_edit_comment_link($comment->comment_ID) . '">' . __('Edit', 'wpdiscuz') . '</a>';
        }



        $visibility = 'none';
        if (!$comment->comment_parent && count($child_comments)) {
            $visibility = 'block';
            $output .= '<span id="wc-toggle-' . $unique_id . '" class="wc-toggle" style="display:' . $visibility . ';">' . $this->wc_options->wc_options_serialized->wc_phrases['wc_hide_replies_text'] . ' &and;</span>';
        }

        $output .= '</div>';
        $output .= '</div>';
        $output .= '<div style="clear:both"></div>';

        if ($this->is_guest_can_reply() && $this->is_customer_can_reply()) {
            $output .= '<div class="wc-form-wrapper wc-secondary-forms-wrapper" id="wc-secondary-forms-wrapper-' . $unique_id . '">';
            $output .= '<form action="" method="post" id="wc_comm_form-' . $unique_id . '" class="wc_comm_form">';
            $output .= '<div class="wc-field-comment"><div style="width:60px; float:left; position:absolute;">' . $this->wc_helper->get_comment_author_avatar() . '</div><div style="margin-left:65px;" class="item"><textarea id="wc_comment-' . $unique_id . '" class="wc_comment" name="wc_comment" required="required" placeholder="' . $textarea_placeholder . '"></textarea></div><div style="clear:both"></div></div>';

            $output .= '<div id="wc-form-footer-' . $unique_id . '" class="wc-form-footer">';

            if (!is_user_logged_in()) {
                $output .= '<div class="wc-author-data"><div class="wc-field-name item"><input id="wc_name-' . $unique_id . '" name="wc_name" class="wc_name" required="required" value="" type="text" placeholder="' . $this->wc_options->wc_options_serialized->wc_phrases['wc_name_text'] . '"/></div><div class="wc-field-email item"><input id="wc_email-' . $unique_id . '" class="wc_email email" name="wc_email" required="required" value="" type="email" placeholder="' . $this->wc_options->wc_options_serialized->wc_phrases['wc_email_text'] . '"/></div><div style="clear:both"></div></div>';
            }

            $output .= '<div class="wc-form-submit">';

            if (!$this->wc_options->wc_options_serialized->wc_captcha_show_hide) {
                if (!is_user_logged_in()) {
                    $output .= '<div class="wc-field-captcha item">';
                    $output .= '<input id="wc_captcha-' . $unique_id . '" name="wc_captcha" required="required" value="" type="text" /><span class="wc-label wc-captcha-label">';
                    $output .= '<img rel="nofollow" src="' . plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/captcha/captcha.php?comm_id=' . $comment->comment_post_ID . '-' . $comment->comment_ID) . '" id="wc_captcha_img-' . $unique_id . '" />';
                    $output .= '<img rel="nofollow" src="' . plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/refresh-16x16.png') . '" id="wc_captcha_refresh_img-' . $unique_id . '" class="wc_captcha_refresh_img" />';
                    $output .= '</span><span class="captcha_msg">' . $this->wc_options->wc_options_serialized->wc_phrases['wc_captcha_text'] . '</span></div>';
                }
            }

            $output .= '<div class="wc-field-submit"><input type="button" name="submit" value="' . $this->wc_options->wc_options_serialized->wc_phrases['wc_submit_text'] . '" id="wc_comm-' . $unique_id . '" class="wc_comm_submit button alt"/>
								</div>';
            $output .= '<div style="clear:both"></div>';
            $output .= '</div>';
            $output .= '</div>';

            $output .= '<input type="hidden" name="wc_home_url" value="' . plugins_url() . '" id="wc_home_url-' . $unique_id . '" />';
            $output .= '<input type="hidden" name="wc_comment_post_ID" value="' . $comment->comment_post_ID . '" id="wc_comment_post_ID-' . $unique_id . '" />';
            $output .= '<input type="hidden" name="wc_comment_parent" value="' . $comment->comment_ID . '" id="wc_comment_parent-' . $unique_id . '" />';

            $output .= '</form>';
            $output .= '</div>';
        }
        return $output;
    }

    public function is_guest_can_reply() {
        $user_can_comment = TRUE;
        if (!$this->wc_options->wc_options_serialized->wc_user_must_be_registered) {
            if ($this->wc_options->wc_options_serialized->wc_reply_button_guests_show_hide) {
                if (!is_user_logged_in()) {
                    $user_can_comment = FALSE;
                }
            }
        } else {
            if (!is_user_logged_in()) {
                $user_can_comment = FALSE;
            }
        }
        return $user_can_comment;
    }

    public function is_customer_can_reply() {
        $user_can_comment = TRUE;
        if ($this->wc_options->wc_options_serialized->wc_reply_button_members_show_hide) {
            $user_can_comment = $this->is_user_can_reply_by_role('customer');
        }
        return $user_can_comment;
    }

    /**
     * User can comment in product  by role
     */
    private function is_user_can_reply_by_role($role) {
        $user_can_comment = FALSE;
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            $roles = $current_user->roles;
            if (!in_array($role, $roles)) {
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
        if ($user) {
            if (class_exists('BuddyPress')) {
                $wc_profile_url = bp_core_get_user_domain($user->ID);
            } else if (class_exists('XooUserUltra')) {
                global $xoouserultra;
                $wc_profile_url = $xoouserultra->userpanel->get_user_profile_permalink($user->ID);
            }
        }
        return $wc_profile_url;
    }

    /**
     * returns placeholder for textarea from options page phrases
     */
    public function get_textarea_placeholder($comment) {
        $post = get_post($comment->comment_post_ID);
        if ($post->comment_count) {
            $textarea_placeholder = $this->wc_options->wc_options_serialized->wc_phrases['wc_comment_join_text'];
        } else {
            $textarea_placeholder = $this->wc_options->wc_options_serialized->wc_phrases['wc_comment_start_text'];
        }
        return $textarea_placeholder;
    }

    /**
     * returns unique id based on comment and post ids
     */
    public function get_unique_id($comment) {
        $unique_id = $comment->comment_post_ID . '_' . $comment->comment_ID;
        return $unique_id;
    }

    /**
     * set wpc helper
     */
    public function set_wc_helper($wc_helper) {
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