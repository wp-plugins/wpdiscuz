<div>
    <h2 style="padding:5px 10px 10px 10px; margin:0px;"><?php _e('Notification Phrases', WC_Core::$TEXT_DOMAIN); ?></h2>
    <table class="wp-list-table widefat plugins"  style="margin-top:10px; border:none;">
        <tbody>
            <tr valign="top">
                <th scope="row">
                    <?php _e('You\'ve successfully unsubscribed.', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_unsubscribe_message">
                        <textarea name="wc_unsubscribe_message" id="wc_unsubscribe_message"><?php echo $this->wc_options_serialized->wc_phrases['wc_unsubscribe_message']; ?></textarea>
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Error message for empty field', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_error_empty_text">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_error_empty_text']; ?>" name="wc_error_empty_text" id="wc_error_empty_text" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Error message for invalid email field', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_error_email_text">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_error_email_text']; ?>" name="wc_error_email_text" id="wc_error_email_text" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Error message for invalid website url field', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_error_url_text">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_error_url_text']; ?>" name="wc_error_url_text" id="wc_error_url_text" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('You must be', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_you_must_be_text">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_you_must_be_text']; ?>" name="wc_you_must_be_text" id="wc_you_must_be_text" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Logged in as', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_logged_in_as">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_logged_in_as']; ?>" name="wc_logged_in_as" id="wc_logged_in_as" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Log out', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_log_out">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_log_out']; ?>" name="wc_log_out" id="wc_log_out" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Logged In', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_logged_in_text">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_logged_in_text']; ?>" name="wc_logged_in_text" id="wc_logged_in_text" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('To post a comment', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_to_post_comment_text">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_to_post_comment_text']; ?>" name="wc_to_post_comment_text" id="wc_to_post_comment_text" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Vote Counted', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_vote_counted">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_vote_counted']; ?>" name="wc_vote_counted" id="wc_vote_counted" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('You can vote only 1 time', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_vote_only_one_time">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_vote_only_one_time']; ?>" name="wc_vote_only_one_time" id="wc_vote_only_one_time" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Voting Error', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_voting_error">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_voting_error']; ?>" name="wc_voting_error" id="wc_voting_error" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Login To Vote', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_login_to_vote">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_login_to_vote']; ?>" name="wc_login_to_vote" id="wc_login_to_vote" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('You Cannot Vote On Your Comment', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_self_vote">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_self_vote']; ?>" name="wc_self_vote" id="wc_self_vote" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('You are not allowed to vote for this comment (Voting from same IP)', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_deny_voting_from_same_ip">
                        <input type="text" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_deny_voting_from_same_ip']) ? $this->wc_options_serialized->wc_phrases['wc_deny_voting_from_same_ip'] : 'You are not allowed to vote for this comment'; ?>" name="wc_deny_voting_from_same_ip" id="wc_deny_voting_from_same_ip" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Invalid Captcha Code', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_invalid_captcha">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_invalid_captcha']; ?>" name="wc_invalid_captcha" id="wc_invalid_captcha" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Some of field value is invalid', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_invalid_field">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_invalid_field']; ?>" name="wc_invalid_field" id="wc_invalid_field" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Comment waiting moderation', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_held_for_moderate">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_held_for_moderate']; ?>" name="wc_held_for_moderate" id="wc_held_for_moderate" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Message if comment content length is too long', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_msg_comment_text_max_length">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_msg_comment_text_max_length']; ?>" name="wc_msg_comment_text_max_length" id="wc_msg_comment_text_max_length" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Message if comment was not updated', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_comment_not_updated">
                        <input type="text" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_comment_not_updated']) ? $this->wc_options_serialized->wc_phrases['wc_comment_not_updated'] : __('Sorry, the comment was not updated', 'wpdisucz'); ?>" name="wc_comment_not_updated" id="wc_comment_not_updated" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Message if comment no longer possible to edit', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_comment_edit_not_possible">
                        <input type="text" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_comment_edit_not_possible']) ? $this->wc_options_serialized->wc_phrases['wc_comment_edit_not_possible'] : __('Sorry, this comment no longer possible to edit', 'wpdisucz'); ?>" name="wc_comment_edit_not_possible" id="wc_comment_edit_not_possible" />
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Message if comment text not changed', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_comment_not_edited">
                        <input type="text" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_comment_not_edited']) ? $this->wc_options_serialized->wc_phrases['wc_comment_not_edited'] : __('TYou\'ve not made any changes', 'wpdisucz'); ?>" name="wc_comment_not_edited" id="wc_comment_not_edited" />
                    </label>
                </td>
            </tr>
        </tbody>
    </table>
</div>