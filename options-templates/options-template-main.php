<th colspan="3" scope="col" style="margin-bottom: 5px;"><h2><?php _e('General settings', 'wpdiscuz'); ?></h2></th>

<tr valign="top">
    <th scope="row">
        <?php _e('Display comment form for post types:', 'wpdiscuz'); ?>
    </th>
    <td colspan="3">                                
        <?php
        foreach ($this->wc_post_types as $post_type) {
            if (!post_type_supports($post_type, 'comments')) {
                continue;
            }
            ?>
            <label for="<?php echo $post_type ?>">
                <input type="checkbox" <?php checked(in_array($post_type, $this->wc_options_serialize->wc_post_types)); ?> value="<?php echo $post_type; ?>" name="wc_post_types[]" id="wc_type_<?php echo $post_type; ?>" />
                <span><?php echo $post_type; ?></span>
            </label><br/>
            <?php
        }
        ?>
    </td>
</tr>


<tr valign="top">
    <th scope="row">
        <?php _e('Hide Voting buttons', 'wpdiscuz'); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_voting_buttons_show_hide">
            <input type="checkbox" <?php checked($this->wc_options_serialize->wc_voting_buttons_show_hide == 1) ?> value="<?php echo $this->wc_options_serialize->wc_voting_buttons_show_hide; ?>" name="wc_voting_buttons_show_hide" id="wc_voting_buttons_show_hide" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Hide Share Button', 'wpdiscuz'); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_share_buttons_show_hide">
            <input type="checkbox" <?php checked($this->wc_options_serialize->wc_share_buttons_show_hide == 1) ?> value="<?php echo $this->wc_options_serialize->wc_share_buttons_show_hide; ?>" name="wc_share_buttons_show_hide" id="wc_share_buttons_show_hide" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Hide the  CAPTCHA field', 'wpdiscuz'); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_captcha_show_hide">
            <input type="checkbox" <?php checked($this->wc_options_serialize->wc_captcha_show_hide == 1) ?> value="<?php echo $this->wc_options_serialize->wc_captcha_show_hide; ?>" name="wc_captcha_show_hide" id="wc_captcha_show_hide" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('User Must be registered to comment', 'wpdiscuz'); ?>
    </th>
    <td colspan="3">
        <fieldset>
            <label title="Yes">
                <input type="radio" value="1" <?php checked('1' == $this->wc_options_serialize->wc_user_must_be_registered); ?> name="wc_user_must_be_registered" id="wc_user_must_be_registered_yes" /> 
                <span>Yes</span>
            </label> &nbsp;
            <label title="No">
                <input type="radio" value="0" <?php checked('0' == $this->wc_options_serialize->wc_user_must_be_registered); ?> name="wc_user_must_be_registered" id="wc_user_must_be_registered_no" /> 
                <span>No</span>
            </label><br>                                    
        </fieldset>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Held new comments for moderation', 'wpdiscuz'); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_held_comment_to_moderate">
            <input type="checkbox" <?php checked($this->wc_options_serialize->wc_held_comment_to_moderate == 1) ?> value="<?php echo $this->wc_options_serialize->wc_held_comment_to_moderate; ?>" name="wc_held_comment_to_moderate" id="wc_held_comment_to_moderate" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Hide Reply button for Guests', 'wpdiscuz'); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_reply_button_guests_show_hide">
            <input type="checkbox" <?php checked($this->wc_options_serialize->wc_reply_button_guests_show_hide == 1) ?> value="<?php echo $this->wc_options_serialize->wc_reply_button_guests_show_hide; ?>" name="wc_reply_button_guests_show_hide" id="wc_reply_button_guests_show_hide" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Hide Reply button for Members', 'wpdiscuz'); ?> 
    </th>
    <td colspan="3">                                
        <label for="wc_reply_button_members_show_hide">
            <input type="checkbox" <?php checked($this->wc_options_serialize->wc_reply_button_members_show_hide == 1) ?> value="<?php echo $this->wc_options_serialize->wc_reply_button_members_show_hide; ?>" name="wc_reply_button_members_show_hide" id="wc_reply_button_members_show_hide" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Hide Author Titles', 'wpdiscuz'); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_author_titles_show_hide">
            <input type="checkbox" <?php checked($this->wc_options_serialize->wc_author_titles_show_hide == 1) ?> value="<?php echo $this->wc_options_serialize->wc_author_titles_show_hide; ?>" name="wc_author_titles_show_hide" id="wc_author_titles_show_hide" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Comment Threads Per Page', 'wpdiscuz'); ?> 
    </th>
    <td colspan="3">
        <label for="wc_comment_count">
            <input type="number" value="<?php echo $this->wc_options_serialize->wc_comment_count; ?>" name="wc_comment_count" id="wc_comment_count" />
        </label><br/>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Notify moderator on new comment', 'wpdiscuz'); ?> 
    </th>
    <td colspan="3">                                
        <label for="wc_notify_moderator">
            <input type="checkbox" <?php checked($this->wc_options_serialize->wc_notify_moderator == 1) ?> value="<?php echo $this->wc_options_serialize->wc_notify_moderator; ?>" name="wc_notify_moderator" id="wc_notify_moderator" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Notify comment author on new reply', 'wpdiscuz'); ?> 
    </th>
    <td colspan="3">                                
        <label for="wc_notify_comment_author">
            <input type="checkbox" <?php checked($this->wc_options_serialize->wc_notify_comment_author == 1) ?> value="<?php echo $this->wc_options_serialize->wc_notify_comment_author; ?>" name="wc_notify_comment_author" id="wc_notify_comment_author" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <label for="wc_comment_bg_color"><?php _e('Comment Background Color', 'wpdiscuz'); ?></label>
    </th>
    <td width="1">
        <input type="text" class="regular-text" value="<?php echo $this->wc_options_serialize->wc_comment_bg_color; ?>" id="wc_comment_bg_color" name="wc_comment_bg_color" placeholder="<?php _e('Example: #00ff00', 'wpdiscuz'); ?>"/>
    </td>

    <td class="picker_img_cell">
        <a href="#wc_openModal1">
            <img class="wc_colorpicker_img1" src="<?php echo plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/third-party/colorpicker/img/colorpicker_icon_22.png'); ?>" />
        </a>
    </td>
    <td class="color_picker">
        <div id="wc_openModal1" class="modalDialog">
            <div id="wc_box1">
                <a href="#close" title="Close" class="close">X</a>
                <h2>Color Picker</h2>
                <p id="wc_colorpickerHolder1"></p>
            </div>
        </div>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <label for="wc_reply_bg_color"><?php _e('Reply Background Color', 'wpdiscuz'); ?></label>
    </th>
    <td>
        <input type="text" class="regular-text" value="<?php echo $this->wc_options_serialize->wc_reply_bg_color; ?>" id="wc_reply_bg_color" name="wc_reply_bg_color" placeholder="<?php _e('Example: #00ff00', 'wpdiscuz'); ?>"/>
    </td>

    <td class="picker_img_cell">
        <a href="#wc_openModal2">
            <img class="wc_colorpicker_img2" src="<?php echo plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/third-party/colorpicker/img/colorpicker_icon_22.png'); ?>" />
        </a>
    </td>
    <td class="color_picker">
        <div id="wc_openModal2" class="modalDialog">
            <div id="wc_box2">
                <a href="#close" title="Close" class="close">X</a>
                <h2>Color Picker</h2>
                <p id="wc_colorpickerHolder2"></p>
            </div>
        </div>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <label for="wc_comment_text_color"><?php _e('Comment Text Color', 'wpdiscuz'); ?></label>
    </th>
    <td>
        <input type="text" class="regular-text" value="<?php echo $this->wc_options_serialize->wc_comment_text_color; ?>" id="wc_comment_text_color" name="wc_comment_text_color" placeholder="<?php _e('Example: #00ff00', 'wpdiscuz'); ?>"/>
    </td>

    <td class="picker_img_cell">
        <a href="#wc_openModal3">
            <img class="wc_colorpicker_img3" src="<?php echo plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/third-party/colorpicker/img/colorpicker_icon_22.png'); ?>" />
        </a>
    </td>
    <td class="color_picker">
        <div id="wc_openModal3" class="modalDialog">
            <div id="wc_box3">
                <a href="#close" title="Close" class="close">X</a>
                <h2>Color Picker</h2>
                <p id="wc_colorpickerHolder3"></p>
            </div>
        </div>
    </td>
