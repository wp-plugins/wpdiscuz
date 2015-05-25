<div>
    <h2 style="padding:5px 10px 10px 10px; margin:0px;"><?php _e('General Settings', WC_Core::$TEXT_DOMAIN); ?></h2>
    <table class="wp-list-table widefat plugins"  style="margin-top:10px; border:none;">
        <tbody>
            <tr valign="top">
                <th scope="row" style="width:55%;">
                    <?php _e('Display comment form for post types:', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td>                                
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
                    <?php _e('User Must be registered to comment', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td>
                    <fieldset>
                        <label title="Yes">
                            <input type="radio" value="1" <?php checked('1' == $this->wc_options_serialized->wc_user_must_be_registered); ?> name="wc_user_must_be_registered" id="wc_user_must_be_registered_yes" /> 
                            <span><?php _e('Yes', WC_Core::$TEXT_DOMAIN); ?></span>
                        </label> &nbsp;
                        <label title="No">
                            <input type="radio" value="0" <?php checked('0' == $this->wc_options_serialized->wc_user_must_be_registered); ?> name="wc_user_must_be_registered" id="wc_user_must_be_registered_no" /> 
                            <span><?php _e('No', WC_Core::$TEXT_DOMAIN); ?></span>
                        </label><br>                                    
                    </fieldset>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row" style="width:55%">
                    <?php _e('Comment author must fill out name', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td>                                
                    <label for="wc_is_name_field_required">
                        <input type="checkbox" <?php checked($this->wc_options_serialized->wc_is_name_field_required == 1) ?> value="1" name="wc_is_name_field_required" id="wc_is_name_field_required" />
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row" style="width:55%">
                    <?php _e('Comment author must fill out email', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td>                                
                    <label for="wc_is_email_field_required">
                        <input type="checkbox" <?php checked($this->wc_options_serialized->wc_is_email_field_required == 1) ?> value="1" name="wc_is_email_field_required" id="wc_is_email_field_required" />
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Show the latest comments on', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td>
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
                    <?php _e('Comment Threads Per Page', WC_Core::$TEXT_DOMAIN); ?> 
                </th>
                <td>
                    <label for="wc_comment_count">
                        <input type="number" value="<?php echo $this->wc_options_serialized->wc_comment_count; ?>" name="wc_comment_count" id="wc_comment_count" />
                    </label><br/>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Comment text max length', WC_Core::$TEXT_DOMAIN); ?> 
                </th>
                <td>
                    <label for="wc_comment_text_max_length">
                        <input type="number" value="<?php echo isset($this->wc_options_serialized->wc_comment_text_max_length) ? $this->wc_options_serialized->wc_comment_text_max_length : ''; ?>" name="wc_comment_text_max_length" id="wc_comment_text_max_length" />
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
                    <label for="wc_comment_text_size"><?php _e('Comment text size in pixels', WC_Core::$TEXT_DOMAIN); ?></label>
                </th>
                <td>
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
                    <label for="wc_comment_editable_time"><?php _e('Allow comment editing for', WC_Core::$TEXT_DOMAIN); ?></label>
                </th>
                <td>
                    <select id="wc_comment_editable_time" name="wc_comment_editable_time">
                        <?php $wc_comment_editable_time = isset($this->wc_options_serialized->wc_comment_editable_time) ? $this->wc_options_serialized->wc_comment_editable_time : 0; ?>
                        <option value="0" <?php selected($wc_comment_editable_time, '0'); ?>><?php _e('Not Allow', WC_Core::$TEXT_DOMAIN); ?></option>
                        <option value="900" <?php selected($wc_comment_editable_time, '900'); ?>>15 <?php _e('Minutes', WC_Core::$TEXT_DOMAIN); ?></option>
                        <option value="1800" <?php selected($wc_comment_editable_time, '1800'); ?>>30 <?php _e('Minutes', WC_Core::$TEXT_DOMAIN); ?></option>
                        <option value="3600" <?php selected($wc_comment_editable_time, '3600'); ?>>1 <?php _e('Hour', WC_Core::$TEXT_DOMAIN); ?></option>
                        <option value="10800" <?php selected($wc_comment_editable_time, '10800'); ?>>3 <?php _e('Hours', WC_Core::$TEXT_DOMAIN); ?></option>
                        <option value="86400" <?php selected($wc_comment_editable_time, '86400'); ?>>24 <?php _e('Hours', WC_Core::$TEXT_DOMAIN); ?></option>
                    </select>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Redirect first commenter to', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td>
                    <?php
                    wp_dropdown_pages(array(
                        'name' => 'wpdiscuz_redirect_page',
                        'selected' => isset($this->wc_options_serialized->wpdiscuz_redirect_page) ? $this->wc_options_serialized->wpdiscuz_redirect_page : 0,
                        'show_option_none' => __('Do not redirect'),
                        'option_none_value' => 0
                    ));
                    ?>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Allow guests to vote on comments', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td>                                
                    <label for="wc_is_guest_can_vote">
                        <input type="checkbox" <?php checked($this->wc_options_serialized->wc_is_guest_can_vote == 1) ?> value="1" name="wc_is_guest_can_vote" id="wc_is_guest_can_vote" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Load rest of all comments on clicking the [Load More Comments] button', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td>                                
                    <label for="wc_load_all_comments">
                        <input type="checkbox" <?php checked($this->wc_options_serialized->wc_load_all_comments == 1) ?> value="1" name="wc_load_all_comments" id="wc_load_all_comments" />
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Use WordPress Date/Time format', WC_Core::$TEXT_DOMAIN); ?> 
        <p style="font-size:13px; color:#999999; width:80%; padding-left:0px; margin-left:0px;"><?php _e('wpDiscuz shows Human Readable date format. If you check this option it\'ll show the date/time format set in WordPress General Settings.', WC_Core::$TEXT_DOMAIN); ?></p>
        </th>
        <td>                                
            <label for="wc_simple_comment_date">
                <input type="checkbox" <?php checked($this->wc_options_serialized->wc_simple_comment_date == 1) ?> value="1" name="wc_simple_comment_date" id="wc_simple_comment_date" />&nbsp;
                <span style="font-size:13px; color:#999999; padding-left:0px; margin-left:0px; line-height:15px">
                    <?php echo date(get_option('date_format')); ?> / <?php echo date(get_option('time_format')); ?><br />
                    <?php _e('Current Wordpress date/time format', WC_Core::$TEXT_DOMAIN); ?></span>
            </label>
        </td>
        </tr>
        <tr valign="top">
            <th scope="row" >
                <?php _e('Use Plugin .PO/.MO files', WC_Core::$TEXT_DOMAIN); ?>
                <p style="font-size:13px; color:#999999; width:80%; padding-left:0px; margin-left:0px;"><?php _e('wpDiscuz phrase system allows you to translate all front-end phrases. However if you have a multi-language website it\'ll not allow you to add more than one language translation. The only way to get it is the plugin translation files (.PO / .MO). If wpDiscuz has the languages you need you should check this option to disable phrase system and it\'ll automatically translate all phrases based on language files according to current language.', WC_Core::$TEXT_DOMAIN); ?></p>
        	</th>
            <td colspan="3">                                
                <label for="wc_is_use_po_mo">
                    <input type="checkbox" <?php checked($this->wc_options_serialized->wc_is_use_po_mo == 1) ?> value="1" name="wc_is_use_po_mo" id="wc_is_use_po_mo" />
                </label>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row" >
                <label for="wc_show_plugin_powerid_by">
                    <?php _e('Help wpDiscuz to grow allowing people to recognize which comment plugin you use', WC_Core::$TEXT_DOMAIN); ?>
                </label>
        <p style="font-size:13px; color:#999999; width:80%; padding-left:0px; margin-left:0px;"><?php _e('Please check this option on to help wpDiscuz get more popularity as your thank to the hard work we do for you totally free. This option adds a very small (16x16px) icon under the comment section which will allow your site visitors recognize the name of comment solution you use.', WC_Core::$TEXT_DOMAIN); ?></p>
        </th>
        <td colspan="3">                                
            <label for="wc_show_plugin_powerid_by">
                <input type="checkbox" <?php checked($this->wc_options_serialized->wc_show_plugin_powerid_by == 1) ?> value="1" name="wc_show_plugin_powerid_by" id="wc_show_plugin_powerid_by" />
                <span id="wpdiscuz_thank_you" style="color:#006600; font-size:13px;"><?php _e('Thank you!', WC_Core::$TEXT_DOMAIN); ?></span>
            </label>
        </td>
        </tr>

        </tbody>
    </table>
</div>