<div>
    <h2 style="padding:5px 10px 10px 10px; margin:0px;"><?php _e('Form Template Phrases', WC_Core::$TEXT_DOMAIN); ?></h2>
    <table class="wp-list-table widefat plugins"  style="margin-top:10px; border:none;">
        <tbody>
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
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_name_text']; ?>" name="wc_name_text" id="wc_name_text" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('WebSite URL Field', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_website_text">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_website_text']; ?>" name="wc_website_text" id="wc_website_text" />
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
                        <input type="text" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_manage_subscribtions']) ? $this->wc_options_serialized->wc_phrases['wc_manage_subscribtions'] : __('Manage Subscriptions', WC_Core::$TEXT_DOMAIN); ?>" name="wc_manage_subscribtions" id="wc_manage_subscribtions" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Notify "None"', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_notify_none">
                        <input type="text" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_notify_none']) ? $this->wc_options_serialized->wc_phrases['wc_notify_none'] : __('None', WC_Core::$TEXT_DOMAIN); ?>" name="wc_notify_none" id="wc_notify_none" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Notify on new comments (checkbox)', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_notify_on_new_comment">
                        <input type="text" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_notify_on_new_comment']) ? $this->wc_options_serialized->wc_phrases['wc_notify_on_new_comment'] : __('Notify of all new follow-up comments', WC_Core::$TEXT_DOMAIN); ?>" name="wc_notify_on_new_comment" id="wc_notify_on_new_comment" />
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Notify on all new replies (checkbox)', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_notify_on_all_new_reply">
                        <input type="text" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_notify_on_all_new_reply']) ? $this->wc_options_serialized->wc_phrases['wc_notify_on_all_new_reply'] : __('Notify of new replies to all my comments', WC_Core::$TEXT_DOMAIN); ?>" name="wc_notify_on_all_new_reply" id="wc_notify_on_all_new_reply" />
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Notify on new replies (checkbox)', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_notify_on_new_reply">
                        <input type="text" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_notify_on_new_reply']) ? $this->wc_options_serialized->wc_phrases['wc_notify_on_new_reply'] : __('Notify of new replies to this comment', WC_Core::$TEXT_DOMAIN); ?>" name="wc_notify_on_new_reply" id="wc_notify_on_new_reply" />
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
        </tbody>
    </table>
</div>