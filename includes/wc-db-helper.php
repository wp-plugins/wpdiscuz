<?php

class WC_DB_Helper {

    private $db;
    private $dbprefix;
    private $users_voted;
    private $phrases;
    private $email_notification;

    function __construct() {
        global $wpdb;
        $this->db = $wpdb;
        $this->dbprefix = $wpdb->prefix;
        $this->users_voted = $this->dbprefix . 'wc_users_voted';
        $this->phrases = $this->dbprefix . 'wc_phrases';
        $this->email_notification = $this->dbprefix . 'wc_email_notify';
    }

    /**
     * create table in db on activation if not exists
     */
    public function create_tables() {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        if (!$this->wc_is_table_exists($this->users_voted)) {
            $sql = "CREATE TABLE `" . $this->users_voted . "`(`id` INT(11) NOT NULL AUTO_INCREMENT,`user_id` INT(11) NOT NULL, `comment_id` INT(11) NOT NULL, `vote_type` INT(11) DEFAULT NULL, PRIMARY KEY (`id`), KEY `user_id` (`user_id`), KEY `comment_id` (`comment_id`),  KEY `vote_type` (`vote_type`)) ENGINE=MyISAM DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci AUTO_INCREMENT=1;";
            dbDelta($sql);
        }
        if (!$this->wc_is_table_exists($this->phrases)) {
            $sql = "CREATE TABLE `" . $this->phrases . "`(`id` INT(11) NOT NULL AUTO_INCREMENT, `phrase_key` VARCHAR(255) NOT NULL, `phrase_value` VARCHAR(255) NOT NULL, PRIMARY KEY (`id`), KEY `phrase_key` (`phrase_key`)) ENGINE=MyISAM DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci AUTO_INCREMENT=1;";
            dbDelta($sql);
        }
        $this->wc_create_email_notification_table();
    }

    /**
     * check if table exists in database
     * return true if exists false otherwise
     */
    public function wc_is_table_exists($wc_table_name) {
        return $this->db->get_var("SHOW TABLES LIKE '$wc_table_name'") == $wc_table_name;
    }

    public function wc_create_email_notification_table() {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        $wc_old_notification_table_name = $this->dbprefix . 'wc_email_notfication';
        if (!$this->wc_is_table_exists($this->email_notification)) {
            $sql = "CREATE TABLE `" . $this->email_notification . "`(`id` INT(11) NOT NULL AUTO_INCREMENT, `email` VARCHAR(255) NOT NULL, `subscribtion_id` INT(11) NOT NULL, `post_id` INT(11) NOT NULL, `subscribtion_type` VARCHAR(255) NOT NULL, `activation_key` VARCHAR(255) NOT NULL, PRIMARY KEY (`id`), KEY `subscribtion_id` (`subscribtion_id`), KEY `post_id` (`post_id`)) ENGINE=MYISAM DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci AUTO_INCREMENT=1;";
            dbDelta($sql);
        }

        if ($this->wc_is_table_exists($wc_old_notification_table_name)) {
            $this->wc_save_notification_data($wc_old_notification_table_name);
        }
    }

    /**
     * save old notification data into new created table and drop old table
     */
    public function wc_save_notification_data($wc_old_notification_table_name) {
        $sql_post_notification_data = "SELECT * FROM `" . $wc_old_notification_table_name . "` WHERE `post_id` > 0;";
        $sql_comment_notification_data = "SELECT * FROM `" . $wc_old_notification_table_name . "` WHERE `comment_id` > 0;";
        $post_notifications_data = $this->db->get_results($sql_post_notification_data, ARRAY_A);
        $comment_notifications_data = $this->db->get_results($sql_comment_notification_data, ARRAY_A);
        $inserted_post_ids = array();
        foreach ($post_notifications_data as $p_notification_data) {
            $email = $p_notification_data['email'];
            $post_id = $p_notification_data['post_id'];
            $inserted_post_ids[] = $post_id;
            $subscribtion_type = "post";
            $activation_key = md5($email . uniqid() . time());
            $sql_add_old_post_notification = "INSERT INTO `" . $this->email_notification . "` (`email`, `subscribtion_id`, `post_id`, `subscribtion_type`, `activation_key`) VALUES('$email', $post_id, $post_id, '$subscribtion_type', '$activation_key');";
            $this->db->query($sql_add_old_post_notification);
        }

        foreach ($comment_notifications_data as $c_notification_data) {
            $email = $c_notification_data['email'];
            $comment_id = $c_notification_data['comment_id'];
            $comment = get_comment($comment_id);
            if (!$this->wc_has_comment_notification($comment->comment_post_ID, $comment_id, $email)) {
                $subscribtion_type = "comment";
                $activation_key = md5($email . uniqid() . time());
                $sql_add_old_post_notification = "INSERT INTO `" . $this->email_notification . "` (`email`, `subscribtion_id`, `post_id`, `subscribtion_type`, `activation_key`) VALUES('$email', $comment_id, $comment->comment_post_ID, '$subscribtion_type', '$activation_key');";
                $this->db->query($sql_add_old_post_notification);
            }
        }

        $sql_drop_old_notification_table = "DROP TABLE `" . $wc_old_notification_table_name . "`;";
        $this->db->query($sql_drop_old_notification_table);
    }

