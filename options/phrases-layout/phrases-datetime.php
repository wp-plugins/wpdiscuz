<div>
    <h2 style="padding:5px 10px 10px 10px; margin:0px;"><?php _e('Date/Time Phrases', WC_Core::$TEXT_DOMAIN); ?></h2>
    <table class="wp-list-table widefat plugins"  style="margin-top:10px; border:none;">
        <tbody>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Year', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_year_text">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_year_text']['datetime'][0]; ?>" name="wc_year_text" id="wc_year_text" />
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Years (Plural Form)', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_year_text_plural">
                        <input type="text" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_year_text_plural']['datetime'][0]) ? $this->wc_options_serialized->wc_phrases['wc_year_text_plural']['datetime'][0] : __('Years', WC_Core::$TEXT_DOMAIN); ?>" name="wc_year_text_plural" id="wc_year_text_plural" />
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Month', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_month_text">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_month_text']['datetime'][0]; ?>" name="wc_month_text" id="wc_month_text" />
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Months (Plural Form)', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_month_text_plural">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_month_text_plural']['datetime'][0]; ?>" name="wc_month_text_plural" id="wc_month_text_plural" />
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Day', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_day_text">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_day_text']['datetime'][0]; ?>" name="wc_day_text" id="wc_day_text" />
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Days (Plural Form)', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_day_text_plural">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_day_text_plural']['datetime'][0]; ?>" name="wc_day_text_plural" id="wc_day_text_plural" />
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Hour', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_hour_text">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_hour_text']['datetime'][0]; ?>" name="wc_hour_text" id="wc_hour_text" />
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Hours (Plural Form)', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_hour_text_plural">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_hour_text_plural']['datetime'][0]; ?>" name="wc_hour_text_plural" id="wc_hour_text_plural" />
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Minute', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_minute_text">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_minute_text']['datetime'][0]; ?>" name="wc_minute_text" id="wc_minute_text" />
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Minutes (Plural Form)', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_minute_text_plural">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_minute_text_plural']['datetime'][0]; ?>" name="wc_minute_text_plural" id="wc_minute_text_plural" />
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Second', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_second_text">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_second_text']['datetime'][0]; ?>" name="wc_second_text" id="wc_second_text" />
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Seconds (Plural Form)', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_second_text_plural">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_second_text_plural']['datetime'][0]; ?>" name="wc_second_text_plural" id="wc_second_text_plural" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Commented "right now" text', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_right_now_text">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_right_now_text']; ?>" name="wc_right_now_text" id="wc_right_now_text" />
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Ago text', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_ago_text">
                        <input type="text" value="<?php echo $this->wc_options_serialized->wc_phrases['wc_ago_text']; ?>" name="wc_ago_text" id="wc_ago_text" />
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('"Today" text', WC_Core::$TEXT_DOMAIN); ?>
                </th>
                <td colspan="3">                                
                    <label for="wc_posted_today_text">
                        <input type="text" value="<?php echo isset($this->wc_options_serialized->wc_phrases['wc_posted_today_text']) ? $this->wc_options_serialized->wc_phrases['wc_posted_today_text'] : __('Today', WC_Core::$TEXT_DOMAIN); ?>" name="wc_posted_today_text" id="wc_posted_today_text" placeholder="<?php _e('Today', WC_Core::$TEXT_DOMAIN); ?> 9:26 PM"/>
                    </label>
                </td>
            </tr>
        </tbody>
    </table>
</div>