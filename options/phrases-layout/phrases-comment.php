<div>
    <h2 style="padding:5px 10px 10px 10px; margin:0px;"><?php _e('Comment Template Phrases', WC_Core::$TEXT_DOMAIN); ?></h2>
    <table class="wp-list-table widefat plugins"  style="margin-top:10px; border:none;">
        <tbody>
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
                    <?php _e('Edit', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_edit_text">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_edit_text']; ?>" name="wc_edit_text" id="wc_edit_text" />
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
            <tr valign="top">
                <th scope="row">
                    <?php _e('Share On VKontakte', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_share_vk">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_share_vk']; ?>" name="wc_share_vk" id="wc_share_vk" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Share On Odnoklassniki', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_share_ok">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_share_ok']; ?>" name="wc_share_ok" id="wc_share_ok" />
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
                    <?php _e('Save edited comment button text', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_comment_edit_save_button">
                        <input type="text" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_comment_edit_save_button']) ? $this->wc_options_serialized->wc_phrases['wc_comment_edit_save_button'] : __('Save', 'wpdisucz'); ?>" name="wc_comment_edit_save_button" id="wc_comment_edit_save_button" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Cancel comment editing button text', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_comment_edit_cancel_button">
                        <input type="text" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_comment_edit_cancel_button']) ? $this->wc_options_serialized->wc_phrases['wc_comment_edit_cancel_button'] : __('Cancel', 'wpdisucz'); ?>" name="wc_comment_edit_cancel_button" id="wc_comment_edit_cancel_button" />
                    </label>
                </td>
            </tr>
        </tbody>
    </table>
</div>