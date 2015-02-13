<?php

include_once 'includes/wc-db-helper.php';

class WC_Options_Serialize {

    public $wc_options_slug = 'wc_options';

    /**
     * Type - Checkbox array
     * Available Values - Checked/Unchecked
     * Description - On which post types display comment form
     * Default Value - Post
     */
    public $wc_post_types = array('post');

    /**
     * Type - Radio Button
     * Available Values - Top / Bottom
     * Description - Comment list order
     * Default Value - Top
     */
    public $wc_comment_list_order;

    /**
     * Type - Radio Button
     * Available Values - Always updtae / Update if has new comments
     * Description - Updates comments list via ajax to show new comments 
     * Default Value - Update if has new comments
     */
    public $wc_comment_list_update_type;

    /**
     * Type - Dropdown menu
     * Available Values - 10s, 20s, 30s, 60s(1 minute), 180s(3 minutes), 300s(5 minutes), 600s(10 minutes)
     * Description - Updates comments list every ... seconds
     * Default Value - Comment list update timer value
     */
    public $wc_comment_list_update_timer;

    /**
     * Type - Checkbox
     * Available Values - Checked/Unchecked
     * Description - Show/Hide Voting buttons
     * Default Value - Unchecked
     */
    public $wc_voting_buttons_show_hide;

    /**
     * Type - Checkbox
     * Available Values - Checked/Unchecked
     * Description - Show/Hide Share Buttons
     * Default Value - Unchecked
     */
    public $wc_share_buttons_show_hide;

    /*
     * Type - Checkbox
     * Available Values - Checked/Unchecked
     * Description - Show/Hide the  CAPTCHA field
     * Default Value - Unchecked
     */
    public $wc_captcha_show_hide;

    /**
     * Type - Radiobutton
     * Available Values - Yes/No
     * Description - User Must be registered to comment
     *      (If this option is set “Yes”, the comment form will be hidden, 
     *      instead of the form there will be a link to registration page.)
     * Default Value - No
     */
    public $wc_user_must_be_registered;

    /**
     * Type - Checkbox
     * Available Values - Checked/Unchecked
     * Description - If checked show logged-in user name top of the main form
     * Default Value - Checked
     */
    public $wc_show_hide_loggedin_username;

    /**
     * Type - Checkbox
     * Available Values - Checked/Unchecked
     * Description - If checked held the comment to approve manually    
     * Default Value - Unchecked
     */
    public $wc_held_comment_to_moderate;

    /**
     * Type - Checkbox
     * Available Values - Checked/Unchecked
     * Description - Show/Hide Reply button for Guests 
     * Default Value - Unchecked
     */
    public $wc_reply_button_guests_show_hide;

    /**
     * Type - Checkbox
     * Available Values - Checked/Unchecked
     * Description - Show/Hide Reply button for Customers 
     * Default Value - Unchecked
     */
    public $wc_reply_button_members_show_hide;

    /**
     * Type - Checkbox
     * Available Values - Checked/Unchecked
     * Description - Show/Hide Author Titles
     * Default Value - Unchecked   
     */
    public $wc_author_titles_show_hide;

    /**
     * Type - Input
     * Available Values - Integer
     * Description - Comment count per click
     * Default Value - 5
     */
    public $wc_comment_count;

    /**
     * Type - Dropdown menu
     * Available Values - 1, 2, 3, 4, 5
     * Description - Define comments depth value in comment list
     * Default Value - 2
     */
    public $wc_comments_max_depth;

    /**
     * Type - Checkbox
     * Available Values - Checked/Unchecked
     * Description - Comment date format - 20-01-2015
     * Default Value - Checked
     */
    public $wc_simple_comment_date;

    /**
     * Type - Checkbox
     * Available Values - Checked/Unchecked
     * Description - Set comment forms email notification checkboxes checked by default
     * Default Value - Unchecked
     */
    public $wc_comment_reply_checkboxes_default_checked;

    /**
     * Type - Checkbox
     * Available Values - Checked/Unchecked
     * Description - Show new comment notification checkbox below the form
     * Default Value - Checked
     */
    public $wc_show_hide_comment_checkbox;

    /**
     * Type - Checkbox
     * Available Values - Checked/Unchecked
     * Description - Show all new reply notification checkbox below the form
     * Default Value - Checked
     */
    public $wc_show_hide_all_reply_checkbox;
    
    /**
     * Type - Checkbox
     * Available Values - Checked/Unchecked
     * Description - Show new reply notification checkbox below the form
     * Default Value - Checked
     */
    public $wc_show_hide_reply_checkbox;

    /**
     * Type - Select
     * Available Values - 12px-16px
     * Description - Comment Text Size
     * Default Value - 14px
     */
    public $wc_comment_text_size;

