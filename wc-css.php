<?php

class WC_CSS {

    private $wc_options_serialized;

    function __construct($wc_options_serialized) {
        $this->wc_options_serialized = $wc_options_serialized;
    }

    /**
     * init woo discuss styles
     */
    public function init_styles() {
        if (is_singular()) {
            ?>
            <style type="text/css"> .wc_new_comment{ background:<?php echo $this->wc_options_serialized->wc_author_title_color; ?>;} #wpcomm .wc_new_comment_and_replies .wc_new_reply{background:<?php echo $this->wc_options_serialized->wc_author_title_color; ?>;}#wpcomm .wc-form-wrapper{background:<?php echo isset($this->wc_options_serialized->wc_form_bg_color) ? $this->wc_options_serialized->wc_form_bg_color : '#f9f9f9'; ?>;} #wpcomm .wc_manage_subscribtions {color: <?php echo $this->wc_options_serialized->wc_author_title_color; ?>; }#wpcomm textarea, #wpcomm input[type="text"], #wpcomm input[type="email"], #wpcomm input[type="password"], #wpcomm input[type="url"]{ border:<?php echo $this->wc_options_serialized->wc_input_border_color; ?> 1px solid;}#wpcomm .wc-comment .wc-comment-right{ background:<?php echo $this->wc_options_serialized->wc_comment_bg_color; ?>;} #wpcomm .wc-reply .wc-comment-right{ background:<?php echo $this->wc_options_serialized->wc_reply_bg_color; ?>; }#wpcomm .wc-comment-text{ font-size:<?php echo isset($this->wc_options_serialized->wc_comment_text_size) ? $this->wc_options_serialized->wc_comment_text_size : '14px'; ?>;color:<?php echo $this->wc_options_serialized->wc_comment_text_color; ?>;} #wpcomm .wc-comment-author{ color:<?php echo $this->wc_options_serialized->wc_author_title_color; ?>; }#wpcomm .wc-comment-author a{ color:<?php echo $this->wc_options_serialized->wc_author_title_color; ?>;} #wpcomm .wc-comment-label{ background:<?php echo $this->wc_options_serialized->wc_author_title_color; ?>; }  #wpcomm .wc-comment-footer a, #wpcomm .wc-comment-footer span.wc_editable_comment,  #wpcomm .wc-comment-footer span.wc_save_edited_comment, #wpcomm span.wc_cancel_edit { color:<?php echo $this->wc_options_serialized->wc_vote_reply_color; ?>; }  #wpcomm .wc-comment-footer .wc-vote-result{ background:<?php echo $this->wc_options_serialized->wc_vote_reply_color; ?>;} #wpcomm .wc-reply-link, #wpcomm .wc-vote-link, #wpcomm .wc-share-link {color: <?php echo $this->wc_options_serialized->wc_vote_reply_color; ?>; }.wc-load-more-submit {border: 1px solid <?php echo $this->wc_options_serialized->wc_input_border_color; ?>;} #wc_openModalFormAction > div#wc_response_info a.close {  background: url("<?php echo plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/x.png'); ?>") no-repeat;}#wpcomm .wc-comment.wc-comment-right.wc_new_loaded_comment {background: <?php echo $this->wc_options_serialized->wc_new_loaded_comment_bg_color; ?>;} <?php echo stripslashes($this->wc_options_serialized->wc_custom_css); ?> </style>
            <?php
        }
    }

}
?>