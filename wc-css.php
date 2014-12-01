<?php

class WC_CSS {

    private $wc_options;

    function __construct($wc_options) {
        $this->wc_options = $wc_options;
    }

    /**
     * init woo discuss styles
     */
    public function init_styles() {
        ?>
        <style type="text/css">
            .wc-comment-header{ padding-top:20px; display:block; float:none; clear:both; font-size:18px;} /*#2892BF*/
            #wpcomm form .item {display: block;} .item input {}
            #wpcomm { margin:15px auto; padding:1px 0px 10px 0px; border-top:#DDDDDD solid 1px; }
            #wpcomm form { margin:0px; padding:0px; background:none; border:none; }
            #wpcomm form div{ margin:0px; }
            #wpcomm .wc-comment-title{ margin:0px; line-height:18px; font-weight:bold; padding:10px; margin-bottom:10px; font-size:13px; text-align:right; border-bottom:#CCCCCC dotted 1px; padding-bottom:10px; }
            #wpcomm .wc-form-wrapper{ padding:10px; background:#F9F9F9; margin-top:20px; border:1px solid #F1F1F1; }
            #wpcomm .wc-author-data{ margin-bottom:10px; }
            #wpcomm .wc-field-submit{ padding:5px 0px 13px 0px; }
            #wpcomm .wc-field-name{ width:49%; float:left; }
            #wpcomm .wc-field-email{ width:49%; float:right; text-align:right; }
            #wpcomm .wc-field-comment{ margin:5px auto 10px auto; }
            #wpcomm .wc-field-captcha{ width:55%; float:left; margin:0px; }
            #wpcomm .wc-field-submit{ width:45%; float:right; text-align:right; margin:0px; }
            #wpcomm .wc-field-name input[type="text"]{ width:95%; max-width:100%; padding:5px; font-size:14px; margin:0px; }
            #wpcomm .wc-field-email input[type="email"]{ width:100%; max-width:100%; padding:5px; font-size:14px; margin:0px; }
            #wpcomm .wc-field-captcha input[type="text"]{ width:40%; padding:5px; font-size:14px; margin:0px; }
            #wpcomm .wc-field-submit input[type="submit"]{ margin:1px; }
            #wpcomm .wc-field-submit input[type="button"]{ margin:1px; }
            #wpcomm .captcha_msg{ color: #aaaaaa; font-family: Lato,sans-serif; font-size: 12px; line-height: 18px; display:block; clear:both; }
            #wpcomm .wc-field-comment textarea{ width:100%; max-width:100%; height:43px; min-height: 43px !important; padding:5px; box-sizing: border-box; }
            #wpcomm .wc-label{ display:block; font-size:14px; padding:5px; }
            #wpcomm .wc-field-captcha .wc-label{ font-size:18px; padding:5px; text-align:center; display:inline; }
            #wpcomm input[type="text"], #wpcomm input[type="email"], #wpcomm textarea{ font-size:14px; color:#666666; font-family:Lato,sans-serif; box-sizing: border-box; margin:0px; }
            #wpcomm .wc-copyright{ margin: 0px 0px 0px auto; text-align:right; display: block; padding-top: 2px; }
            #wpcomm .wc-copyright a{ font-size: 9px; color: #AAAAAA; cursor:help; text-decoration:none; margin:0px; padding:0px; border:none;}
            #wpcomm .wc-thread-wrapper{ padding:10px 0px; margin-bottom:10px;}
            #wpcomm .wc-comment { margin-bottom:13px; }
            #wpcomm .wc-comment .wc-field-submit{ padding:5px 0px 5px 0px; }
            #wpcomm .wc-comment .wc-form-wrapper{ padding:10px 10px 2px 10px; }
            #wpcomm .wc-comment .wc-comment-left{ width:62px; float:left; position:absolute; text-align:center; font-family:Lato,sans-serif; line-height:16px; }
            #wpcomm .wc-comment .wc-comment-right{ margin-left:70px; border:#F5F5F5 1px solid; padding:10px 10px 3px 10px; background:<?php echo $this->wc_options->wc_options_serialized->wc_comment_bg_color; ?>}
            #wpcomm .wc-reply .wc-comment-right{ margin-left:70px; border:#F5F5F5 1px solid; padding:10px 10px 3px 10px; }
            #wpcomm .wc-reply { margin-top: 10px; margin-bottom:0px; margin-left:40px; }
            #wpcomm .wc-reply .wc-comment-right{ background:<?php echo $this->wc_options->wc_options_serialized->wc_reply_bg_color; ?>; }
            #wpcomm .wc-must-login{  margin:0px; font-size:14px; line-height:16px; padding:10px }
            #wpcomm hr{ background-color: rgba(0, 0, 0, 0.1); border: 0 none; height: 1px; margin:10px 0px; }
            #wpcomm .avatar{ border: 1px solid rgba(0, 0, 0, 0.1); padding: 2px; margin:0px; float:none; }
            #wpcomm .wc-comment-text{ font-size:13px; text-align:left; color:<?php echo $this->wc_options->wc_options_serialized->wc_comment_text_color; ?>; padding-bottom:5px; }
            #wpcomm .wc-comment-header{ margin-bottom:7px; font-family:Lato,sans-serif; }
            #wpcomm .wc-comment-author{ color:<?php echo $this->wc_options->wc_options_serialized->wc_author_title_color; ?>; font-size:16px; width:40%; float:left; white-space:nowrap; }
            #wpcomm .wc-comment-label{ background:<?php echo $this->wc_options->wc_options_serialized->wc_author_title_color; ?>; color:#FFFFFF; padding:2px 5px; font-size:12px; margin:4px auto; text-align:center; display:table; line-height:16px; }
            #wpcomm .wc-comment-date{ font-size:12px; color:#999999; width:59%; float:right; text-align:right; white-space:nowrap; line-height:27px; }
            #wpcomm .wc-comment-footer { font-size:12px; font-weight:normal; color:#999999; margin-top:12px; min-height: 28px; font-family:Lato,sans-serif; }
            #wpcomm .wc-comment-footer a{ text-decoration:none; font-size:13px; font-weight:bold; color:<?php echo $this->wc_options->wc_options_serialized->wc_vote_reply_color; ?>; }
            #wpcomm .wc-comment-footer .share_buttons_box img{ vertical-align:middle; }
            #wpcomm .wc-comment-footer .wc-voted{ color:#666666; cursor:default; }
            #wpcomm .wc-comment-footer .wc-vote-result{ padding:2px 6px 2px 5px; background:<?php echo $this->wc_options->wc_options_serialized->wc_vote_reply_color; ?>; color:#FFFFFF; font-size:12px; font-weight:bold; display:inline; margin-right:5px;}
            #wpcomm .wc-toggle{ float:right; text-align:right; padding-right:0px; margin-right:0px; color:#999999; cursor:pointer; font-size:12px; }
            #wpcomm .item { background: none; border-radius: 0px; box-shadow: none; }
            #wc_response_info img{ margin: 0px auto 0px auto; }
            #wpcomm .share_buttons_box img { display:inline!important; width:16px; height:16px; }
            #wpcomm .wc-captcha-label img{ display: inline!important; border:none; padding:0px 1px; margin:0px; }
            #wpcomm .wc-reply-link, #wpcomm .wc-vote-link, #wpcomm .wc-share-link { cursor: pointer; font-size:13px; font-weight:bold; color: <?php echo $this->wc_options->wc_options_serialized->wc_vote_reply_color; ?>; }
            #wpcomm .wc-form-footer, #wpcomm .wc-secondary-forms-wrapper {display: none;}
            #wpcomm .wc-field-captcha .wc-captcha-label { margin-left: 5px; padding: 0; display: inline-block; }
            #wpcomm .wc_captcha_refresh_img {cursor: pointer; margin-left: 3px;}
            #wpcomm .share_buttons_box {display: none;/*position: absolute;left: 40%;*/}
            #wpcomm .wc-no-left-margin {margin-left: 0 !important;}
            div.wc_modal { background: none repeat scroll 0 0 #EDEDED; color:#444444; font-size: 18px; font-weight: normal; padding: 45px 10px 50px 10px!important; text-align: center; line-height:25px;}
            .wc-load-more-submit-wrap {  width: 100%; text-align: center; margin-bottom:20px; }
            .wc-load-more-submit { width: 100%; text-align: center; }
            #wc_openModalFormAction > div#wc_response_info { width: 200px; background: none repeat scroll 0 0 #EDEDED; color:#444444; font-size: 18px; font-weight: normal; padding: 45px 10px 50px 10px!important; text-align: center; line-height:25px;}
            #wc_openModalFormAction > div#wc_response_info { /*z-index: 10000;*/ }
            #wc_openModalFormAction > div#wc_response_info a.close {  background: url("<?php echo plugins_url(WC_Core::$PLUGIN_DIRECTORY . '/files/img/x.png'); ?>") no-repeat;  background-position-x: right; background-position-y: top; }
            #wpcomm .by-wpdiscuz{ text-align:right; border-top:#DDDDDD solid 1px; padding:3px 1px 1px 1px; }
            #wpcomm .by-wpdiscuz a{ font-size:11px; font-weight:bold; text-align:right; color:#CCCCCC; padding:1px; margin:0px; line-height:12px; border:none; text-decoration:none; }

            <?php echo $this->wc_options->wc_options_serialized->wc_custom_css; ?>
        </style>
        <?php
    }

}
?>