    /**
     * Type - Input
     * Available Values - color codes
     * Description - Form Background Color
     * Default Value - #F9F9F9
     */
    public $wc_form_bg_color;

    /**
     * Type - Input
     * Available Values - color codes
     * Description - Comment Background Color
     * Default Value - #fefefe
     */
    public $wc_comment_bg_color;

    /**
     * Type - Input
     * Available Values - color codes
     * Description - Reply Background Color
     * Default Value - #f8f8f8
     */
    public $wc_reply_bg_color;

    /**
     * Type - Input
     * Available Values - color codes
     * Description - Comment Text Color
     * Default Value - #555
     */
    public $wc_comment_text_color;

    /**
     * Type - Input
     * Available Values - color codes
     * Description - Author title Color, Author title label color
     * Default Value - #ad74a2
     */
    public $wc_author_title_color;

    /**
     * Type - Input
     * Available Values - color codes
     * Description - Vote, Reply, Share, Edit - text colors
     * Default Value - #666666
     */
    public $wc_vote_reply_color;

    /**
     * Type - Input
     * Available Values - color codes
     * Description - New Comments background color
     * Default Value - #fefefe
     */
    public $wc_new_loaded_comment_bg_color;

    /**
     * Type - Textarea
     * Available Values - custom css code
     * Description - Custom css code
     * Default Value - 
     */
    public $wc_custom_css;

    /**
     * Type - HTML elements array
     * Available Values - Text
     * Description - Phrases for form elements texts
     * Default Value - 
     */
    public $wc_phrases;

    /**
     * helper class for database operations
     */
    public $wc_db_helper;

    function __construct($wc_db_helper) {
        $this->wc_db_helper = $wc_db_helper;
        $this->init_phrases();
        $this->add_options();
        $this->init_options(get_option($this->wc_options_slug));
        add_action('plugins_loaded', array(&$this, 'init_phrases_on_load'), 2126);
    }

    public function init_options($serialize_options) {
        $options = unserialize($serialize_options);
        $this->wc_post_types = $options['wc_post_types'];
        $this->wc_comment_list_order = isset($options['wc_comment_list_order']) ? $options['wc_comment_list_order'] : 'desc';
        $this->wc_comment_list_update_type = isset($options['wc_comment_list_update_type']) ? $options['wc_comment_list_update_type'] : 0;
        $this->wc_comment_list_update_timer = isset($options['wc_comment_list_update_timer']) ? $options['wc_comment_list_update_timer'] : 30;
        $this->wc_voting_buttons_show_hide = $options['wc_voting_buttons_show_hide'];
        $this->wc_share_buttons_show_hide = $options['wc_share_buttons_show_hide'];
        $this->wc_captcha_show_hide = $options['wc_captcha_show_hide'];
        $this->wc_user_must_be_registered = $options['wc_user_must_be_registered'];
        $this->wc_show_hide_loggedin_username = isset($options['wc_show_hide_loggedin_username']) ? $options['wc_show_hide_loggedin_username'] : 0;
        $this->wc_held_comment_to_moderate = $options['wc_held_comment_to_moderate'];
        $this->wc_reply_button_guests_show_hide = $options['wc_reply_button_guests_show_hide'];
        $this->wc_reply_button_members_show_hide = $options['wc_reply_button_members_show_hide'];
        $this->wc_author_titles_show_hide = $options['wc_author_titles_show_hide'];
        $this->wc_comment_count = $options['wc_comment_count'];
        $this->wc_comments_max_depth = isset($options['wc_comments_max_depth']) ? $options['wc_comments_max_depth'] : 2;
        $this->wc_simple_comment_date = isset($options['wc_simple_comment_date']) ? $options['wc_simple_comment_date'] : 0;
        $this->wc_comment_reply_checkboxes_default_checked = isset($options['wc_comment_reply_checkboxes_default_checked']) ? $options['wc_comment_reply_checkboxes_default_checked'] : 0;
        $this->wc_show_hide_comment_checkbox = isset($options['wc_show_hide_comment_checkbox']) ? $options['wc_show_hide_comment_checkbox'] : 0;
        $this->wc_show_hide_all_reply_checkbox = isset($options['wc_show_hide_all_reply_checkbox']) ? $options['wc_show_hide_all_reply_checkbox'] : 0;
        $this->wc_show_hide_reply_checkbox = isset($options['wc_show_hide_reply_checkbox']) ? $options['wc_show_hide_reply_checkbox'] : 0;
        $this->wc_comment_text_size = isset($options['wc_comment_text_size']) ? $options['wc_comment_text_size'] : '14px';
        $this->wc_form_bg_color = isset($options['wc_form_bg_color']) ? $options['wc_form_bg_color'] : '#f9f9f9';
        $this->wc_comment_bg_color = $options['wc_comment_bg_color'];
        $this->wc_reply_bg_color = $options['wc_reply_bg_color'];
        $this->wc_comment_text_color = $options['wc_comment_text_color'];
        $this->wc_author_title_color = $options['wc_author_title_color'];
        $this->wc_vote_reply_color = $options['wc_vote_reply_color'];
        $this->wc_new_loaded_comment_bg_color = isset($options['wc_new_loaded_comment_bg_color']) ? $options['wc_new_loaded_comment_bg_color'] : "rgb(255,250,214)";
        $this->wc_custom_css = isset($options['wc_custom_css']) ? $options['wc_custom_css'] : '.comments-area{width: 100%;margin: 0 auto;}';
    }

