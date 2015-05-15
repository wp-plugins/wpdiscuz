<div>
    <h2 style="padding:5px 10px 10px 10px; margin:0px;"><?php _e('Background and Colors', WC_Core::$TEXT_DOMAIN); ?></h2>
    <table class="wp-list-table widefat plugins" style="margin-top:10px; border:none;">
        <tbody>
            <tr valign="top">
                <th scope="row" style="width:55%;">
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
                    <label for="wc_input_border_color"><?php _e('Comment form fields border color', WC_Core::$TEXT_DOMAIN); ?></label>
                </th>
                <td>
                    <input type="text" class="regular-text" value="<?php echo isset($this->wc_options_serialized->wc_input_border_color) ? $this->wc_options_serialized->wc_input_border_color : '#d9d9d9'; ?>" id="wc_input_border_color" name="wc_input_border_color" placeholder="<?php _e('Example: #00ff00', WC_Core::$TEXT_DOMAIN); ?>"/>
                </td>

                <td class="picker_img_cell">
                    <a href="#wc_openModal8">
                        <img class="wc_colorpicker_img8" src="<?php echo plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/third-party/colorpicker/img/colorpicker_icon_22.png'); ?>" />
                    </a>
                </td>
                <td class="color_picker">
                    <div id="wc_openModal8" class="modalDialog">
                        <div id="wc_box8">
                            <a href="#close" title="Close" class="close">X</a>
                            <h2>Color Picker</h2>
                            <p id="wc_colorpickerHolder8"></p>
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

        </tbody>
    </table>
</div>