    /**
     * add vote type
     */
    public function add_vote_type($user_id, $comment_id, $vote_type) {
        $sql = $this->db->prepare("INSERT INTO `" . $this->users_voted . "`(`user_id`, `comment_id`, `vote_type`)VALUES(%d,%d,%d);", $user_id, $comment_id, $vote_type);
        return $this->db->query($sql);
    }

    /**
     * update vote type
     */
    public function update_vote_type($user_id, $comment_id, $vote_type) {
        $sql = $this->db->prepare("UPDATE `" . $this->users_voted . "` SET `vote_type` = %d WHERE `user_id` = %d AND `comment_id` = %d", $vote_type, $user_id, $comment_id);
        return $this->db->query($sql);
    }

    /**
     * check if the user is already voted on comment or not by user id and comment id
     */
    public function is_user_voted($user_id, $comment_id) {
        $sql = $this->db->prepare("SELECT `vote_type` FROM `" . $this->users_voted . "` WHERE `user_id` = %d AND `comment_id` = %d;", $user_id, $comment_id);
        return $this->db->get_var($sql);
    }

    /**
     * update phrases 
     */
    public function update_phrases($phrases) {
        if ($phrases) {
            foreach ($phrases as $phrase_key => $phrase_value) {

                if (is_array($phrase_value) && array_key_exists(WC_Helper::$datetime, $phrase_value)) {
                    $phrase_value = $phrase_value[WC_Helper::$datetime][0];
                }
                if ($this->is_phrase_exists($phrase_key)) {
                    $sql = $this->db->prepare("UPDATE `" . $this->phrases . "` SET `phrase_value` = %s WHERE `phrase_key` = %s;", $phrase_value, $phrase_key);
                } else {
                    $sql = $this->db->prepare("INSERT INTO `" . $this->phrases . "`(`phrase_key`, `phrase_value`)VALUES(%s, %s);", $phrase_key, $phrase_value);
                }
                $this->db->query($sql);
            }
        }
    }

    public function is_phrase_exists($phrase_key) {
        $sql = $this->db->prepare("SELECT `phrase_key` FROM `" . $this->phrases . "` WHERE `phrase_key` LIKE %s", $phrase_key);
        return $this->db->get_var($sql);
    }

    /**
     * get phrases from db
     */
    public function get_phrases() {
        $sql = "SELECT `phrase_key`, `phrase_value` FROM `" . $this->phrases . "`;";
        $phrases = $this->db->get_results($sql, ARRAY_A);
        $tmp_phrases = array();
        foreach ($phrases as $phrase) {
            if (!is_array($phrase)) {
                $phrase = stripslashes($phrase);
            }
            $tmp_phrases[$phrase['phrase_key']] = WC_Helper::init_phrase_key_value($phrase);
        }
        return $tmp_phrases;
    }

    /**
     * 
     * @param type $post_id the current post id
     * @param type $user_email the comment author email
     * @param type $date_from 
     * @return type int, all comments count for current post or count for author
     */
    public function get_comments_count($post_id, $user_email = null, $date_from = null) {
        if ($user_email && $date_from) {
            $sql_new_comments = $this->db->prepare("SELECT count(*) FROM `" . $this->dbprefix . "comments` WHERE `comment_approved` = 1 AND `comment_author_email` = %s AND `comment_date` > STR_TO_DATE(%s, '%Y-%m-%d %H:%i:%s')", $user_email, $date_from);
        } else {
            $sql_new_comments = $this->db->prepare("SELECT count(*) FROM `" . $this->dbprefix . "comments` WHERE `comment_post_ID` = %d AND `comment_approved` = 1", $post_id);
        }
        return $this->db->get_var($sql_new_comments);
    }

