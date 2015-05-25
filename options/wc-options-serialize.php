<?php

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
     * Type - Dropdown menu
     * Available Values - Not Allow(0), 900s(15 minutes)  1800s(30 minutes), 3600s(1 hour), 10800s(3 hours), 86400(24 hours)
     * Description - Allow commnet editing after comment subimt
     * Default Value - Editable comment time value
     */
    public $wc_comment_editable_time;

    /**
     * Type - Dropdown menu
     * Available Values - list of pages (ids)
     * Description - Redirect first commenter to the selected page
     * Default Value - 0
     */
    public $wpdiscuz_redirect_page;

    /**
     * Type - Checkbox
     * Available Values - Checked/Unchecked
     * Description - Allow guests to vote on comments
     * Default Value - Checked
     */
    public $wc_is_guest_can_vote;

    /**
     * Type - Checkbox
     * Available Values - Checked/Unchecked
     * Description - Load all comments on click load more button
     * Default Value - Unchecked
     */
    public $wc_load_all_comments;

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

    /*
     * Type - Checkbox
     * Available Values - Checked/Unchecked
     * Description - Show/Hide the  Web URL field
     * Default Value - Unchecked
     */
    public $wc_weburl_show_hide;
    
    /*
     * Type - Checkbox
     * Available Values - Checked/Unchecked
     * Description - Show/Hide header text
     * Default Value - Unchecked
     */
    public $wc_header_text_show_hide;

    
    /*
     * Type - Checkbox
     * Available Values - Checked/Unchecked
     * Description - Show/Hide user avatar
     * Default Value - Unchecked
     */
    public $wc_avatar_show_hide;
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
     * Description - If checked user must fill this field
     * Default Value - Checked
     */
    public $wc_is_name_field_required;

    /**
     * Type - Checkbox
     * Available Values - Checked/Unchecked
     * Description - If checked user must fill this field
     * Default Value - Checked
     */
    public $wc_is_email_field_required;

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
     * Type - Checkbox
     * Available Values - Checked/Unchecked
     * Description - Use Postmatic plugin for comment notification
     * Default Value - Unchecked
     */
    public $wc_use_postmatic_for_comment_notification;

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
     * Description - Form imput border olor
     * Default Value - #d9d9d9
     */
    public $wc_input_border_color;

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

    /**
     * Type - Checkbox
     * Available Values - Checked/Unchecked
     * Description - Hide plugin powerid by information
     * Default Value - Unchecked
     */
    public $wc_show_plugin_powerid_by;
    
    /**
     * Type - Checkbox
     * Available Values - Checked/Unchecked
     * Description - Use .PO/.MO files
     * Default Value - Unchecked
     */
    public $wc_is_use_po_mo;
    
    /**
     * Type - Input
     * Available Values - Integer (comment text length)
     * Description - Define comment text max length (leave blank for unlimit length)
     * Default Value - Unlimit
     */
    public $wc_comment_text_max_length;
    

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
        $this->wc_comment_editable_time = isset($options['wc_comment_editable_time']) ? $options['wc_comment_editable_time'] : 900;
        $this->wpdiscuz_redirect_page = isset($options['wpdiscuz_redirect_page']) ? $options['wpdiscuz_redirect_page'] : 0;
        $this->wc_is_guest_can_vote = isset($options['wc_is_guest_can_vote']) ? $options['wc_is_guest_can_vote'] : 0;
        $this->wc_load_all_comments = isset($options['wc_load_all_comments']) ? $options['wc_load_all_comments'] : 0;
        $this->wc_voting_buttons_show_hide = $options['wc_voting_buttons_show_hide'];
        $this->wc_share_buttons_show_hide = $options['wc_share_buttons_show_hide'];
        $this->wc_captcha_show_hide = $options['wc_captcha_show_hide'];
        $this->wc_weburl_show_hide = isset($options['wc_weburl_show_hide']) ? $options['wc_weburl_show_hide'] : 0;
        $this->wc_header_text_show_hide = isset($options['wc_header_text_show_hide']) ? $options['wc_header_text_show_hide'] : 0;
        $this->wc_avatar_show_hide = isset($options['wc_avatar_show_hide']) ? $options['wc_avatar_show_hide'] : 0;
        $this->wc_user_must_be_registered = $options['wc_user_must_be_registered'];
        $this->wc_is_name_field_required = isset($options['wc_is_name_field_required']) ? $options['wc_is_name_field_required'] : 0;
        $this->wc_is_email_field_required = isset($options['wc_is_email_field_required']) ? $options['wc_is_email_field_required'] : 0;
        $this->wc_show_hide_loggedin_username = isset($options['wc_show_hide_loggedin_username']) ? $options['wc_show_hide_loggedin_username'] : 0;
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
        $this->wc_use_postmatic_for_comment_notification = isset($options['wc_use_postmatic_for_comment_notification']) ? $options['wc_use_postmatic_for_comment_notification'] : 0;
        $this->wc_comment_text_size = isset($options['wc_comment_text_size']) ? $options['wc_comment_text_size'] : '14px';
        $this->wc_form_bg_color = isset($options['wc_form_bg_color']) ? $options['wc_form_bg_color'] : '#f9f9f9';
        $this->wc_comment_bg_color = $options['wc_comment_bg_color'];
        $this->wc_reply_bg_color = $options['wc_reply_bg_color'];
        $this->wc_comment_text_color = $options['wc_comment_text_color'];
        $this->wc_author_title_color = $options['wc_author_title_color'];
        $this->wc_vote_reply_color = $options['wc_vote_reply_color'];
        $this->wc_input_border_color = isset($options['wc_input_border_color']) ? $options['wc_input_border_color'] : "#d9d9d9";
        $this->wc_new_loaded_comment_bg_color = isset($options['wc_new_loaded_comment_bg_color']) ? $options['wc_new_loaded_comment_bg_color'] : "rgb(255,250,214)";
        $this->wc_custom_css = isset($options['wc_custom_css']) ? $options['wc_custom_css'] : '.comments-area{width:auto; margin: 0 auto;}';
        $this->wc_show_plugin_powerid_by = isset($options['wc_show_plugin_powerid_by']) ? $options['wc_show_plugin_powerid_by'] : 0;
        $this->wc_is_use_po_mo = isset($options['wc_is_use_po_mo']) ? $options['wc_is_use_po_mo'] : 0;
        $this->wc_comment_text_max_length = isset($options['wc_comment_text_max_length']) ? $options['wc_comment_text_max_length'] : '';
    }

    /**
     * initialize default phrases
     */
    public function init_phrases() {
        $this->wc_phrases = array(
            'wc_leave_a_reply_text' => __('Leave a Reply', WC_Core::$TEXT_DOMAIN),
            'wc_be_the_first_text' => __('Be the First to Comment!', WC_Core::$TEXT_DOMAIN),
            'wc_header_text' => __('Comment', WC_Core::$TEXT_DOMAIN),
            'wc_header_text_plural' => __('Comments', WC_Core::$TEXT_DOMAIN), // PLURAL
            'wc_header_on_text' => __('on', WC_Core::$TEXT_DOMAIN),
            'wc_comment_start_text' => __('Start the discussion', WC_Core::$TEXT_DOMAIN),
            'wc_comment_join_text' => __('Join the discussion', WC_Core::$TEXT_DOMAIN),
            'wc_email_text' => __('Email', WC_Core::$TEXT_DOMAIN),
            'wc_name_text' => __('Name', WC_Core::$TEXT_DOMAIN),
            'wc_website_text' => __('WebSite URL', WC_Core::$TEXT_DOMAIN),
            'wc_captcha_text' => __('Please insert the code above to comment', WC_Core::$TEXT_DOMAIN),
            'wc_submit_text' => __('Post Comment', WC_Core::$TEXT_DOMAIN),
            'wc_manage_subscribtions' => __('Manage Subscriptions', WC_Core::$TEXT_DOMAIN),
            'wc_notify_none' => __('None', WC_Core::$TEXT_DOMAIN),
            'wc_notify_on_new_comment' => __('Notify of all new follow-up comments', WC_Core::$TEXT_DOMAIN),
            'wc_notify_on_all_new_reply' => __('Notify of new replies to all my comments', WC_Core::$TEXT_DOMAIN),
            'wc_notify_on_new_reply' => __('Notify of new replies to this comment', WC_Core::$TEXT_DOMAIN),
            'wc_load_more_submit_text' => __('Load More Comments', WC_Core::$TEXT_DOMAIN),
            'wc_load_rest_comments_submit_text' => __('Load Rest of Comments', WC_Core::$TEXT_DOMAIN),
            'wc_reply_text' => __('Reply', WC_Core::$TEXT_DOMAIN),
            'wc_share_text' => __('Share', WC_Core::$TEXT_DOMAIN),
            'wc_edit_text' => __('Edit', WC_Core::$TEXT_DOMAIN),
            'wc_share_facebook' => __('Share On Facebook', WC_Core::$TEXT_DOMAIN),
            'wc_share_twitter' => __('Share On Twitter', WC_Core::$TEXT_DOMAIN),
            'wc_share_google' => __('Share On Google', WC_Core::$TEXT_DOMAIN),
            'wc_share_vk' => __('Share On VKontakte', WC_Core::$TEXT_DOMAIN),
            'wc_share_ok' => __('Share On Odnoklassniki', WC_Core::$TEXT_DOMAIN),
            'wc_hide_replies_text' => __('Hide Replies', WC_Core::$TEXT_DOMAIN),
            'wc_show_replies_text' => __('Show Replies', WC_Core::$TEXT_DOMAIN),
            'wc_user_title_guest_text' => __('Guest', WC_Core::$TEXT_DOMAIN),
            'wc_user_title_member_text' => __('Member', WC_Core::$TEXT_DOMAIN),
            'wc_user_title_author_text' => __('Author', WC_Core::$TEXT_DOMAIN),
            'wc_user_title_admin_text' => __('Admin', WC_Core::$TEXT_DOMAIN),
            'wc_email_subject' => __('New Comment', WC_Core::$TEXT_DOMAIN),
            'wc_email_message' => __('New comment on the discussion section you\'ve been interested in', WC_Core::$TEXT_DOMAIN),
            'wc_new_reply_email_subject' => __('New Reply', WC_Core::$TEXT_DOMAIN),
            'wc_new_reply_email_message' => __('New reply on the discussion section you\'ve been interested in', WC_Core::$TEXT_DOMAIN),
            'wc_subscribed_on_comment' => __('You\'re subscribed for new replies on this comment', WC_Core::$TEXT_DOMAIN),
            'wc_subscribed_on_all_comment' => __('You\'re subscribed for new replies on all your comments', WC_Core::$TEXT_DOMAIN),
            'wc_subscribed_on_post' => __('You\'re subscribed for new follow-up comments on this post', WC_Core::$TEXT_DOMAIN),
            'wc_unsubscribe' => __('Unsubscribe', WC_Core::$TEXT_DOMAIN),
            'wc_ignore_subscription' => __('Ignore Subscription', WC_Core::$TEXT_DOMAIN),
            'wc_unsubscribe_message' => __('You\'ve successfully unsubscribed.', WC_Core::$TEXT_DOMAIN),
            'wc_confirm_email' => __('Confirm your subscription', WC_Core::$TEXT_DOMAIN),
            'wc_comfirm_success_message' => __('You\'ve successfully confirmed your subscription.', WC_Core::$TEXT_DOMAIN),
            'wc_confirm_email_subject' => __('Subscribe Confirmation', WC_Core::$TEXT_DOMAIN),
            'wc_confirm_email_message' => __('Hi, <br/> You just subscribed for new comments on our website. This means you will receive an email when new comments are posted according to subscription option you\'ve chosen. <br/> To activate, click confirm below. If you believe this is an error, ignore this message and we\'ll never bother you again.', WC_Core::$TEXT_DOMAIN),
            'wc_error_empty_text' => __('please fill out this field to comment', WC_Core::$TEXT_DOMAIN),
            'wc_error_email_text' => __('email address is invalid', WC_Core::$TEXT_DOMAIN),
            'wc_error_url_text' => __('url is invalid', WC_Core::$TEXT_DOMAIN),
            'wc_year_text' => array('datetime' => array(__('year', WC_Core::$TEXT_DOMAIN), 1)),
            'wc_year_text_plural' => array('datetime' => array(__('years', WC_Core::$TEXT_DOMAIN), 1)), // PLURAL
            'wc_month_text' => array('datetime' => array(__('month', WC_Core::$TEXT_DOMAIN), 2)),
            'wc_month_text_plural' => array('datetime' => array(__('months', WC_Core::$TEXT_DOMAIN), 2)), // PLURAL
            'wc_day_text' => array('datetime' => array(__('day', WC_Core::$TEXT_DOMAIN), 3)),
            'wc_day_text_plural' => array('datetime' => array(__('days', WC_Core::$TEXT_DOMAIN), 3)), // PLURAL
            'wc_hour_text' => array('datetime' => array(__('hour', WC_Core::$TEXT_DOMAIN), 4)),
            'wc_hour_text_plural' => array('datetime' => array(__('hours', WC_Core::$TEXT_DOMAIN), 4)), // PLURAL
            'wc_minute_text' => array('datetime' => array(__('minute', WC_Core::$TEXT_DOMAIN), 5)),
            'wc_minute_text_plural' => array('datetime' => array(__('minutes', WC_Core::$TEXT_DOMAIN), 5)), // PLURAL
            'wc_second_text' => array('datetime' => array(__('second', WC_Core::$TEXT_DOMAIN), 6)),
            'wc_second_text_plural' => array('datetime' => array(__('seconds', WC_Core::$TEXT_DOMAIN), 6)), // PLURAL
            'wc_right_now_text' => __('right now', WC_Core::$TEXT_DOMAIN),
            'wc_ago_text' => __('ago', WC_Core::$TEXT_DOMAIN),
            'wc_posted_today_text' => __('Today', WC_Core::$TEXT_DOMAIN),
            'wc_you_must_be_text' => __('You must be', WC_Core::$TEXT_DOMAIN),
            'wc_logged_in_as' => __('You are logged in as', WC_Core::$TEXT_DOMAIN),
            'wc_log_out' => __('Log out', WC_Core::$TEXT_DOMAIN),
            'wc_logged_in_text' => __('logged in', WC_Core::$TEXT_DOMAIN),
            'wc_to_post_comment_text' => __('to post a comment.', WC_Core::$TEXT_DOMAIN),
            'wc_vote_up' => __('Vote Up', WC_Core::$TEXT_DOMAIN),
            'wc_vote_down' => __('Vote Down', WC_Core::$TEXT_DOMAIN),
            'wc_vote_counted' => __('Vote Counted', WC_Core::$TEXT_DOMAIN),
            'wc_vote_only_one_time' => __("You've already voted for this comment", WC_Core::$TEXT_DOMAIN),
            'wc_voting_error' => __('Voting Error', WC_Core::$TEXT_DOMAIN),
            'wc_login_to_vote' => __('You Must Be Logged In To Vote', WC_Core::$TEXT_DOMAIN),
            'wc_self_vote' => __('You cannot vote for your comment', WC_Core::$TEXT_DOMAIN),
            'wc_deny_voting_from_same_ip' => __('You are not allowed to vote for this comment', WC_Core::$TEXT_DOMAIN),
            'wc_invalid_captcha' => __('Invalid Captcha Code', WC_Core::$TEXT_DOMAIN),
            'wc_invalid_field' => __('Some of field value is invalid', WC_Core::$TEXT_DOMAIN),
            'wc_new_comment_button_text' => __('new comment', WC_Core::$TEXT_DOMAIN),
            'wc_new_comments_button_text' => __('new comments', WC_Core::$TEXT_DOMAIN), // PLURAL
            'wc_held_for_moderate' => __('Comment awaiting moderation', WC_Core::$TEXT_DOMAIN),
            'wc_new_reply_button_text' => __('new reply on your comment', WC_Core::$TEXT_DOMAIN),
            'wc_new_replies_button_text' => __('new replies on your comments', WC_Core::$TEXT_DOMAIN), // PLURAL
            'wc_new_comments_text' => __('New', WC_Core::$TEXT_DOMAIN),
            'wc_comment_not_updated' => __('Sorry, the comment was not updated', WC_Core::$TEXT_DOMAIN),
            'wc_comment_edit_not_possible' => __('Sorry, this comment no longer possible to edit', WC_Core::$TEXT_DOMAIN),
            'wc_comment_not_edited' => __('You\'ve not made any changes', WC_Core::$TEXT_DOMAIN),
            'wc_comment_edit_save_button' => __('Save', WC_Core::$TEXT_DOMAIN),
            'wc_comment_edit_cancel_button' => __('Cancel', WC_Core::$TEXT_DOMAIN),
            'wc_msg_comment_text_max_length' => __('Comment text is too long (maximum %s characters allowed)', WC_Core::$TEXT_DOMAIN)
        );
    }

    public function to_array() {
        $options = array(
            'wc_post_types' => $this->wc_post_types,
            'wc_comment_list_order' => $this->wc_comment_list_order,
            'wc_comment_list_update_type' => $this->wc_comment_list_update_type,
            'wc_comment_list_update_timer' => $this->wc_comment_list_update_timer,
            'wc_comment_editable_time' => $this->wc_comment_editable_time,
            'wpdiscuz_redirect_page' => $this->wpdiscuz_redirect_page,
            'wc_is_guest_can_vote' => $this->wc_is_guest_can_vote,
            'wc_load_all_comments' => $this->wc_load_all_comments,
            'wc_voting_buttons_show_hide' => $this->wc_voting_buttons_show_hide,
            'wc_share_buttons_show_hide' => $this->wc_share_buttons_show_hide,
            'wc_captcha_show_hide' => $this->wc_captcha_show_hide,
            'wc_weburl_show_hide' => $this->wc_weburl_show_hide,
            'wc_header_text_show_hide' => $this->wc_header_text_show_hide,
            'wc_avatar_show_hide' => $this->wc_avatar_show_hide,
            'wc_user_must_be_registered' => $this->wc_user_must_be_registered,
            'wc_is_name_field_required' => $this->wc_is_name_field_required,
            'wc_is_email_field_required' => $this->wc_is_email_field_required,
            'wc_show_hide_loggedin_username' => $this->wc_show_hide_loggedin_username,
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
            'wc_use_postmatic_for_comment_notification' => $this->wc_use_postmatic_for_comment_notification,
            'wc_comment_text_size' => $this->wc_comment_text_size,
            'wc_form_bg_color' => $this->wc_form_bg_color,
            'wc_comment_bg_color' => $this->wc_comment_bg_color,
            'wc_reply_bg_color' => $this->wc_reply_bg_color,
            'wc_comment_text_color' => $this->wc_comment_text_color,
            'wc_author_title_color' => $this->wc_author_title_color,
            'wc_vote_reply_color' => $this->wc_vote_reply_color,
            'wc_input_border_color' => $this->wc_input_border_color,
            'wc_new_loaded_comment_bg_color' => $this->wc_new_loaded_comment_bg_color,
            'wc_custom_css' => $this->wc_custom_css,
            'wc_show_plugin_powerid_by' => $this->wc_show_plugin_powerid_by,
            'wc_is_use_po_mo' => $this->wc_is_use_po_mo,
            'wc_comment_text_max_length' => $this->wc_comment_text_max_length
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
            'wc_comment_editable_time' => '900',
            'wpdiscuz_redirect_page' => '0',
            'wc_is_guest_can_vote' => '1',
            'wc_load_all_comments' => '0',
            'wc_voting_buttons_show_hide' => '0',
            'wc_share_buttons_show_hide' => '0',
            'wc_captcha_show_hide' => '0',
            'wc_weburl_show_hide' => '1',
            'wc_header_text_show_hide' => '0',
            'wc_avatar_show_hide' => '0',
            'wc_user_must_be_registered' => '0',
            'wc_is_name_field_required' => '1',
            'wc_is_email_field_required' => '1',
            'wc_show_hide_loggedin_username' => '1',
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
            'wc_use_postmatic_for_comment_notification' => '0',
            'wc_comment_text_size' => '14px',
            'wc_form_bg_color' => '#f9f9f9',
            'wc_comment_bg_color' => '#fefefe',
            'wc_reply_bg_color' => '#f8f8f8',
            'wc_comment_text_color' => '#555',
            'wc_author_title_color' => '#00B38F',
            'wc_vote_reply_color' => '#666666',
            'wc_input_border_color' => '#d9d9d9',
            'wc_new_loaded_comment_bg_color' => 'rgb(255,250,214)',
            'wc_custom_css' => '.comments-area{width:auto;}',
            'wc_show_plugin_powerid_by' => '0',
            'wc_is_use_po_mo' => '0',
            'wc_comment_text_max_length' => ''
        );
        add_option($this->wc_options_slug, serialize($options));
    }

    public function init_phrases_on_load() {
        if (!$this->wc_is_use_po_mo && $this->wc_db_helper->is_phrase_exists('wc_leave_a_reply_text')) {
            $this->wc_phrases = $this->wc_db_helper->get_phrases();
        }else{
            $this->init_phrases();
        }
    }

}