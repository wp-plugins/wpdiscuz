<?php

class WC_Comment {

    public $comment_ID;
    public $comment_post_ID;
    public $comment_author;
    public $comment_author_email;
    public $comment_author_url;
    public $comment_author_IP;
    public $comment_date;
    public $comment_date_gmt;
    public $comment_content;
    public $comment_karma;
    public $comment_approved;
    public $comment_agent;
    public $comment_type;
    public $comment_parent;
    public $user_id;
    public $votes;

    public function __construct($comment) {
        $this->comment_ID = $comment->comment_ID;
        $this->comment_post_ID = $comment->comment_post_ID;
        $this->comment_author = $comment->comment_author;
        $this->comment_author_email = $comment->comment_author_email;
        $this->comment_author_url = $comment->comment_author_url;
        $this->comment_author_IP = $comment->comment_author_IP;
        $this->comment_date = $comment->comment_date;
        $this->comment_date_gmt = $comment->comment_date_gmt;
        $this->comment_content = $comment->comment_content;
        $this->comment_karma = $comment->comment_karma;
        $this->comment_approved = $comment->comment_approved;
        $this->comment_agent = $comment->comment_agent;
        $this->comment_type = $comment->comment_type;
        $this->comment_parent = $comment->comment_parent;
        $this->user_id = $comment->user_id;
        $this->votes = $this->get_vote_count($comment->comment_ID);
    }

    public function get_vote_count($comment_id) {
        return get_comment_meta($comment_id, 'wpdiscuz_votes', true);
    }

    public function get_votes() {
        return $this->votes;
    }

    public function set_votes($votes) {
        $this->votes = $votes;
    }

}

?>