    /**
     * initialize default phrases
     */
    public function init_phrases() {
        $this->wc_phrases = array(
            'wc_leave_a_reply_text' => 'Leave a Reply',
            'wc_be_the_first_text' => 'Be the First to Comment!',
            'wc_header_text' => 'Comment',
            'wc_header_on_text' => 'on',
            'wc_comment_start_text' => 'Start the discussion',
            'wc_comment_join_text' => 'Join the discussion',
            'wc_email_text' => 'Email',
            'wc_name_text' => 'Name',
            'wc_captcha_text' => 'Please insert the code above to comment',
            'wc_submit_text' => 'Post Comment',
            'wc_manage_subscribtions' => 'Manage Subscriptions',
            'wc_notify_on_new_comment' => 'Notify of all new follow-up comments',
            'wc_notify_on_all_new_reply' => 'Notify of new replies to all my comments',
            'wc_notify_on_new_reply' => 'Notify of new replies to this comment',
            'wc_load_more_submit_text' => 'Load More Comments',
            'wc_reply_text' => 'Reply',
            'wc_share_text' => 'Share',
            'wc_share_facebook' => 'Share On Facebook',
            'wc_share_twitter' => 'Share On Twitter',
            'wc_share_google' => 'Share On Google',
            'wc_hide_replies_text' => 'Hide Replies',
            'wc_show_replies_text' => 'Show Replies',
            'wc_user_title_guest_text' => 'Guest',
            'wc_user_title_member_text' => 'Member',
            'wc_user_title_author_text' => 'Author',
            'wc_user_title_admin_text' => 'Admin',
            'wc_email_subject' => 'New Comment',
            'wc_email_message' => 'New comment on the discussion section you\'ve been interested in',
            'wc_new_reply_email_subject' => 'New Reply',
            'wc_new_reply_email_message' => 'New reply on the discussion section you\'ve been interested in',
            'wc_subscribed_on_comment' => 'You\'re subscribed for new replies on this comment',
            'wc_subscribed_on_all_comment' => 'You\'re subscribed for new replies on all your comments',
            'wc_subscribed_on_post' => 'You\'re subscribed for new follow-up comments on this post',
            'wc_unsubscribe' => 'Unsubscribe',
            'wc_unsubscribe_message' => 'You\'ve successfully unsubscribed.',
            'wc_error_empty_text' => 'please fill out this field to comment',
            'wc_error_email_text' => 'email address is invalid',
            'wc_year_text' => array('datetime' => array('year', 1)),
            'wc_month_text' => array('datetime' => array('month', 2)),
            'wc_day_text' => array('datetime' => array('day', 3)),
            'wc_hour_text' => array('datetime' => array('hour', 4)),
            'wc_minute_text' => array('datetime' => array('minute', 5)),
            'wc_second_text' => array('datetime' => array('second', 6)),
            'wc_plural_text' => 's',
            'wc_right_now_text' => 'right now',
            'wc_ago_text' => 'ago',
            'wc_posted_today_text' => 'Today',
            'wc_you_must_be_text' => 'You must be',
            'wc_logged_in_as' => 'You are logged in as',            
            'wc_log_out' => 'Log out',            
            'wc_logged_in_text' => 'logged in',
            'wc_to_post_comment_text' => 'to post a comment.',
            'wc_vote_up' => 'Vote Up',
            'wc_vote_down' => 'Vote Down',
            'wc_vote_counted' => 'Vote Counted',
            'wc_vote_only_one_time' => "You've already voted for this comment",
            'wc_voting_error' => 'Voting Error',
            'wc_login_to_vote' => 'You Must Be Logged In To Vote',
            'wc_self_vote' => 'You cannot vote for your comment',
            'wc_invalid_captcha' => 'Invalid Captcha Code',
            'wc_invalid_field' => 'Some of field value is invalid',
            'wc_held_for_moderate' => 'Your Comment awaiting moderation',
            'wc_new_comment_button_text' => 'new comment',
            'wc_new_comments_button_text' => 'new comments',
            'wc_new_reply_button_text' => 'new reply on your comment',
            'wc_new_replies_button_text' => 'new replies on your comments',
            'wc_new_comments_text' => 'New'
        );
    }

