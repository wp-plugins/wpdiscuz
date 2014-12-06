<?php

include_once 'includes/wc-db-helper.php';

class WC_Options_Serialize {

    public $wc_options_slug = 'wc_options';

    /* Type - Checkbox array
     * Available Values - Checked/Unchecked
     * Description - On which post types display comment form
     * Default Value - Post
     */
    public $wc_post_types = array('post');

    /* Type - Checkbox
     * Available Values - Checked/Unchecked
     * Description - Show/Hide Voting buttons
     * Default Value - Unchecked
     */
    public $wc_voting_buttons_show_hide;

    /*
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

    /*
     * Type - Radiobutton
     * Available Values - Yes/No
     * Description - User Must be registered to comment
     *      (If this option is set “Yes”, the comment form will be hidden, 
     *      instead of the form there will be a link to registration page.)
     * Default Value - No
     */
    public $wc_user_must_be_registered;

    /*
     * Type - Checkbox
     * Available Values - Checked/Unchecked
     * Description - If checked held the comment to approve manually    
     * Default Value - Unchecked
     */
    public $wc_held_comment_to_moderate;

    /*
     * Type - Checkbox
     * Available Values - Checked/Unchecked
     * Description - Show/Hide Reply button for Guests 
     * Default Value - Unchecked
     */
    public $wc_reply_button_guests_show_hide;

    /*
     * Type - Checkbox
     * Available Values - Checked/Unchecked
     * Description - Show/Hide Reply button for Customers 
     * Default Value - Unchecked
     */
    public $wc_reply_button_members_show_hide;

    /*
     * Type - Checkbox
     * Available Values - Checked/Unchecked
     * Description - Show/Hide Author Titles
     * Default Value - Unchecked   
     */
    public $wc_author_titles_show_hide;

    /*
     * Type - Input
     * Available Values - Integer
     * Description - Comment count per click
     * Default Value - 5
     */
    public $wc_comment_count;

    /*
     * Type - Checkbox
     * Available Values - Checked/Unchecked
     * Description - Notify moderator on new comment
     * Default Value - Checked
     */
    public $wc_notify_moderator;

    /*
     * Type - Checkbox
     * Available Values - Checked/Unchecked
     * Description - Notify comment author on new reply
     * Default Value - Checked
     */
    public $wc_notify_comment_author;

    /*
     * Type - Input
     * Available Values - color codes
     * Description - Comment Background Color
     * Default Value - #fefefe
     */
    public $wc_comment_bg_color;

    /*
     * Type - Input
     * Available Values - color codes
     * Description - Reply Background Color
     * Default Value - #f8f8f8
     */
    public $wc_reply_bg_color;

    /*
     * Type - Input
     * Available Values - color codes
     * Description - Comment Text Color
     * Default Value - #555
     */
    public $wc_comment_text_color;

    /*
     * Type - Input
     * Available Values - color codes
     * Description - Author title Color, Author title label color
     * Default Value - #ad74a2
     */
    public $wc_author_title_color;

    /*
     * Type - Input
     * Available Values - color codes
     * Description - Vote, Reply, Share, Edit - text colors
     * Default Value - #85ad74
     */
    public $wc_vote_reply_color;


    /*
     * Type - Textarea
     * Available Values - custom css code
     * Description - Custom css code
     * Default Value - 
     */
    public $wc_custom_css;



    /*
     * Type - HTML elements array
     * Available Values - Text
     * Description - Phrases for form elements texts
     * Default Value - 
     */
    public $wc_phrases;
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
        $this->wc_voting_buttons_show_hide = $options['wc_voting_buttons_show_hide'];
        $this->wc_share_buttons_show_hide = $options['wc_share_buttons_show_hide'];
        $this->wc_captcha_show_hide = $options['wc_captcha_show_hide'];
        $this->wc_user_must_be_registered = $options['wc_user_must_be_registered'];
        $this->wc_held_comment_to_moderate = $options['wc_held_comment_to_moderate'];
        $this->wc_reply_button_guests_show_hide = $options['wc_reply_button_guests_show_hide'];
        $this->wc_reply_button_members_show_hide = $options['wc_reply_button_members_show_hide'];
        $this->wc_author_titles_show_hide = $options['wc_author_titles_show_hide'];
        $this->wc_comment_count = $options['wc_comment_count'];
        $this->wc_notify_moderator = $options['wc_notify_moderator'];
        $this->wc_notify_comment_author = $options['wc_notify_comment_author'];
        $this->wc_comment_bg_color = $options['wc_comment_bg_color'];
        $this->wc_reply_bg_color = $options['wc_reply_bg_color'];
        $this->wc_comment_text_color = $options['wc_comment_text_color'];
        $this->wc_author_title_color = $options['wc_author_title_color'];
        $this->wc_vote_reply_color = $options['wc_vote_reply_color'];
        $this->wc_custom_css = $options['wc_custom_css'];
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
            'wc_you_must_be_text' => 'You must be',
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
        );
    }

    public function to_array() {
        $options = array(
            'wc_post_types' => $this->wc_post_types,
            'wc_voting_buttons_show_hide' => $this->wc_voting_buttons_show_hide,
            'wc_share_buttons_show_hide' => $this->wc_share_buttons_show_hide,
            'wc_captcha_show_hide' => $this->wc_captcha_show_hide,
            'wc_user_must_be_registered' => $this->wc_user_must_be_registered,
            'wc_held_comment_to_moderate' => $this->wc_held_comment_to_moderate,
            'wc_reply_button_guests_show_hide' => $this->wc_reply_button_guests_show_hide,
            'wc_reply_button_members_show_hide' => $this->wc_reply_button_members_show_hide,
            'wc_author_titles_show_hide' => $this->wc_author_titles_show_hide,
            'wc_comment_count' => $this->wc_comment_count,
            'wc_notify_moderator' => $this->wc_notify_moderator,
            'wc_notify_comment_author' => $this->wc_notify_comment_author,
            'wc_comment_bg_color' => $this->wc_comment_bg_color,
            'wc_reply_bg_color' => $this->wc_reply_bg_color,
            'wc_comment_text_color' => $this->wc_comment_text_color,
            'wc_author_title_color' => $this->wc_author_title_color,
            'wc_vote_reply_color' => $this->wc_vote_reply_color,
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
            'wc_voting_buttons_show_hide' => '0',
            'wc_share_buttons_show_hide' => '0',
            'wc_captcha_show_hide' => '0',
            'wc_user_must_be_registered' => '0',
            'wc_held_comment_to_moderate' => '1',
            'wc_reply_button_guests_show_hide' => '0',
            'wc_reply_button_members_show_hide' => '0',
            'wc_author_titles_show_hide' => '0',
            'wc_comment_count' => '5',
            'wc_notify_moderator' => '1',
            'wc_notify_comment_author' => '1',
            'wc_comment_bg_color' => '#fefefe',
            'wc_reply_bg_color' => '#f8f8f8',
            'wc_comment_text_color' => '#555',
            'wc_author_title_color' => '#00B38F',
            'wc_vote_reply_color' => '#666666',
            'wc_custom_css' => '.comments-area{width: 100%;margin: 0 auto;}'
        );
        add_option($this->wc_options_slug, serialize($options));
    }

    public function init_phrases_on_load() {
        if ($this->wc_db_helper->is_phrase_exists('wc_discuss_tab')) {
            $this->wc_phrases = $this->wc_db_helper->get_phrases();
        }
    }

}
