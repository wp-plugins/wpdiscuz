<div>
    <h2 style="padding:5px 10px 10px 10px; margin:0px;"><?php _e('Email Template Phrases', WC_Core::$TEXT_DOMAIN); ?></h2>
    <table class="wp-list-table widefat plugins"  style="margin-top:10px; border:none;">
        <tbody>
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
                    <?php _e('Unsubscribe', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_unsubscribe">
                        <input type="text" name="wc_unsubscribe" id="wc_unsubscribe" class="wc_unsubscribe" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_unsubscribe']; ?>" placeholder="<?php echo _e('Unsubscribe', WC_Core::$TEXT_DOMAIN); ?>"/>
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Ignore Subscription', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_ignore_subscription">
                        <input type="text" name="wc_ignore_subscription" id="wc_ignore_subscription" class="wc_ignore_subscription" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_ignore_subscription']) ? $this->wc_options_serialized->wc_phrases['wc_ignore_subscription'] : __('Ignore Subscription', 'wpdiscuz'); ?>" placeholder="<?php echo _e('Ignore Subscription', WC_Core::$TEXT_DOMAIN); ?>"/>
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Confirm your subscription', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_confirm_email">
                        <input type="text" name="wc_confirm_email" id="wc_confirm_email" class="wc_confirm_email" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_confirm_email']) ? $this->wc_options_serialized->wc_phrases['wc_confirm_email'] : __('Confirm your subscription', WC_Core::$TEXT_DOMAIN); ?>" placeholder="<?php echo _e('Confirm your subscription', WC_Core::$TEXT_DOMAIN); ?>"/>
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('You\'ve successfully confirmed your subscription.', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_comfirm_success_message">
                        <textarea name="wc_comfirm_success_message" id="wc_comfirm_success_message"><?php echo isset($this->wc_options_serialized->wc_phrases['wc_comfirm_success_message']) ? $this->wc_options_serialized->wc_phrases['wc_comfirm_success_message'] : __('You\'ve successfully confirmed your subscription.', WC_Core::$TEXT_DOMAIN); ?></textarea>
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Subscribe Confirmation Email Subject', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_confirm_email_subject">
                        <input type="text" name="wc_confirm_email_subject" id="wc_confirm_email_subject" class="wc_confirm_email_subject" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_confirm_email_subject']) ? $this->wc_options_serialized->wc_phrases['wc_confirm_email_subject'] : __('Subscribe Confirmation', WC_Core::$TEXT_DOMAIN); ?>" placeholder="<?php echo _e('Subscribe Confirmation', WC_Core::$TEXT_DOMAIN); ?>"/>
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Subscribe Confirmation Email Content', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_confirm_email_message">
                        <textarea name="wc_confirm_email_message" id="wc_confirm_email_message"><?php echo isset($this->wc_options_serialized->wc_phrases['wc_confirm_email_message']) ? $this->wc_options_serialized->wc_phrases['wc_confirm_email_message'] : __('Hi, <br/> You just subscribed for new comments on our website. This means you will receive an email when new comments are posted according to subscription option you\'ve chosen. <br/> To activate, click confirm below. If you believe this is an error, ignore this message and we\'ll never bother you again.', WC_Core::$TEXT_DOMAIN); ?></textarea>
                    </label>
                </td>
            </tr>
        </tbody>
    </table>
</div>