</tr>


<tr valign="top">
    <th scope="row">
        <label for="wc_author_title_color"><?php _e('Author title color', 'wpdiscuz'); ?></label>
    </th>
    <td>
        <input type="text" class="regular-text" value="<?php echo $this->wc_options_serialize->wc_author_title_color; ?>" id="wc_author_title_color" name="wc_author_title_color" placeholder="<?php _e('Example: #00ff00', 'wpdiscuz'); ?>"/>
    </td>

    <td class="picker_img_cell">
        <a href="#wc_openModal4">
            <img class="wc_colorpicker_img4" src="<?php echo plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/third-party/colorpicker/img/colorpicker_icon_22.png'); ?>" />
        </a>
    </td>
    <td class="color_picker">
        <div id="wc_openModal4" class="modalDialog">
            <div id="wc_box4">
                <a href="#close" title="Close" class="close">X</a>
                <h2>Color Picker</h2>
                <p id="wc_colorpickerHolder4"></p>
            </div>
        </div>
    </td>
</tr>


<tr valign="top">
    <th scope="row">
        <label for="wc_vote_reply_color"><?php _e('Vote, Reply, Share, Edit links text colors', 'wpdiscuz'); ?></label>
    </th>
    <td>
        <input type="text" class="regular-text" value="<?php echo $this->wc_options_serialize->wc_vote_reply_color; ?>" id="wc_vote_reply_color" name="wc_vote_reply_color" placeholder="<?php _e('Example: #00ff00', 'wpdiscuz'); ?>"/>
    </td>

    <td class="picker_img_cell">
        <a href="#wc_openModal5">
            <img class="wc_colorpicker_img5" src="<?php echo plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/third-party/colorpicker/img/colorpicker_icon_22.png'); ?>" />
        </a>
    </td>
    <td class="color_picker">
        <div id="wc_openModal5" class="modalDialog">
            <div id="wc_box5">
                <a href="#close" title="Close" class="close">X</a>
                <h2>Color Picker</h2>
                <p id="wc_colorpickerHolder5"></p>
            </div>
        </div>
    </td>
</tr>