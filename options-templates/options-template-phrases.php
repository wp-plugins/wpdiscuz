<th colspan="3" scope="col" style="margin-bottom: 5px;"><h2><?php _e('Front-end phrases', WC_Core::$TEXT_DOMAIN); ?></h2></th>

<tr valign="top">
    <th scope="row">
        <?php _e('Leave a Reply', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_leave_a_reply_text">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_leave_a_reply_text']; ?>" name="wc_leave_a_reply_text" id="wc_leave_a_reply_text" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Be the first to comment', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_be_the_first_text">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_be_the_first_text']; ?>" name="wc_be_the_first_text" id="wc_be_the_first_text" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Comment', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_header_text">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_header_text']; ?>" name="wc_header_text" id="wc_header_text" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('On', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_header_on_text">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_header_on_text']; ?>" name="wc_header_on_text" id="wc_header_on_text" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Comment Field Start', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_comment_start_text">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_comment_start_text']; ?>" name="wc_comment_start_text" id="wc_comment_start_text" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Comment Field Join', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_comment_join_text">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_comment_join_text']; ?>" name="wc_comment_join_text" id="wc_comment_join_text" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Email Field', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_email_text">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_email_text']; ?>" name="wc_email_text" id="wc_email_text" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Name Field', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_name_text">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_name_text']; ?>" name="wc_name_text" id="wc_email_text" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('CAPTCHA Field', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_captcha_text">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_captcha_text']; ?>" name="wc_captcha_text" id="wc_email_text" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Submit Button', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_submit_text">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_submit_text']; ?>" name="wc_submit_text" id="wc_submit_text" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Manage Subscriptions', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_manage_subscribtions">
            <input type="text" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_manage_subscribtions']) ? $this->wc_options_serialized->wc_phrases['wc_manage_subscribtions'] : _e('Manage Subscriptions', WC_Core::$TEXT_DOMAIN); ?>" name="wc_manage_subscribtions" id="wc_manage_subscribtions" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Notify on new comments (checkbox)', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_notify_on_new_comment">
            <input type="text" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_notify_on_new_comment']) ? $this->wc_options_serialized->wc_phrases['wc_notify_on_new_comment'] : _e('Notify of all new follow-up comments', WC_Core::$TEXT_DOMAIN); ?>" name="wc_notify_on_new_comment" id="wc_notify_on_new_comment" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Notify on all new replies (checkbox)', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_notify_on_all_new_reply">
            <input type="text" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_notify_on_all_new_reply']) ? $this->wc_options_serialized->wc_phrases['wc_notify_on_all_new_reply'] : _e('Notify of new replies to all my comments', WC_Core::$TEXT_DOMAIN); ?>" name="wc_notify_on_all_new_reply" id="wc_notify_on_all_new_reply" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Notify on new replies (checkbox)', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_notify_on_new_reply">
            <input type="text" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_notify_on_new_reply']) ? $this->wc_options_serialized->wc_phrases['wc_notify_on_new_reply'] : _e('Notify of new replies to this comment', WC_Core::$TEXT_DOMAIN); ?>" name="wc_notify_on_new_reply" id="wc_notify_on_new_reply" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Load More Button', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_load_more_submit_text">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_load_more_submit_text']; ?>" name="wc_load_more_submit_text" id="wc_load_more_submit_text" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Reply', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_reply_text">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_reply_text']; ?>" name="wc_reply_text" id="wc_submit_text" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Share', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_share_text">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_share_text']; ?>" name="wc_share_text" id="wc_share_text" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Share On Facebook', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_share_facebook">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_share_facebook']; ?>" name="wc_share_facebook" id="wc_share_facebook" />
        </label>
    </td>
</tr>

<tr valign="top" >
    <th scope="row">
        <?php _e('Share On Twitter', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_share_twitter">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_share_twitter']; ?>" name="wc_share_twitter" id="wc_share_twitter" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Share On Google', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_share_google">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_share_google']; ?>" name="wc_share_google" id="wc_share_google" />
        </label>
    </td>
</tr>

<tr valign="top" >
    <th scope="row">
        <?php _e('Hide Replies', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_hide_replies_text">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_hide_replies_text']; ?>" name="wc_hide_replies_text" id="wc_hide_replies_text" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Show Replies', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_show_replies_text">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_show_replies_text']; ?>" name="wc_show_replies_text" id="wc_show_replies_text" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Title For Guests', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_user_title_guest_text">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_user_title_guest_text']; ?>" name="wc_user_title_guest_text" id="wc_user_title_guest_text" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Title For Members', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_user_title_member_text">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_user_title_member_text']; ?>" name="wc_user_title_member_text" id="wc_user_title_member_text" />
        </label>
    </td>
</tr>