    public function to_array() {
        $options = array(
            'wc_post_types' => $this->wc_post_types,
            'wc_comment_list_order' => $this->wc_comment_list_order,
            'wc_comment_list_update_type' => $this->wc_comment_list_update_type,
            'wc_comment_list_update_timer' => $this->wc_comment_list_update_timer,
            'wc_voting_buttons_show_hide' => $this->wc_voting_buttons_show_hide,
            'wc_share_buttons_show_hide' => $this->wc_share_buttons_show_hide,
            'wc_captcha_show_hide' => $this->wc_captcha_show_hide,
            'wc_user_must_be_registered' => $this->wc_user_must_be_registered,
            'wc_show_hide_loggedin_username' => $this->wc_show_hide_loggedin_username,
            'wc_held_comment_to_moderate' => $this->wc_held_comment_to_moderate,
            'wc_reply_button_guests_show_hide' => $this->wc_reply_button_guests_show_hide,
            'wc_reply_button_members_show_hide' => $this->wc_reply_button_members_show_hide,
            'wc_author_titles_show_hide' => $this->wc_author_titles_show_hide,
            'wc_comment_count' => $this->wc_comment_count,
            'wc_comments_max_depth' => $this->wc_comments_max_depth,
            'wc_simple_comment_date' => $this->wc_simple_comment_date,
            'wc_comment_reply_checkboxes_default_checked' => $this->wc_comment_reply_checkboxes_default_checked,
            'wc_show_hide_comment_checkbox' => $this->wc_show_hide_comment_checkbox,
            'wc_show_hide_all_reply_checkbox' => $this->wc_show_hide_all_reply_checkbox,
            'wc_show_hide_reply_checkbox' => $this->wc_show_hide_reply_checkbox,
            'wc_comment_text_size' => $this->wc_comment_text_size,
            'wc_form_bg_color' => $this->wc_form_bg_color,
            'wc_comment_bg_color' => $this->wc_comment_bg_color,
            'wc_reply_bg_color' => $this->wc_reply_bg_color,
            'wc_comment_text_color' => $this->wc_comment_text_color,
            'wc_author_title_color' => $this->wc_author_title_color,
            'wc_vote_reply_color' => $this->wc_vote_reply_color,
            'wc_new_loaded_comment_bg_color' => $this->wc_new_loaded_comment_bg_color,
            'wc_custom_css' => $this->wc_custom_css
        );

        return $options;
    }

    public function update_options() {
        update_option($this->wc_options_slug, serialize($this->to_array()));
    }

    public function add_options() {
        $options = array(
            'wc_post_types' => $this->wc_post_types,
            'wc_comment_list_order' => 'desc',
            'wc_comment_list_update_type' => '0',
            'wc_comment_list_update_timer' => '30',
            'wc_voting_buttons_show_hide' => '0',
            'wc_share_buttons_show_hide' => '0',
            'wc_captcha_show_hide' => '0',
            'wc_user_must_be_registered' => '0',
            'wc_show_hide_loggedin_username' => '1',
            'wc_held_comment_to_moderate' => '1',
            'wc_reply_button_guests_show_hide' => '0',
            'wc_reply_button_members_show_hide' => '0',
            'wc_author_titles_show_hide' => '0',
            'wc_comment_count' => '5',
            'wc_comments_max_depth' => '3',
            'wc_simple_comment_date' => '0',
            'wc_comment_reply_checkboxes_default_checked' => '0',
            'wc_show_hide_comment_checkbox' => '1',
            'wc_show_hide_all_reply_checkbox' => '1',
            'wc_show_hide_reply_checkbox' => '1',
            'wc_comment_text_size' => '14px',
            'wc_form_bg_color' => '#f9f9f9',
            'wc_comment_bg_color' => '#fefefe',
            'wc_reply_bg_color' => '#f8f8f8',
            'wc_comment_text_color' => '#555',
            'wc_author_title_color' => '#00B38F',
            'wc_vote_reply_color' => '#666666',
            'wc_new_loaded_comment_bg_color' => 'rgb(255,250,214)',
            'wc_custom_css' => '.comments-area{width: 100%;margin: 0 auto;}'
        );
        add_option($this->wc_options_slug, serialize($options));
    }

    public function init_phrases_on_load() {
        if ($this->wc_db_helper->is_phrase_exists('wc_leave_a_reply_text')) {
            $this->wc_phrases = $this->wc_db_helper->get_phrases();
        }
    }

}
