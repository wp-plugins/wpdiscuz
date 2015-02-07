<th colspan="4" scope="col" style="margin-bottom: 5px;"><h2><?php _e('General settings', WC_Core::$TEXT_DOMAIN); ?></h2></th>

<tr valign="top">
    <th scope="row">
        <?php _e('Display comment form for post types:', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <?php
        foreach ($this->wc_post_types as $post_type) {
            if (!post_type_supports($post_type, 'comments')) {
                continue;
            }
            ?>
            <label for="<?php echo $post_type ?>">
                <input type="checkbox" <?php checked(in_array($post_type, $this->wc_options_serialized->wc_post_types)); ?> value="<?php echo $post_type; ?>" name="wc_post_types[]" id="wc_type_<?php echo $post_type; ?>" />
                <span><?php echo $post_type; ?></span>
            </label><br/>
            <?php
        }
        ?>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Show the latest comments on', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">
        <fieldset class="comment_list_order">
            <label title="<?php _e('the top of the list', WC_Core::$TEXT_DOMAIN) ?>">
                <input type="radio" value="desc" <?php checked('desc' == $this->wc_options_serialized->wc_comment_list_order); ?> name="wc_comment_list_order" id="wc_comment_list_order" /> 
                <span><?php _e('top of the threads', WC_Core::$TEXT_DOMAIN) ?></span>
            </label> &nbsp;<br/>
            <label title="<?php _e('bottom of the threads', WC_Core::$TEXT_DOMAIN) ?>">
                <input type="radio" value="asc" <?php checked('asc' == $this->wc_options_serialized->wc_comment_list_order); ?> name="wc_comment_list_order" id="wc_comment_list_order" /> 
                <span><?php _e('the bottom of the list', WC_Core::$TEXT_DOMAIN) ?></span>
            </label><br>                                    
        </fieldset>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Live update options', WC_Core::$TEXT_DOMAIN); ?>
<p style="font-size:13px; color:#999999; width:80%; padding-left:0px; margin-left:0px;">If you use Shared Web Hosting you should make sure the "Live Update" function doesn't overload your server resources. This function is good for VPS and Dedicated Hosting Plans.</p>
</th>
<td colspan="3">
    <fieldset class="wc_comment_list_update_type">
        <?php $wc_comment_list_update_type = isset($this->wc_options_serialized->wc_comment_list_update_type) ? $this->wc_options_serialized->wc_comment_list_update_type : 1; ?>
        <label title="<?php _e('Never update', WC_Core::$TEXT_DOMAIN) ?>">
            <input type="radio" value="0" <?php checked('0' == $wc_comment_list_update_type); ?> name="wc_comment_list_update_type" id="wc_comment_list_update_never" /> 
            <span><?php _e('Turn off "Live Update" function', WC_Core::$TEXT_DOMAIN) ?></span>
        </label> &nbsp;<br/>
        <label title="<?php _e('Show new comment/reply buttons to update manualy', WC_Core::$TEXT_DOMAIN) ?>">
            <input type="radio" value="2" <?php checked('2' == $wc_comment_list_update_type); ?> name="wc_comment_list_update_type" id="wc_comment_list_update_new" /> 
            <span><?php _e('Always check for new comments and show update buttons', WC_Core::$TEXT_DOMAIN) ?></span>
        </label><br>    
        <label title="<?php _e('Always update', WC_Core::$TEXT_DOMAIN) ?>">
            <input type="radio" value="1" <?php checked('1' == $wc_comment_list_update_type); ?> name="wc_comment_list_update_type" id="wc_comment_list_update_always" /> 
            <span><?php _e('Always check for new comments and update automatically', WC_Core::$TEXT_DOMAIN) ?></span>
        </label> &nbsp;<br/>          
    </fieldset>
</td>
</tr>

<tr valign="top">
    <th scope="row">
        <label for="wc_comment_list_update_timer"><?php _e('Update comment list every', WC_Core::$TEXT_DOMAIN); ?></label>
    </th>
    <td colspan="3">
        <select id="wc_comment_list_update_timer" name="wc_comment_list_update_timer">
            <?php $wc_comment_list_update_timer = isset($this->wc_options_serialized->wc_comment_list_update_timer) ? $this->wc_options_serialized->wc_comment_list_update_timer : 30; ?>
            <option value="10" <?php selected($wc_comment_list_update_timer, '10'); ?>>10 <?php _e('Seconds', WC_Core::$TEXT_DOMAIN); ?></option>
            <option value="20" <?php selected($wc_comment_list_update_timer, '20'); ?>>20 <?php _e('Seconds', WC_Core::$TEXT_DOMAIN); ?></option>
            <option value="30" <?php selected($wc_comment_list_update_timer, '30'); ?>>30 <?php _e('Seconds', WC_Core::$TEXT_DOMAIN); ?></option>
            <option value="60" <?php selected($wc_comment_list_update_timer, '60'); ?>>1 <?php _e('Minute', WC_Core::$TEXT_DOMAIN); ?></option>
            <option value="180" <?php selected($wc_comment_list_update_timer, '180'); ?>>3 <?php _e('Minutes', WC_Core::$TEXT_DOMAIN); ?></option>
            <option value="300" <?php selected($wc_comment_list_update_timer, '300'); ?>>5 <?php _e('Minutes', WC_Core::$TEXT_DOMAIN); ?></option>
            <option value="600" <?php selected($wc_comment_list_update_timer, '600'); ?>>10 <?php _e('Minutes', WC_Core::$TEXT_DOMAIN); ?></option>
        </select>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Hide Voting buttons', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_voting_buttons_show_hide">
            <input type="checkbox" <?php checked($this->wc_options_serialized->wc_voting_buttons_show_hide == 1) ?> value="1" name="wc_voting_buttons_show_hide" id="wc_voting_buttons_show_hide" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Hide Share Button', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_share_buttons_show_hide">
            <input type="checkbox" <?php checked($this->wc_options_serialized->wc_share_buttons_show_hide == 1) ?> value="1" name="wc_share_buttons_show_hide" id="wc_share_buttons_show_hide" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Hide the  CAPTCHA field', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_captcha_show_hide">
            <input type="checkbox" <?php checked($this->wc_options_serialized->wc_captcha_show_hide == 1) ?> value="1" name="wc_captcha_show_hide" id="wc_captcha_show_hide" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('User Must be registered to comment', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">
        <fieldset>
            <label title="Yes">
                <input type="radio" value="1" <?php checked('1' == $this->wc_options_serialized->wc_user_must_be_registered); ?> name="wc_user_must_be_registered" id="wc_user_must_be_registered_yes" /> 
                <span>Yes</span>
            </label> &nbsp;
            <label title="No">
                <input type="radio" value="0" <?php checked('0' == $this->wc_options_serialized->wc_user_must_be_registered); ?> name="wc_user_must_be_registered" id="wc_user_must_be_registered_no" /> 
                <span>No</span>
            </label><br>                                    
        </fieldset>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Show logged-in user name and logout link on top of main form', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_show_hide_loggedin_username">
            <input type="checkbox" <?php checked($this->wc_options_serialized->wc_show_hide_loggedin_username == 1) ?> value="1" name="wc_show_hide_loggedin_username" id="wc_show_hide_loggedin_username" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Held new comments for moderation', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_held_comment_to_moderate">
            <input type="checkbox" <?php checked($this->wc_options_serialized->wc_held_comment_to_moderate == 1) ?> value="1" name="wc_held_comment_to_moderate" id="wc_held_comment_to_moderate" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Hide Reply button for Guests', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_reply_button_guests_show_hide">
            <input type="checkbox" <?php checked($this->wc_options_serialized->wc_reply_button_guests_show_hide == 1) ?> value="1" name="wc_reply_button_guests_show_hide" id="wc_reply_button_guests_show_hide" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Hide Reply button for Members', WC_Core::$TEXT_DOMAIN); ?> 
    </th>
    <td colspan="3">                                
        <label for="wc_reply_button_members_show_hide">
            <input type="checkbox" <?php checked($this->wc_options_serialized->wc_reply_button_members_show_hide == 1) ?> value="1" name="wc_reply_button_members_show_hide" id="wc_reply_button_members_show_hide" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Hide Author Titles', WC_Core::$TEXT_DOMAIN); ?>
    </th>
    <td colspan="3">                                
        <label for="wc_author_titles_show_hide">
            <input type="checkbox" <?php checked($this->wc_options_serialized->wc_author_titles_show_hide == 1) ?> value="1" name="wc_author_titles_show_hide" id="wc_author_titles_show_hide" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Comment Threads Per Page', WC_Core::$TEXT_DOMAIN); ?> 
    </th>
    <td colspan="3">
        <label for="wc_comment_count">
            <input type="number" value="<?php echo $this->wc_options_serialized->wc_comment_count; ?>" name="wc_comment_count" id="wc_comment_count" />
        </label><br/>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <label for="wc_comments_max_depth"><?php _e('Comments max depth', WC_Core::$TEXT_DOMAIN); ?></label>
    </th>
    <td colspan="3">
        <select id="wc_comments_max_depth" name="wc_comments_max_depth">
            <?php $wc_comments_max_depth = isset($this->wc_options_serialized->wc_comments_max_depth) ? $this->wc_options_serialized->wc_comments_max_depth : 3; ?>
            <option value="1" <?php selected($wc_comments_max_depth, '1'); ?>>1 <?php _e('Level', WC_Core::$TEXT_DOMAIN); ?></option>
            <option value="2" <?php selected($wc_comments_max_depth, '2'); ?>>2 <?php _e('Levels', WC_Core::$TEXT_DOMAIN); ?></option>
            <option value="3" <?php selected($wc_comments_max_depth, '3'); ?>>3 <?php _e('Levels', WC_Core::$TEXT_DOMAIN); ?></option>
            <option value="4" <?php selected($wc_comments_max_depth, '4'); ?>>4 <?php _e('Levels', WC_Core::$TEXT_DOMAIN); ?></option>
            <option value="5" <?php selected($wc_comments_max_depth, '5'); ?>>5 <?php _e('Levels', WC_Core::$TEXT_DOMAIN); ?></option>            
        </select>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Use WordPress Date/Time format', WC_Core::$TEXT_DOMAIN); ?> 
<p style="font-size:13px; color:#999999; width:80%; padding-left:0px; margin-left:0px;"><?php _e('wpDiscuz shows Human Readable date format. If you check this option it\'ll show the date/time format set in WordPress General Settings.', WC_Core::$TEXT_DOMAIN); ?></p>
</th>
<td colspan="3">                                
    <label for="wc_simple_comment_date">
        <input type="checkbox" <?php checked($this->wc_options_serialized->wc_simple_comment_date == 1) ?> value="1" name="wc_simple_comment_date" id="wc_simple_comment_date" />
    </label>
</td>
</tr>

<tr valign="top">
    <th scope="row">
        <?php _e('Keep checked-on the email notification checkboxes on comment form by default', WC_Core::$TEXT_DOMAIN); ?> 
    </th>
    <td colspan="3">                                
        <label for="wc_comment_reply_checkboxes_default_checked">
            <input type="checkbox" <?php checked($this->wc_options_serialized->wc_comment_reply_checkboxes_default_checked == 1) ?> value="1" name="wc_comment_reply_checkboxes_default_checked" id="wc_comment_reply_checkboxes_default_checked" />
        </label>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <span><?php _e('Show "Notify of all new follow-up comments"', WC_Core::$TEXT_DOMAIN); ?></span><br />
        <span style="line-height:22px;"><?php _e('Show "Notify of new replies to all my comments"', WC_Core::$TEXT_DOMAIN); ?></span><br />
        <span style="line-height:22px;"><?php _e('Show "Notify of new replies to this comment"', WC_Core::$TEXT_DOMAIN); ?></span><br />
<p style="font-size:13px; color:#999999; width:80%; padding-left:0px; margin-left:0px;">
    <?php _e('Please keep all three or at least one of those options ON, otherwise users will not have any option for email notifications and they\'ll not get any messages.', WC_Core::$TEXT_DOMAIN) ?>
</p>
</th>
<td colspan="3">   
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
<tr valign="top">
    <th scope="row">
        <label for="wc_comment_text_size"><?php _e('Comment text size in pixels', WC_Core::$TEXT_DOMAIN); ?></label>
    </th>
    <td colspan="3">
        <select id="wc_comment_text_size" name="wc_comment_text_size">
            <?php $wc_comment_text_size = isset($this->wc_options_serialized->wc_comment_text_size) ? $this->wc_options_serialized->wc_comment_text_size : '14px'; ?>
            <option value="12px" <?php selected($wc_comment_text_size, '12px'); ?>>12px</option>
            <option value="13px" <?php selected($wc_comment_text_size, '13px'); ?>>13px</option>
            <option value="14px" <?php selected($wc_comment_text_size, '14px'); ?>>14px</option>
            <option value="15px" <?php selected($wc_comment_text_size, '15px'); ?>>15px</option>
            <option value="16px" <?php selected($wc_comment_text_size, '16px'); ?>>16px</option>
        </select>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <label for="wc_form_bg_color"><?php _e('Comment Form Background Color', WC_Core::$TEXT_DOMAIN); ?></label>
    </th>
    <td width="1">
        <input type="text" class="regular-text" value="<?php echo isset($this->wc_options_serialized->wc_form_bg_color) ? $this->wc_options_serialized->wc_form_bg_color : '#f9f9f9'; ?>" id="wc_form_bg_color" name="wc_form_bg_color" placeholder="<?php _e('Example: #00ff00', WC_Core::$TEXT_DOMAIN); ?>"/>
    </td>

    <td class="picker_img_cell">
        <a href="#wc_openModal6">
            <img class="wc_colorpicker_img6" src="<?php echo plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/third-party/colorpicker/img/colorpicker_icon_22.png'); ?>" />
        </a>
    </td>
    <td class="color_picker">
        <div id="wc_openModal6" class="modalDialog">
            <div id="wc_box6">
                <a href="#close" title="Close" class="close">X</a>
                <h2>Color Picker</h2>
                <p id="wc_colorpickerHolder6"></p>
            </div>
        </div>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <label for="wc_comment_bg_color"><?php _e('Comment Background Color', WC_Core::$TEXT_DOMAIN); ?></label>
    </th>
    <td width="1">
        <input type="text" class="regular-text" value="<?php echo $this->wc_options_serialized->wc_comment_bg_color; ?>" id="wc_comment_bg_color" name="wc_comment_bg_color" placeholder="<?php _e('Example: #00ff00', WC_Core::$TEXT_DOMAIN); ?>"/>
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
        <label for="wc_reply_bg_color"><?php _e('Reply Background Color', WC_Core::$TEXT_DOMAIN); ?></label>
    </th>
    <td>
        <input type="text" class="regular-text" value="<?php echo $this->wc_options_serialized->wc_reply_bg_color; ?>" id="wc_reply_bg_color" name="wc_reply_bg_color" placeholder="<?php _e('Example: #00ff00', WC_Core::$TEXT_DOMAIN); ?>"/>
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
        <label for="wc_comment_text_color"><?php _e('Comment Text Color', WC_Core::$TEXT_DOMAIN); ?></label>
    </th>
    <td>
        <input type="text" class="regular-text" value="<?php echo $this->wc_options_serialized->wc_comment_text_color; ?>" id="wc_comment_text_color" name="wc_comment_text_color" placeholder="<?php _e('Example: #00ff00', WC_Core::$TEXT_DOMAIN); ?>"/>
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
        <label for="wc_author_title_color"><?php _e('Author title color', WC_Core::$TEXT_DOMAIN); ?></label>
    </th>
    <td>
        <input type="text" class="regular-text" value="<?php echo $this->wc_options_serialized->wc_author_title_color; ?>" id="wc_author_title_color" name="wc_author_title_color" placeholder="<?php _e('Example: #00ff00', WC_Core::$TEXT_DOMAIN); ?>"/>
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
        <label for="wc_vote_reply_color"><?php _e('Vote, Reply, Share, Edit links text colors', WC_Core::$TEXT_DOMAIN); ?></label>
    </th>
    <td>
        <input type="text" class="regular-text" value="<?php echo $this->wc_options_serialized->wc_vote_reply_color; ?>" id="wc_vote_reply_color" name="wc_vote_reply_color" placeholder="<?php _e('Example: #00ff00', WC_Core::$TEXT_DOMAIN); ?>"/>
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

<tr valign="top">
    <th scope="row">
        <label for="wc_new_loaded_comment_bg_color"><?php _e('New loaded comments\' background color', WC_Core::$TEXT_DOMAIN); ?></label>
    </th>
    <td>
        <input type="text" class="regular-text" value="<?php echo isset($this->wc_options_serialized->wc_new_loaded_comment_bg_color) ? $this->wc_options_serialized->wc_new_loaded_comment_bg_color : 'rgb(254,254,254)'; ?>" id="wc_new_loaded_comment_bg_color" name="wc_new_loaded_comment_bg_color" placeholder="<?php _e('Example: #00ff00', WC_Core::$TEXT_DOMAIN); ?>"/>
    </td>

    <td class="picker_img_cell">
        <a href="#wc_openModal7">
            <img class="wc_colorpicker_img7" src="<?php echo plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/third-party/colorpicker/img/colorpicker_icon_22.png'); ?>" />
        </a>
    </td>
    <td class="color_picker">
        <div id="wc_openModal7" class="modalDialog">
            <div id="wc_box7">
                <a href="#close" title="Close" class="close">X</a>
                <h2>Color Picker</h2>
                <p id="wc_colorpickerHolder7"></p>
            </div>
        </div>
    </td>
</tr>

<tr valign="top">
    <th scope="row">
        <label for="wc_custom_css"><?php _e('Custom CSS Code', WC_Core::$TEXT_DOMAIN); ?></label>
    </th>
    <td>
        <textarea cols="50" rows="10" class="regular-text" id="wc_custom_css" name="wc_custom_css" placeholder=""><?php echo stripslashes($this->wc_options_serialized->wc_custom_css); ?></textarea>
    </td>   
</tr>