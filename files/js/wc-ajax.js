jQuery(document).ready(function ($) {
    var wc_home_url = $('#wc_home_url').val();
    var wc_plugin_dir_url = $('#wc_plugin_dir_url').val();
    var wc_name;
    var wc_email;
    var wc_comment;
    var wc_captcha;
    var wc_comment_post_ID;
    var wc_comment_parent;
    var wc_form;
    var wc_submitID;
    var wc_comments_offset;
    var wc_new_comment_id;
    var wc_loading_image;

    $(".wc_comment").autoGrow();

    $(document).delegate('#wc_openModalFormAction .close', 'click', function () {
        $('#wc_openModalFormAction').css('opacity', '0');
        $('#wc_openModalFormAction').css('pointer-events', 'none');
    });

    wc_loading_image = "<img width='64' height='64' src='" + wc_home_url + '/' + wc_plugin_dir_url + "/files/img/loader/ajax-loader-200x200.gif' />";
    wc_comments_offset = $('#wc_comments_offset');
    wc_comments_offset.val('1');

    $(document).delegate('.wc_comment', 'focus', function () {
        var uniqueID = getUniqueID($(this));
        $('#wc-form-footer-' + uniqueID).slideDown(700);
    });


    $(document).delegate('.wc-reply-link', 'click', function () {
        var uniqueID = getUniqueID($(this));
        $('#wc-secondary-forms-wrapper-' + uniqueID).slideToggle(700);
    });

    $(document).delegate('.wc-share-link', 'click', function () {
        var uniqueID = getUniqueID($(this));
        $('#share_buttons_box-' + uniqueID).slideToggle(1000);
    });

    $(document).delegate('.wc_captcha_refresh_img', 'click', function () {
        var uniqueID = getUniqueID($(this));
        var wc_commpost_ID = $('#wc_comment_post_ID-' + uniqueID).val();
        var wc_commparent = $('#wc_comment_parent-' + uniqueID).val();
        $("#wc_captcha_img-" + uniqueID).attr("src", wc_home_url + "/" + wc_plugin_dir_url + "/captcha/captcha.php?comm_id=" + wc_commpost_ID + '-' + wc_commparent + '&r=' + Math.random());
    });

    $(document).delegate('.wc_comm_submit', 'click', function () {
        wc_submitID = $(this).attr('id');
        var uniqueID = wc_submitID.substring(wc_submitID.lastIndexOf('-') + 1);
        wc_name = $('#wc_name-' + uniqueID).val();
        wc_email = $('#wc_email-' + uniqueID).val();
        wc_comment = $('textarea#wc_comment-' + uniqueID).val();
        wc_captcha = $('#wc_captcha-' + uniqueID).val();
        wc_comment_post_ID = $('#wc_comment_post_ID-' + uniqueID).val();
        wc_comment_parent = $('#wc_comment_parent-' + uniqueID).val();
        wc_form = $('#wc_comm_form-' + uniqueID);

        var submit = true;
        // evaluate the form using generic validaing
        if (!validator.checkAll(wc_form)) {
            submit = false;
        } else {
            $('#wc_openModalFormAction .close').css('display', 'none');
            $('#wc_openModalFormAction').css('opacity', '1');
            $('#wc_openModalFormAction').css('pointer-events', 'auto');
            $('#wc_openModalFormAction > #wc_response_info').html(wc_loading_image);
        }

        if (submit) {
            $.ajax({
                type: 'POST',
                url: wc_ajax_obj.url,
                data: {
                    name: wc_name,
                    email: wc_email,
                    comment: wc_comment,
                    captcha: wc_captcha,
                    comment_post_ID: wc_comment_post_ID,
                    comment_parent: wc_comment_parent,
                    action: 'wc_comms_via_ajax'
                }
            }).done(function (response) {
                $("#wc_captcha_img-" + uniqueID).attr("src", wc_home_url + "/" + wc_plugin_dir_url + "/captcha/captcha.php?comm_id=" + wc_comment_post_ID + '-' + wc_comment_parent + '&r=' + Math.random());
                var obj = $.parseJSON(response);
                wc_new_comment_id = parseInt(obj.wc_new_comment_id);
                if (obj.code === -1) {
                    var html = "<a href='#close' title='Close' class='close'>&nbsp;</a>";
                    $('#wc_openModalFormAction').css('opacity', '1');
                    $('#wc_openModalFormAction').css('pointer-events', 'auto');
                    $('#wc_openModalFormAction .close').css('display', 'block');
                    $('#wc_openModalFormAction > #wc_response_info').html(html + obj.message);
                } else if (obj.code === -2) {
                    var html = "<a href='#close' title='Close' class='close'>&nbsp;</a>";
                    $('#wc_openModalFormAction').css('opacity', '1');
                    $('#wc_openModalFormAction').css('pointer-events', 'auto');
                    $('#wc_openModalFormAction .close').css('display', 'block');
                    $('#wc_openModalFormAction > #wc_response_info').html(html + obj.message);
                    $('#wc_comment-' + uniqueID).val('');
                    $('.wc_comm_form textarea').css('height', '46px');

                    if (wc_submitID === 'wc_comm-' + wc_comment_post_ID + '_0') {
                        $('#wc-form-footer-' + uniqueID).slideToggle(700);
                    } else {
                        $('#wc-secondary-forms-wrapper-' + uniqueID).slideToggle(700);
                    }
                    if (wc_new_comment_id !== -1) {
                        emailNotification(wc_comment_parent, wc_new_comment_id);
                    }
                    $.cookie('wc_author_name', wc_name);
                    $.cookie('wc_author_email', wc_email);
                } else {
                    $('#wc_comment-' + uniqueID).val('');
                    $('.wc_comm_form textarea').css('height', '46px');

                    if (wc_submitID === 'wc_comm-' + wc_comment_post_ID + '_0') {
                        $('.wc-thread-wrapper').prepend(obj.message);
                        $('#wc-form-footer-' + uniqueID).slideToggle(700);
                    } else {
                        $('#wc-secondary-forms-wrapper-' + uniqueID).slideToggle(700);

                        if ($('#wc-comm-' + uniqueID).hasClass('wc-reply')) {
                            $('#wc-secondary-forms-wrapper-' + uniqueID).after(obj.message.replace('wc-reply', 'wc-reply wc-no-left-margin'));
                        } else {
                            $('#wc-secondary-forms-wrapper-' + uniqueID).after(obj.message);
                        }
                    }
                    $('#wc_openModalFormAction').css('opacity', '0');
                    $('#wc_openModalFormAction').css('pointer-events', 'none');
                    if (wc_name !== '' && wc_email !== '') {
                        $.cookie('wc_author_name', wc_name);
                        $.cookie('wc_author_email', wc_email);
                        $('#wpcomm .wc_name').val(wc_name);
                        $('#wpcomm .wc_email').val(wc_email);
                    }
                    if (wc_new_comment_id !== -1) {
                        emailNotification(wc_comment_parent, wc_new_comment_id);
                    }
                }
                $('#wc_captcha-' + uniqueID).val('');
                $('.wc_tooltipster').tooltipster({offsetY: 2});
                $('.wc_comm_form input').css('box-shadow', '0 0 4px -2px #d4d0ba');
                $('.wc_comm_form textarea').css('box-shadow', '0 0 4px -2px #d4d0ba');
            });
        }
        else {
            return false;
        }
    });



    $(document).delegate('.wc_vote', 'click', function () {
        var uniqueID = getUniqueID($(this));
        var commentID = getCommentID(uniqueID);
        var voteType;

        $('#wc_openModalFormAction > #wc_response_info').html(wc_loading_image);
        $('#wc_openModalFormAction .close').css('display', 'block');
        $('#wc_openModalFormAction').css('opacity', '1');
        $('#wc_openModalFormAction').css('pointer-events', 'auto');
        if ($(this).hasClass('wc-up')) {
            voteType = 1;
        } else {
            voteType = -1;
        }

        $.ajax({
            dateType: 'json',
            type: 'POST',
            url: wc_ajax_obj.url,
            data: {
                comment_ID: commentID,
                vote_type: voteType,
                action: 'wc_vote_via_ajax'
            }
        }).done(function (response) {
            var obj = $.parseJSON(response);

            if (obj.code !== -1) {
                $('#vote-count-' + uniqueID).text(parseInt($('#vote-count-' + uniqueID).text()) + voteType);
                $('#wc_openModalFormAction').css('opacity', '0');
                $('#wc_openModalFormAction').css('pointer-events', 'none');
            } else {
                var html = "<a href='#close' title='Close' class='close'>&nbsp;</a>";
                $('#wc_response_info').html(html + obj.message);
                $('#wc_openModalFormAction .close').css('display', 'block');
            }
        });
    });

    $(document).delegate('.wc-load-more-submit', 'click', function () {        
        $('#wc_openModalFormAction > #wc_response_info').html(wc_loading_image);
        $('#wc_openModalFormAction .close').css('display', 'none');
        $('#wc_openModalFormAction').css('opacity', '1');
        $('#wc_openModalFormAction').css('pointer-events', 'auto');

        var wc_comments_offset_value = wc_comments_offset.val();
        var wc_post_id = getPostID($(this).attr('id'));
        var wc_parent_comments_count = parseInt($('#wc_parent_comments_count').val());
        var wc_parent_per_page = parseInt($('#wc_parent_per_page').val());

        wc_comments_offset_value = parseInt(wc_comments_offset_value);
        wc_comments_offset_value++;

        $.ajax({
            type: 'POST',
            url: wc_ajax_obj.url,
            data: {
                comments_offset: wc_comments_offset_value,
                wc_post_id: wc_post_id,
                action: 'wc_load_more_comments'
            }
        }).done(function (response) {
            wc_comments_offset.val(wc_comments_offset_value);
            if (wc_parent_comments_count <= (wc_comments_offset_value * wc_parent_per_page)) {
                $('.wc-load-more-submit-wrap').remove();
            }
            $('.wc-thread-wrapper').html(response);
            $('#wc_openModalFormAction').css('opacity', '0');
            $('#wc_openModalFormAction').css('pointer-events', 'none');
            $('.wc_tooltipster').tooltipster({offsetY: 2});
        });
    });

    function getUniqueID(field) {
        var fieldID = field.attr('id');
        var uniqueID = fieldID.substring(fieldID.lastIndexOf('-') + 1);
        return uniqueID;
    }

    function getPostID(uniqueID) {
        var postID = uniqueID.substring(uniqueID.lastIndexOf('-') + 1);
        postID = postID.substring(0, postID.lastIndexOf('_'));
        return postID;
    }

    function getCommentID(uniqueID) {
        var commentID = uniqueID.substring(uniqueID.indexOf('_') + 1);
        return commentID;
    }

    function emailNotification(wc_comment_parent, wc_new_comment_id) {
        $.ajax({
            type: 'POST',
            url: wc_ajax_obj.url,
            data: {
                wc_comment_parent: wc_comment_parent,
                wc_new_comment_id: wc_new_comment_id,
                action: 'email_notification'
            }
        });
    }

    $('.wc_tooltipster').tooltipster({offsetY: 2});
});