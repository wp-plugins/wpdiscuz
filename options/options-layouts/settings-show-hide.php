<div>
    <h2 style="padding:5px 10px 10px 10px; margin:0px;"><?php _e('Show/Hide Components', WC_Core::$TEXT_DOMAIN); ?></h2>
    <table class="wp-list-table widefat plugins" style="margin-top:10px; border:none;">
        <tbody>
            <tr valign="top">
                <th scope="row" style="width:55%">
                    <?php _e('Show logged-in user name and logout link on top of main form', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td>                                
                    <label for="wc_show_hide_loggedin_username">
                        <input type="checkbox" <?php checked($this->wc_options_serialized->wc_show_hide_loggedin_username == 1) ?> value="1" name="wc_show_hide_loggedin_username" id="wc_show_hide_loggedin_username" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Hide Reply button for Guests', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td>                                
                    <label for="wc_reply_button_guests_show_hide">
                        <input type="checkbox" <?php checked($this->wc_options_serialized->wc_reply_button_guests_show_hide == 1) ?> value="1" name="wc_reply_button_guests_show_hide" id="wc_reply_button_guests_show_hide" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Hide Reply button for Members', WC_Core::$TEXT_DOMAIN); ?> 
                </th>
                <td>                                
                    <label for="wc_reply_button_members_show_hide">
                        <input type="checkbox" <?php checked($this->wc_options_serialized->wc_reply_button_members_show_hide == 1) ?> value="1" name="wc_reply_button_members_show_hide" id="wc_reply_button_members_show_hide" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Hide Author Titles', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td>                                
                    <label for="wc_author_titles_show_hide">
                        <input type="checkbox" <?php checked($this->wc_options_serialized->wc_author_titles_show_hide == 1 )  ?> value="1" name="wc_author_titles_show_hide" id="wc_author_titles_show_hide" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Hide Voting buttons', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td>                                
                    <label for="wc_voting_buttons_show_hide">
                        <input type="checkbox" <?php checked($this->wc_options_serialized->wc_voting_buttons_show_hide == 1 ) ?> value="1" name="wc_voting_buttons_show_hide" id="wc_voting_buttons_show_hide" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Hide Share Buttons', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td>                                
                    <label for="wc_share_buttons_show_hide">
                        <input type="checkbox" <?php checked($this->wc_options_serialized->wc_share_buttons_show_hide == 1 ) ?> value="1" name="wc_share_buttons_show_hide" id="wc_share_buttons_show_hide" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Hide the  CAPTCHA field', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td>                                
                    <label for="wc_captcha_show_hide">
                        <input type="checkbox" <?php checked($this->wc_options_serialized->wc_captcha_show_hide == 1) ?> value="1" name="wc_captcha_show_hide" id="wc_captcha_show_hide" />
                            </label>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                    <?php _e('Hide the Website URL field', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td>                                
                    <label for="wc_weburl_show_hide">
                        <input type="checkbox" <?php checked($this->wc_options_serialized->wc_weburl_show_hide == 1) ?> value="1" name="wc_weburl_show_hide" id="wc_weburl_show_hide" />
                    </label>
                </td>
            </tr>
                    <tr valign="top">
                        <th scope="row">
                    <?php _e('Hide header text', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td>                                
                    <label for="wc_header_text_show_hide">
                        <input type="checkbox" <?php checked($this->wc_options_serialized->wc_header_text_show_hide == 1) ?> value="1" name="wc_header_text_show_hide" id="wc_header_text_show_hide" />
                    </label>
                </td>
            </tr>
                    <tr valign="top">
                        <th scope="row">
                    <?php _e('Hide user avatar', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td>                                
                    <label for="wc_avatar_show_hide">
                        <input type="checkbox" <?php checked($this->wc_options_serialized->wc_avatar_show_hide == 1) ?> value="1" name="wc_avatar_show_hide" id="wc_avatar_show_hide" />
                    </label>
                </td>
            </tr>
        </tbody>
    </table>
</div>