    /**
     * get current post all parent comments count
     */
    public function get_post_parent_comments_count($post_id) {
        $sql_new_comments = $this->db->prepare("SELECT count(*) FROM `" . $this->dbprefix . "comments` WHERE `comment_post_ID` = %d AND `comment_approved` = 1 AND `comment_parent` = 0", $post_id);
        return $this->db->get_var($sql_new_comments);
    }

    /**
     * 
     * @param type $post_id the current post id
     * @return type int - the last comment id for this post
     */
    public function get_last_comment_id_by_post_id($post_id) {
        $sql_get_last_comment = $this->db->prepare("SELECT MAX(`comment_id`) FROM `" . $this->dbprefix . "comments` WHERE `comment_approved` = 1 AND `comment_post_ID` = %d;", $post_id);
        $wc_last_comment_id = $this->db->get_var($sql_get_last_comment);
        return (!empty($wc_last_comment_id) && $wc_last_comment_id) ? $wc_last_comment_id : 0;
    }

    /**
     * 
     * @param type $post_id the current post id
     * @param type $wc_last_comment_id - the last comment id for this post
     * @return type array
     */
    public function wc_get_new_comments($post_id, $wc_last_comment_id, $wc_author_email = null) {
        if ($wc_author_email) {
            $sql_get_new_comments = $this->db->prepare("SELECT `comment_id`, `comment_parent` FROM `" . $this->dbprefix . "comments` WHERE `comment_approved` = 1 AND `comment_post_ID` = %d AND `comment_id` > %d AND `comment_author_email` NOT LIKE '%s' ORDER BY `comment_date` DESC", $post_id, $wc_last_comment_id, $wc_author_email);
        } else {
            $sql_get_new_comments = $this->db->prepare("SELECT `comment_id`, `comment_parent` FROM `" . $this->dbprefix . "comments` WHERE `comment_approved` = 1 AND `comment_post_ID` = %d AND `comment_id` > %d ORDER BY `comment_date` DESC", $post_id, $wc_last_comment_id);
        }
        return $this->db->get_results($sql_get_new_comments, ARRAY_A);
    }

    /**
     * get current user comments' new replies
     */
    public function wc_get_user_comments_new_replies($post_id, $wc_last_comment_id, $wc_author_email) {
        $sql_get_new_replies = $this->db->prepare("SELECT * FROM `" . $this->dbprefix . "comments` WHERE `comment_post_id` = %d AND comment_id > %d AND `comment_parent` != 0 AND `comment_parent` IN(SELECT `comment_id` FROM `" . $this->dbprefix . "comments` WHERE `comment_author_email` LIKE '%s') AND `comment_author_email` NOT LIKE '%s';", $post_id, $wc_last_comment_id, $wc_author_email, $wc_author_email);
        return $this->db->get_results($sql_get_new_replies, ARRAY_A);
    }

    public function wc_get_visible_parent_comment_ids($post_id, $limit) {
        $sql_get_visible_ids = $this->db->prepare("SELECT `comment_ID` FROM `" . $this->dbprefix . "comments` WHERE `comment_approved` = 1 AND `comment_parent` = 0 AND `comment_post_ID` = %d ORDER BY `comment_ID` DESC LIMIT %d;", $post_id, $limit);
        return $this->db->get_results($sql_get_visible_ids, ARRAY_N);
    }

    public function wc_add_email_notification($id, $post_id, $email, $is_all) {
        if ($is_all == 1) {
            $subscribtion_type = 'post';
            $this->wc_delete_comment_notifications($id, $email);
        } else if ($is_all == 2) {
            $subscribtion_type = 'all_comment';
            $this->wc_delete_comment_notifications($id, $email);
        } else if ($is_all == 3) {
            $subscribtion_type = 'comment';
        }
        $activation_key = md5($email . uniqid() . time());
        $sql = $this->db->prepare("INSERT INTO `" . $this->email_notification . "` (`email`, `subscribtion_id`, `post_id`, `subscribtion_type`, `activation_key`) VALUES(%s, %d, %d, %s, %s);", $email, $id, $post_id, $subscribtion_type, $activation_key);
        $this->db->query($sql);
    }

