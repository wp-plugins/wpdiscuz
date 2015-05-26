<div>
    <h2 style="padding:5px 10px 10px 10px; margin:0px;"><?php _e('Email Subscription Settings', WC_Core::$TEXT_DOMAIN); ?> </h2>
    <table class="wp-list-table widefat plugins" style="margin-top:10px; border:none;">
        <tbody>
            <tr valign="top">
                <th scope="row" style="width:55%;">
                    <span><?php _e('Show "Notify of all new follow-up comments"', WC_Core::$TEXT_DOMAIN); ?></span><br />
                    <span style="line-height:22px;"><?php _e('Show "Notify of new replies to all my comments"', WC_Core::$TEXT_DOMAIN); ?></span><br />
                    <span style="line-height:22px;"><?php _e('Show "Notify of new replies to this comment"', WC_Core::$TEXT_DOMAIN); ?></span><br />
        <p style="font-size:13px; color:#999999; width:80%; padding-left:0px; margin-left:0px;">
            <?php _e('Please keep all three or at least one of those options ON, otherwise users will not have any option for email notifications and they\'ll not get any messages.', WC_Core::$TEXT_DOMAIN) ?>
        </p>
        </th>
        <td>   
            <label for="wc_show_hide_comment_checkbox">
                <input type="checkbox" <?php checked($this->wc_options_serialized->wc_show_hide_comment_checkbox == 1) ?> value="1" name="wc_show_hide_comment_checkbox" id="wc_show_hide_comment_checkbox" />
            </label>
            <br />
            <label for="wc_show_hide_all_reply_checkbox" style="line-height:22px;">
                <input type="checkbox" <?php checked($this->wc_options_serialized->wc_show_hide_all_reply_checkbox == 1) ?> value="1" name="wc_show_hide_all_reply_checkbox" id="wc_show_hide_all_reply_checkbox" />
            </label><br />
            <label for="wc_show_hide_reply_checkbox" style="line-height:22px;">
                <input type="checkbox" <?php checked($this->wc_options_serialized->wc_show_hide_reply_checkbox == 1) ?> value="1" name="wc_show_hide_reply_checkbox" id="wc_show_hide_reply_checkbox" />
            </label>
        </td>
        </tr>
        <?php if (class_exists('Prompt_Comment_Form_Handling')) { ?>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Use Postmatic for subscriptions and commenting by email', WC_Core::$TEXT_DOMAIN); ?> 
            <p style="font-size:13px; color:#999999; width:80%; padding-left:0px; margin-left:0px;"><?php _e('Postmatic allows your users subscribe to comments. Instead of just being notified, they add a reply right from their inbox.', WC_Core::$TEXT_DOMAIN); ?></p>
            </th>
            <td>                                
                <label for="wc_use_postmatic_for_comment_notification">
                    <input type="checkbox" <?php checked($this->wc_options_serialized->wc_use_postmatic_for_comment_notification == 1) ?> value="1" name="wc_use_postmatic_for_comment_notification" id="wc_use_postmatic_for_comment_notification" />
                </label>
            </td>
            </tr>
        <?php } ?>
        <tr valign="top">
            <th scope="row">
                <?php _e('Keep selected the email notification of all new follow-up comments by default', WC_Core::$TEXT_DOMAIN); ?> 
        <p style="font-size:13px; color:#999999; width:80%; padding-left:0px; margin-left:0px;"><?php _e('If this option is checked-on, in Manage Subscriptions section of comment forms will only be displayed the "Notify of all new follow-up comments" option and this option will always be selected by default.', WC_Core::$TEXT_DOMAIN); ?> </p>
        </th>
        <td>                                
            <label for="wc_comment_reply_checkboxes_default_checked">
                <input type="checkbox" <?php checked($this->wc_options_serialized->wc_comment_reply_checkboxes_default_checked == 1) ?> value="1" name="wc_comment_reply_checkboxes_default_checked" id="wc_comment_reply_checkboxes_default_checked" />
            </label>
        </td>
        </tr>
        </tbody>
    </table>
</div>