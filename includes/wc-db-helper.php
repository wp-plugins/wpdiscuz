<?php

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

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
        $this->email_notification = $this->dbprefix . 'wc_email_notfication';
    }

    /**
     * create table in db on activation if not exists
     */
    public function create_tables() {
        if ($this->db->get_var("SHOW TABLES LIKE '$this->users_voted'") != $this->users_voted) {
            $sql = "CREATE TABLE `" . $this->users_voted . "`(`id` INT(11) NOT NULL AUTO_INCREMENT,`user_id` INT(11) NOT NULL, `comment_id` INT(11) NOT NULL, `vote_type` INT(11) DEFAULT NULL, PRIMARY KEY (`id`), KEY `user_id` (`user_id`), KEY `comment_id` (`comment_id`),  KEY `vote_type` (`vote_type`)) ENGINE=MyISAM DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci AUTO_INCREMENT=1;";
            dbDelta($sql);
        }
        if ($this->db->get_var("SHOW TABLES LIKE '$this->phrases'") != $this->phrases) {
            $sql = "CREATE TABLE `" . $this->phrases . "`(`id` INT(11) NOT NULL AUTO_INCREMENT, `phrase_key` VARCHAR(255) NOT NULL, `phrase_value` VARCHAR(255) NOT NULL, PRIMARY KEY (`id`), KEY `phrase_key` (`phrase_key`)) ENGINE=MyISAM DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci AUTO_INCREMENT=1;";
            dbDelta($sql);
        }
        if ($this->db->get_var("SHOW TABLES LIKE '$this->email_notification'") != $this->email_notification) {
            $sql = "CREATE TABLE `" . $this->email_notification . "`(`id` INT(11) NOT NULL AUTO_INCREMENT,`email` VARCHAR(255) NOT NULL,`post_id` INT(11) DEFAULT 0,`comment_id` INT(11) DEFAULT 0, PRIMARY KEY (`id`), KEY `post_id` (`post_id`), KEY `comment_id` (`comment_id`))ENGINE=MYISAM DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci AUTO_INCREMENT=1;";
            dbDelta($sql);
        }
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

    public function wc_create_email_notification_tabel() {
        if ($this->db->get_var("SHOW TABLES LIKE '$this->email_notification'") != $this->email_notification) {
            $sql = "CREATE TABLE `" . $this->email_notification . "`(`id` INT(11) NOT NULL AUTO_INCREMENT,`email` VARCHAR(255) NOT NULL,`post_id` INT(11) DEFAULT 0,`comment_id` INT(11) DEFAULT 0, PRIMARY KEY (`id`), KEY `post_id` (`post_id`), KEY `comment_id` (`comment_id`))ENGINE=MYISAM DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci AUTO_INCREMENT=1;";
            dbDelta($sql);
        }
    }

    public function wc_add_email_notification($id, $email, $is_comment) {
        if ($is_comment) {
            $sql = $this->db->prepare("INSERT INTO `" . $this->email_notification . "`(`post_id`,`email`)VALUES(%d,%s);", $id, $email);
        } else {
            $sql = $this->db->prepare("INSERT INTO `" . $this->email_notification . "`(`comment_id`,`email`)VALUES(%d,%s);", $id, $email);
        }
        $this->db->query($sql);
    }

    public function wc_get_post_new_comment_notification($post_id, $email) {
        $sql = $this->db->prepare("SELECT `email` FROM `" . $this->email_notification . "` WHERE `post_id` = %d  AND `email` != %s GROUP BY `email`", $post_id, $email);
        return $this->db->get_results($sql, ARRAY_N);
    }

    public function wc_get_post_new_reply_notification($comment_id, $email) {
        $sql = $this->db->prepare("SELECT `email` FROM `" . $this->email_notification . "` WHERE `comment_id` = %d AND `email` != %s GROUP BY `email`", $comment_id, $email);
        return $this->db->get_results($sql, ARRAY_N);
    }

    public function wc_has_notification_in_comment($post_id, $email) {
        $sql = $this->db->prepare("SELECT `id` FROM `" . $this->email_notification . "` WHERE `post_id` = %d AND `email` = %s", $post_id, $email);       
        $result = $this->db->get_results($sql, ARRAY_N);
        return count($result);
    }

    public function wc_has_notification_in_reply($comment_id, $email) {
        $sql = $this->db->prepare("SELECT `id` FROM `" . $this->email_notification . "` WHERE `comment_id` = %d AND `email` = %s", $comment_id, $email);
        $result = $this->db->get_results($sql, ARRAY_N);
        return count($result);
    }

}

?>