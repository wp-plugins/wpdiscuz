<div>
    <h2 style="padding:5px 10px 10px 10px; margin:0px;"><?php _e('Live Update', WC_Core::$TEXT_DOMAIN); ?></h2>
    <table class="wp-list-table widefat plugins" style="margin-top:10px; border:none;">
        <tbody>

            <tr valign="top">
                <th scope="row" style="width:55%;">
                    <?php _e('Live update options', WC_Core::$TEXT_DOMAIN); ?>
        <p style="font-size:13px; color:#999999; width:80%; padding-left:0px; margin-left:0px;"><?php _e('If you use Shared Web Hosting you should make sure the "Live Update" function doesn\'t overload your server resources. This function is good for VPS and Dedicated Hosting Plans.', WC_Core::$TEXT_DOMAIN); ?></p>
        </th>
        <td>
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
            <td>
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

        </tbody>
    </table>
</div>