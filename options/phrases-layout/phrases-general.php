<div>
    <h2 style="padding:5px 10px 10px 10px; margin:0px;"><?php _e('General Phrases', WC_Core::$TEXT_DOMAIN); ?></h2>
    <table class="wp-list-table widefat plugins"  style="margin-top:10px; border:none;">
        <tbody>
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
                    <?php _e('Comment (Plural Form)', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_header_text_plural">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_header_text_plural']; ?>" name="wc_header_text_plural" id="wc_header_text_plural" />
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
                    <?php _e('Load Rest of Comments', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_load_rest_comments_submit_text">
                        <input type="text" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_load_rest_comments_submit_text']) ? $this->wc_options_serialized->wc_phrases['wc_load_rest_comments_submit_text'] : 'Load Rest of Comments'; ?>" name="wc_load_rest_comments_submit_text" id="wc_load_rest_comments_submit_text" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Button text if has new comment', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_new_comment_button_text">
                        <input type="text" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_new_comment_button_text']) ? $this->wc_options_serialized->wc_phrases['wc_new_comment_button_text'] : __('New Comment', 'wpdisucz'); ?>" name="wc_new_comment_button_text" id="wc_new_comment_button_text" placeholder="<?php _e("New Comment", "wpdiscuz"); ?>"/>
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Button text if has new comments (Plural Form)', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_new_comments_button_text">
                        <input type="text" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_new_comments_button_text']) ? $this->wc_options_serialized->wc_phrases['wc_new_comments_button_text'] : __('New Comments', 'wpdisucz'); ?>" name="wc_new_comments_button_text" id="wc_new_comments_button_text" placeholder="<?php _e("New Comments", "wpdiscuz"); ?>"/>
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Button text if has new reply', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_new_reply_button_text">
                        <input type="text" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_new_reply_button_text']) ? $this->wc_options_serialized->wc_phrases['wc_new_reply_button_text'] : __('New Reply', 'wpdisucz'); ?>" name="wc_new_reply_button_text" id="wc_new_reply_button_text" placeholder="<?php _e("New Reply", "wpdiscuz"); ?>"/>
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Button text if has new replies (Plural Form)', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_new_replies_button_text">
                        <input type="text" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_new_replies_button_text']) ? $this->wc_options_serialized->wc_phrases['wc_new_replies_button_text'] : __('New Replies', 'wpdisucz'); ?>" name="wc_new_replies_button_text" id="wc_new_replies_button_text" placeholder="<?php _e("New Replies", "wpdiscuz"); ?>"/>
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Text on load more button if has new comment(s)', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_new_comments_text">
                        <input type="text" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_new_comments_text']) ? $this->wc_options_serialized->wc_phrases['wc_new_comments_text'] : __('New', 'wpdisucz'); ?>" name="wc_new_comments_text" id="wc_new_comments_text" />
                    </label>
                </td>
            </tr>
        </tbody>
    </table>
</div>