<tr valign="top">
    <th scope="row">
        <?php _e('Title For Authors', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_user_title_author_text">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_user_title_author_text']; ?>" name="wc_user_title_author_text" id="wc_user_title_author_text" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Title For Admins', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_user_title_admin_text">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_user_title_admin_text']; ?>" name="wc_user_title_admin_text" id="wc_user_title_admin_text" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Email Subject', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_email_subject">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_email_subject']; ?>" name="wc_email_subject" id="wc_email_subject" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Email Message', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_email_message">
            <textarea name="wc_email_message" id="wc_email_message"><?php echo $this->wc_options_serialized->wc_phrases['wc_email_message']; ?></textarea>            
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('New Reply Subject', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_new_reply_email_subject">
            <input type="text" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_new_reply_email_subject']) ? $this->wc_options_serialized->wc_phrases['wc_new_reply_email_subject'] : _e('New Reply', WC_Core::$TEXT_DOMAIN); ?>" name="wc_new_reply_email_subject" id="wc_new_reply_email_subject" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('New Reply Message', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_new_reply_email_message">
            <textarea name="wc_new_reply_email_message" id="wc_new_reply_email_message"><?php echo $this->wc_options_serialized->wc_phrases['wc_new_reply_email_message']; ?></textarea>
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Subscribed on this comment replies', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_subscribed_on_comment">
            <textarea name="wc_subscribed_on_comment" id="wc_subscribed_on_comment"><?php echo $this->wc_options_serialized->wc_phrases['wc_subscribed_on_comment']; ?></textarea>
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Subscribed on all your comments replies', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_subscribed_on_all_comment">
            <textarea name="wc_subscribed_on_all_comment" id="wc_subscribed_on_all_comment"><?php echo $this->wc_options_serialized->wc_phrases['wc_subscribed_on_all_comment']; ?></textarea>
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Subscribed on this post', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_subscribed_on_post">
            <textarea name="wc_subscribed_on_post" id="wc_subscribed_on_post"><?php echo $this->wc_options_serialized->wc_phrases['wc_subscribed_on_post']; ?></textarea>
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('New Reply Message', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_unsubscribe">
            <input type="text" name="wc_unsubscribe" id="wc_unsubscribe" class="wc_unsubscribe" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_unsubscribe']; ?>" placeholder="<?php echo _e('Unsubscribe', WC_Core::$TEXT_DOMAIN); ?>"/>
        </label>
    </td>
</tr>

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
        <?php _e('Year', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_year_text">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_year_text']['datetime'][0]; ?>" name="wc_year_text" id="wc_year_text" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Month', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_month_text">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_month_text']['datetime'][0]; ?>" name="wc_month_text" id="wc_month_text" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Day', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_day_text">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_day_text']['datetime'][0]; ?>" name="wc_day_text" id="wc_day_text" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Hour', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_hour_text">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_hour_text']['datetime'][0]; ?>" name="wc_hour_text" id="wc_hour_text" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Minute', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_minute_text">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_minute_text']['datetime'][0]; ?>" name="wc_minute_text" id="wc_minute_text" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Second', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_second_text">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_second_text']['datetime'][0]; ?>" name="wc_second_text" id="wc_second_text" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Plural (Ex. user -> user + s)', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_plural_text">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_plural_text']; ?>" name="wc_plural_text" id="wc_plural_text" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Commented "right now" text', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_right_now_text">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_right_now_text']; ?>" name="wc_right_now_text" id="wc_right_now_text" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Ago text', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_ago_text">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_ago_text']; ?>" name="wc_ago_text" id="wc_ago_text" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('"Today" text', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_posted_today_text">
            <input type="text" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_posted_today_text']) ? $this->wc_options_serialized->wc_phrases['wc_posted_today_text'] : _e('Today', WC_Core::$TEXT_DOMAIN); ?>" name="wc_posted_today_text" id="wc_posted_today_text" placeholder="<?php _e('Today', WC_Core::$TEXT_DOMAIN); ?> 9:26 PM"/>
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
        <?php _e('Vote Up', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_vote_up">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_vote_up']; ?>" name="wc_vote_up" id="wc_vote_up" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Vote Down', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_vote_down">
            <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_vote_down']; ?>" name="wc_vote_down" id="wc_vote_down" />
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
        <?php _e('Button text if has new comment', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_new_comment_button_text">
            <input type="text" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_new_comment_button_text']) ? $this->wc_options_serialized->wc_phrases['wc_new_comment_button_text'] : _e('New Comment', 'wpdisucz'); ?>" name="wc_new_comment_button_text" id="wc_new_comment_button_text" placeholder="<?php _e("New Comment", "wpdiscuz"); ?>"/>
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Button text if has new comments', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_new_comments_button_text">
            <input type="text" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_new_comments_button_text']) ? $this->wc_options_serialized->wc_phrases['wc_new_comments_button_text'] : _e('New Comments', 'wpdisucz'); ?>" name="wc_new_comments_button_text" id="wc_new_comments_button_text" placeholder="<?php _e("New Comments", "wpdiscuz"); ?>"/>
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Button text if has new reply', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_new_reply_button_text">
            <input type="text" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_new_reply_button_text']) ? $this->wc_options_serialized->wc_phrases['wc_new_reply_button_text'] : _e('New Reply', 'wpdisucz'); ?>" name="wc_new_reply_button_text" id="wc_new_reply_button_text" placeholder="<?php _e("New Reply", "wpdiscuz"); ?>"/>
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Button text if has new replies', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_new_replies_button_text">
            <input type="text" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_new_replies_button_text']) ? $this->wc_options_serialized->wc_phrases['wc_new_replies_button_text'] : _e('New Replies', 'wpdisucz'); ?>" name="wc_new_replies_button_text" id="wc_new_replies_button_text" placeholder="<?php _e("New Replies", "wpdiscuz"); ?>"/>
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Text on load more button if has new comment(s)', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_new_comments_text">
            <input type="text" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_new_comments_text']) ? $this->wc_options_serialized->wc_phrases['wc_new_comments_text'] : _e('New', 'wpdisucz'); ?>" name="wc_new_comments_text" id="wc_new_comments_text" />
        </label>
    </td>
</tr>