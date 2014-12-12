<?php

class WC_Helper {

    public static $datetime = 'datetime';
    public static $datetime_phrases_keys = array(
        'wc_year_text', 'wc_month_text', 'wc_day_text',
        'wc_hour_text', 'wc_minute_text', 'wc_second_text'
    );
    public static $year = 'wc_year_text';
    public static $month = 'wc_month_text';
    public static $day = 'wc_day_text';
    public static $hour = 'wc_hour_text';
    public static $minute = 'wc_minute_text';
    public static $second = 'wc_second_text';
    private $wc_options_serialize;

    function __construct($wc_options_serialize) {
        $this->wc_options_serialize = $wc_options_serialize;
    }

// Set timezone
// Time format is UNIX timestamp or
// PHP strtotime compatible strings
    public function dateDiff($time1, $time2, $precision = 2) {
// If not numeric then convert texts to unix timestamps
        if (!is_int($time1)) {
            $time1 = strtotime($time1);
        }
        if (!is_int($time2)) {
            $time2 = strtotime($time2);
        }

// If time1 is bigger than time2
// Then swap time1 and time2
        if ($time1 > $time2) {
            $ttime = $time1;
            $time1 = $time2;
            $time2 = $ttime;
        }

// Set up intervals and diffs arrays
        $intervals = array(
            $this->wc_options_serialize->wc_phrases['wc_year_text']['datetime'][1],
            $this->wc_options_serialize->wc_phrases['wc_month_text']['datetime'][1],
            $this->wc_options_serialize->wc_phrases['wc_day_text']['datetime'][1],
            $this->wc_options_serialize->wc_phrases['wc_hour_text']['datetime'][1],
            $this->wc_options_serialize->wc_phrases['wc_minute_text']['datetime'][1],
            $this->wc_options_serialize->wc_phrases['wc_second_text']['datetime'][1]
        );
        $diffs = array();

// Loop thru all intervals
        foreach ($intervals as $interval) {
// Create temp time from time1 and interval
            $interval = $this->date_comparision_by_index($interval);
            $ttime = strtotime('+1 ' . $interval, $time1);
// Set initial values
            $add = 1;
            $looped = 0;
// Loop until temp time is smaller than time2
            while ($time2 >= $ttime) {
// Create new temp time from time1 and interval
                $add++;
                $ttime = strtotime("+" . $add . " " . $interval, $time1);
                $looped++;
            }

            $time1 = strtotime("+" . $looped . " " . $interval, $time1);
            $diffs[$interval] = $looped;
        }

        $count = 0;
        $times = array();
// Loop thru all diffs
        foreach ($diffs as $interval => $value) {
            $interval = $this->date_text_by_index($interval);
// Break if we have needed precission
            if ($count >= $precision) {
                break;
            }
// Add value and interval 
// if value is bigger than 0
            if ($value > 0) {
// Add s if value is not 1
                if ($value != 1) {
                    $interval .= $this->wc_options_serialize->wc_phrases['wc_plural_text'];
                }
// Add value and interval to times array
                $times[] = $value . " " . $interval;
                $count++;
            }
        }

// Return string with times        
        $ago = ($times) ? $this->wc_options_serialize->wc_phrases['wc_ago_text'] : $this->wc_options_serialize->wc_phrases['wc_right_now_text'];
        return implode(" ", $times) . ' ' . $ago;
    }

    /**
     * get comment author avatar if exists otherwise default avatar
     */
    public function get_comment_author_avatar($comment = null) {
        global $current_user;
        get_currentuserinfo();

        $comm_auth_user_email = $current_user->user_email;
        if ($comment) {
            $comm_auth_avatar = get_avatar($comment->comment_author_email, 48);
        } else {
            if ($comm_auth_user_email) {
                $comm_auth_avatar = get_avatar($comm_auth_user_email, 48);
            } else {
                $comm_auth_avatar = '<img width="48" height="48" class="avatar avatar-48 photo avatar-default" src="' . plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/avatar_default.png') . '" alt=""/>';
            }
        }
        return $comm_auth_avatar;
    }

    public static function init_phrase_key_value($phrase) {
        $phrase_value = stripslashes($phrase['phrase_value']);
        switch ($phrase['phrase_key']) {
            case WC_Helper::$year:
                return array(WC_Helper::$datetime => array($phrase_value, 1));
            case WC_Helper::$month:
                return array(WC_Helper::$datetime => array($phrase_value, 2));
            case WC_Helper::$day:
                return array(WC_Helper::$datetime => array($phrase_value, 3));
            case WC_Helper::$hour:
                return array(WC_Helper::$datetime => array($phrase_value, 4));
            case WC_Helper::$minute:
                return array(WC_Helper::$datetime => array($phrase_value, 5));
            case WC_Helper::$second:
                return array(WC_Helper::$datetime => array($phrase_value, 6));
            default :
                return $phrase_value;
        }
    }

    private function date_comparision_by_index($index) {
        switch ($index) {
            case 1:
                return 'year';
            case 2:
                return 'month';
            case 3:
                return 'day';
            case 4:
                return 'hour';
            case 5:
                return 'minute';
            case 6:
                return 'second';
        }
    }

    private function date_text_by_index($index) {
        switch ($index) {
            case 'year':
                return $this->wc_options_serialize->wc_phrases['wc_year_text']['datetime'][0];
            case 'month':
                return $this->wc_options_serialize->wc_phrases['wc_month_text']['datetime'][0];
            case 'day':
                return $this->wc_options_serialize->wc_phrases['wc_day_text']['datetime'][0];
            case 'hour':
                return $this->wc_options_serialize->wc_phrases['wc_hour_text']['datetime'][0];
            case 'minute':
                return $this->wc_options_serialize->wc_phrases['wc_minute_text']['datetime'][0];
            case 'second':
                return $this->wc_options_serialize->wc_phrases['wc_second_text']['datetime'][0];
        }
    }

}