    public function wc_get_post_new_comment_notification($post_id, $email) {
        $sql = $this->db->prepare("SELECT  `id`,`email`,`activation_key` FROM `" . $this->email_notification . "` WHERE `subscribtion_type` = 'post' AND `subscribtion_id` = %d  AND `email` != %s;", $post_id, $email);
        return $this->db->get_results($sql, ARRAY_A);
    }

    public function wc_get_post_all_new_comment_notification($post_id, $email) {
        $sql = $this->db->prepare("SELECT `id`,`email`,`activation_key` FROM `" . $this->email_notification . "` WHERE `subscribtion_type` = 'all_comment' AND `subscribtion_id` = %d  AND `email` = %s;", $post_id, $email);
        return $this->db->get_results($sql, ARRAY_A);
    }

    public function wc_get_post_new_reply_notification($comment_id, $email) {
        $sql = $this->db->prepare("SELECT  `id`,`email`,`activation_key` FROM `" . $this->email_notification . "` WHERE `subscribtion_type` = 'comment' AND `subscribtion_id` = %d  AND `email` != %s;", $comment_id, $email);
        return $this->db->get_results($sql, ARRAY_A);
    }

    public function wc_has_post_notification($post_id, $email) {
        $sql = $this->db->prepare("SELECT `id` FROM `" . $this->email_notification . "` WHERE `subscribtion_type` = 'post' AND `subscribtion_id` = %d AND `email` = %s", $post_id, $email);
        $result = $this->db->get_results($sql, ARRAY_N);
        return count($result);
    }

    public function wc_has_all_comments_notification($post_id, $email) {
        $sql = $this->db->prepare("SELECT `id` FROM `" . $this->email_notification . "` WHERE `subscribtion_type` IN('post', 'all_comment') AND `subscribtion_id` = %d AND `email` = %s", $post_id, $email);
        $result = $this->db->get_results($sql, ARRAY_N);
        return count($result);
    }

    public function wc_has_comment_notification($post_id, $comment_id, $email) {
        $sql_comments_notifications = $this->db->prepare("SELECT count(*) FROM `" . $this->email_notification . "` WHERE `email` LIKE %s AND `subscribtion_type` IN('post', 'all_comment') AND `subscribtion_id` = %d", $email, $post_id);
        if ($this->db->get_var($sql_comments_notifications)) {
            return 1;
        }

        $sql = $this->db->prepare("SELECT `id` FROM `" . $this->email_notification . "` WHERE `subscribtion_type` = 'comment' AND `subscribtion_id` = %d AND `email` = %s", $comment_id, $email);
        $result = $this->db->get_results($sql, ARRAY_N);
        return count($result);
    }

    /**
     * delete comment thread subscribtions if new subscribtion type is post
     */
    public function wc_delete_comment_notifications($post_id, $email) {
        $sql_delete_comment_notifications = $this->db->prepare("DELETE FROM `" . $this->email_notification . "` WHERE `subscribtion_type` != 'post' AND `post_id` = %d AND `email` LIKE %s;", $post_id, $email);
        $this->db->query($sql_delete_comment_notifications);
    }

    /**
     * create unsubscribe link 
     */
    public function wc_unsubscribe_link($id, $email, $subscribtion_type) {
        $sql_subscriber_data = $this->db->prepare("SELECT `id`, `post_id`, `activation_key` FROM `" . $this->email_notification . "` WHERE `subscribtion_type` = %s AND `subscribtion_id` = %d  AND `email` LIKE %s", $subscribtion_type, $id, $email);
        $wc_unsubscribe = $this->db->get_row($sql_subscriber_data, ARRAY_A);
        $post_id = $wc_unsubscribe['post_id'];

        $wc_unsubscribe_link = get_permalink($post_id) . "?wpdiscuzSubscribeID=" . $wc_unsubscribe['id'] . "&key=" . $wc_unsubscribe['activation_key'] . '&#wc_unsubscribe_message';
        return $wc_unsubscribe_link;
    }

    /**
     * delete subscribtion
     */
    public function wc_unsubscribe($id, $activation_key) {
        $sql_unsubscribe = $this->db->prepare("DELETE FROM `" . $this->email_notification . "` WHERE `id` = %d AND `activation_key` LIKE %s", $id, $activation_key);
        return $this->db->query($sql_unsubscribe);
    }

}

?>