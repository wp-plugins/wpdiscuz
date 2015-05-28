jQuery(document).ready(function ($) {
    var wc_home_url = $('#wc_home_url').val();
    var wc_plugin_dir_url = $('#wc_plugin_dir_url').val();
    var wc_name;
    var wc_email;
    var wc_comment;
    var wc_website;
    var wc_captcha;
    var wc_comment_post_ID;
    var wc_comment_parent;
    var wc_form;
    var wc_submitID;
    var wc_comments_offset;
    var wc_new_comment_id;
    var wc_loading_image;
    var wc_comment_list_update_type = parseInt($('#wc_comment_list_update_type').val());
    var wc_comment_list_update_timer = parseInt($('#wc_comment_list_update_timer').val());
    var wc_all_comments_count_new;
    var wc_comment_text_before_editting;

    $(".wc_comment").autoGrow();

    $(document).delegate('#wc_openModalFormAction', 'click', function () {
        $('#wc_openModalFormAction').css('opacity', '0');
        $('#wc_openModalFormAction').css('pointer-events', 'none');
    });

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
        if ($('.wc_social_plugin_wrapper .wp-social-login-provider-list').length && !($('#wc-secondary-forms-social-content-' + uniqueID + ' .wp-social-login-provider-list').length)) {
            $('.wc_social_plugin_wrapper .wp-social-login-provider-list').clone().prependTo('#wc-secondary-forms-social-content-' + uniqueID);
        } else if ($('.wc_social_plugin_wrapper .the_champ_login_container').length && !($('#wc-secondary-forms-social-content-' + uniqueID + ' .the_champ_login_container').length)) {
            $('.wc_social_plugin_wrapper .the_champ_login_container').clone().prependTo('#wc-secondary-forms-social-content-' + uniqueID);
        } else if ($('.wc_social_plugin_wrapper .social_connect_form').length && !($('#wc-secondary-forms-social-content-' + uniqueID + ' .social_connect_form').length)) {
            $('.wc_social_plugin_wrapper .social_connect_form').clone().prependTo('#wc-secondary-forms-social-content-' + uniqueID);
        }

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
        wc_website = ($('#wc_website-' + uniqueID).length) ? $('#wc_website-' + uniqueID).val() : '';
        wc_comment = $('textarea#wc_comment-' + uniqueID).val();
        wc_captcha = $('#wc_captcha-' + uniqueID).val();
        wc_comment_post_ID = $('#wc_comment_post_ID-' + uniqueID).val();
        wc_comment_parent = $('#wc_comment_parent-' + uniqueID).val();
        wc_form = $('#wc_comm_form-' + uniqueID);
        var notification_type_radio = $("input[name='wc_comment_reply_notification-" + uniqueID + "']:checked").length ? $("input[name='wc_comment_reply_notification-" + uniqueID + "']:checked").val() : '';

        var depth = '';
        if (isMainFormSubmit(wc_submitID, wc_comment_post_ID)) {
            depth = 1;
        } else {
            depth = getCommentDepth($(this).parents('.wc-comment'));
        }


        var notification_type = '';
        if (notification_type_radio.length && notification_type_radio != 'wc_notification_none') {
            if (notification_type_radio == 'wc_notification_new_reply') {
                notification_type = 'reply';
            }
            if (notification_type_radio == 'wc_notification_all_new_reply') {
                notification_type = 'all_comment';
            }
            if (notification_type_radio == 'wc_notification_new_comment') {
                notification_type = 'post';
            }

        }

        var submit = true;
        // evaluate the form using generic validaing
        if (!wpdiscuzValidator.checkAll(wc_form)) {
            submit = false;
            // testic heto bacel commentnery
            $('#wc_captcha-' + uniqueID).val('');
            $("#wc_captcha_img-" + uniqueID).attr("src", wc_home_url + "/" + wc_plugin_dir_url + "/captcha/captcha.php?comm_id=" + wc_comment_post_ID + '-' + wc_comment_parent + '&r=' + Math.random());
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
                    website: wc_website,
                    comment: wc_comment,
                    captcha: wc_captcha,
                    comment_post_ID: wc_comment_post_ID,
                    comment_parent: wc_comment_parent,
                    comment_depth: depth,
                    notification_type: notification_type,
                    action: 'wc_comms_via_ajax'
                }
            }).done(function (response) {

                $("#wc_captcha_img-" + uniqueID).attr("src", wc_home_url + "/" + wc_plugin_dir_url + "/captcha/captcha.php?comm_id=" + wc_comment_post_ID + '-' + wc_comment_parent + '&r=' + Math.random());
                try {

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

                        $.cookie('wc_author_name', wc_name);
                        $.cookie('wc_author_email', wc_email);
                        $.cookie('wc_author_website', wc_website);
                    } else {
                        wc_all_comments_count_new = obj.wc_all_comments_count_new;
                        $('#wc_comment-' + uniqueID).val('');
                        $('.wc_comm_form textarea').css('height', '46px');

                        if (wc_submitID === 'wc_comm-' + wc_comment_post_ID + '_0') {
                            $('.wc-thread-wrapper').prepend(obj.message);
                            $('#wc-form-footer-' + uniqueID).slideToggle(700);
                            $('#wc_curr_user_comment_count').val(parseInt($('#wc_curr_user_comment_count').val()) + 1);
                        } else {
                            $('#wc-secondary-forms-wrapper-' + uniqueID).slideToggle(700);

                            if (obj.is_in_same_container == 1) {
                                $('#wc-secondary-forms-wrapper-' + uniqueID).after(obj.message);
                            } else {
                                $('#wc-secondary-forms-wrapper-' + uniqueID).after(obj.message.replace('wc-reply', 'wc-reply wc-no-left-margin'));
                            }
                        }
                        $('#wc_openModalFormAction').css('opacity', '0');
                        $('#wc_openModalFormAction').css('pointer-events', 'none');
                        $.cookie('wc_author_name', wc_name);
                        $.cookie('wc_author_email', wc_email);
                        $.cookie('wc_author_website', wc_website);
                        $('#wpcomm .wc_name').val(wc_name);
                        $('#wpcomm .wc_email').val(wc_email);
                        $('#wpcomm .wc_website').val(wc_website);
                        if ($('.wc_header_text_count').length) {
                            $('.wc_header_text_count').val(parseInt($('.wc_header_text_count').val()) + 1);
                        }
                        $.cookie('wc_all_comments_count_new', wc_all_comments_count_new);

                    }
                    $('#wc_captcha-' + uniqueID).val('');
                    $('.wc_tooltipster').tooltipster({offsetY: 2});
                    $('.wc_comm_form input').css('box-shadow', '0 0 4px -2px #d4d0ba');
                    $('.wc_comm_form textarea').css('box-shadow', '0 0 4px -2px #d4d0ba');

                    notify_on_new_comment(wc_comment_post_ID, wc_new_comment_id, wc_email, notification_type);

                    // call redirection if comment added successfully
                    if (obj.code == 1 || obj.code == -2) {
                        $.ajax({
                            type: 'POST',
                            url: wc_ajax_obj.url,
                            data: {
                                wc_new_comment_id: wc_new_comment_id,
                                action: 'wpdiscuz_comment_redirect'
                            }
                        }).done(function (redirectResponse) {
                            try {
                                var redirectObj = $.parseJSON(redirectResponse);
                                if (redirectObj.code == 1) {
                                    setTimeout(function () {
                                        window.location.href = redirectObj.redirect_to;
                                    }, 5000)
                                }
                            } catch (e) {

                            }
                        });
                    }

                } catch (e) {
                    $('#wc_captcha-' + uniqueID).val('');
                    $('.wc_tooltipster').tooltipster({offsetY: 2});
                    $('.wc_comm_form input').css('box-shadow', '0 0 4px -2px #d4d0ba');
                    $('.wc_comm_form textarea').css('box-shadow', '0 0 4px -2px #d4d0ba');
                    var html = "<a href='#close' title='Close' class='close'>&nbsp;</a>";
                    $('#wc_openModalFormAction').css('opacity', '1');
                    $('#wc_openModalFormAction').css('pointer-events', 'auto');
                    $('#wc_openModalFormAction .close').css('display', 'block');
                    if (response.contains('<') && response.contains('>')) {
                        $('#wc_openModalFormAction > #wc_response_info').html(html + e);
                    } else {
                        $('#wc_openModalFormAction > #wc_response_info').html(html + response);
                    }
                }
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

    // MUST BE CHANGED IN NEXT VERSION OF PLUGIN
    $(document).delegate('.wc-load-more-submit', 'click', function () {

        $('#wc_openModalFormAction > #wc_response_info').html(wc_loading_image);
        $('#wc_openModalFormAction .close').css('display', 'none');
        $('#wc_openModalFormAction').css('opacity', '1');
        $('#wc_openModalFormAction').css('pointer-events', 'auto');

        var wc_comments_offset_value = wc_comments_offset.val();
        var wc_post_id = getPostID($(this).attr('id'));
        var wc_parent_comments_count = parseInt($('#wc_parent_comments_count').val());
        var wc_parent_per_page = parseInt($('#wc_parent_per_page').val());
        var wc_last_comment_id = ($('#wc_last_comment_id_before_update').val()) ? $('#wc_last_comment_id_before_update').val() : 0;
        var wc_curr_user_comment_count = $('#wc_curr_user_comment_count').val();

        wc_comments_offset_value = parseInt(wc_comments_offset_value);
        wc_comments_offset_value++;

        $.ajax({
            type: 'POST',
            url: wc_ajax_obj.url,
            data: {
                comments_offset: wc_comments_offset_value,
                wc_curr_user_comment_count: wc_curr_user_comment_count,
                wc_post_id: wc_post_id,
                wc_last_comment_id: wc_last_comment_id,
                action: 'wc_load_more_comments'
            }
        }).done(function (response) {
            var obj = $.parseJSON(response);
            wc_comments_offset.val(wc_comments_offset_value);
            if (wc_parent_comments_count <= (wc_comments_offset_value * wc_parent_per_page)) {
                $('.wc-load-more-submit-wrap').remove();
            }
            $('.wc-thread-wrapper').html(obj.message);
            $('#wc_last_comment_id').val(obj.wc_last_comment_id);
            $('#hidden_new_comment_count').val(obj.hidden_new_comment_count);
            $('#wc_openModalFormAction').css('opacity', '0');
            $('#wc_openModalFormAction').css('pointer-events', 'none');
            $('.wc_tooltipster').tooltipster({offsetY: 2});
            setInputsDataFromCookie();
        });
    });

    // MUST BE CHANGED IN NEXT VERSION OF PLUGIN
    $(document).delegate('.wc_new_comment', 'click', function () {
        wc_submitID = $('.wc_main_comm_form input.wc_comm_submit').attr('id');
        var uniqueID = wc_submitID.substring(wc_submitID.lastIndexOf('-') + 1);
        wc_comment_post_ID = getPostID(uniqueID);
        var wc_last_new_comment_id = $('#wc_last_new_comment_id').val();
        wc_email = $.cookie('wc_author_email');
        var wc_curr_user_comment_count = $('#wc_curr_user_comment_count').val();
        var wc_comments_offset_value = wc_comments_offset.val();

        var wc_visible_comments_ids = '';
        $('.wc-thread-wrapper .wc-comment').each(function () {
            var comment_id = $(this).attr('id');
            var commentUniqueID = comment_id.substring(comment_id.lastIndexOf('-') + 1);
            wc_visible_comments_ids += getCommentID(commentUniqueID) + ',';
        });

        $.ajax({
            type: 'POST',
            url: wc_ajax_obj.url,
            data: {
                wc_requested_comments_type: 1,
                wc_last_comment_id: wc_last_new_comment_id,
                wc_post_id: wc_comment_post_ID,
                wc_author_email: wc_email,
                wc_comments_offset: wc_comments_offset_value,
                wc_curr_user_comment_count: wc_curr_user_comment_count,
                wc_visible_comments_ids: wc_visible_comments_ids,
                action: 'wc_list_new_comments'
            }
        }).done(function (response) {
            try {
                var obj = $.parseJSON(response);
                if (obj.code != 0) {
                    $('.wc-thread-wrapper').html(obj.message);
                    $('#wc_last_new_comment_id').val(obj.wc_last_comment_id);
                    $('.wc_new_comment').hide();
                    $(document).delegate('.wc_new_loaded_comment', 'mouseenter', function () {
                        if ($(this).parent('.wc-comment').hasClass('wc-reply')) {
                            $(this, '.wc-comment-right').animate({
                                backgroundColor: "#f8f8f8"
                            }, 1500);
                        } else {
                            $(this, '.wc-comment-right').animate({
                                backgroundColor: "#fefefe"
                            }, 1500);
                        }

                        $(this, '.wc-comment-right').removeClass('wc_new_loaded_comment');
                    });
                }
            } catch (e) {
                console.log(e);
            }
        });
    });

    // MUST BE CHANGED IN NEXT VERSION OF PLUGIN
    $(document).delegate('.wc_new_reply', 'click', function () {
        wc_submitID = $('.wc_main_comm_form input.wc_comm_submit').attr('id');
        var uniqueID = wc_submitID.substring(wc_submitID.lastIndexOf('-') + 1);
        wc_comment_post_ID = getPostID(uniqueID);
        var wc_last_new_reply_id = $('#wc_last_new_reply_id').val();
        wc_email = $.cookie('wc_author_email');
        var wc_curr_user_comment_count = $('#wc_curr_user_comment_count').val();
        var wc_comments_offset_value = wc_comments_offset.val();

        var wc_visible_comments_ids = '';
        $('.wc-thread-wrapper .wc-comment').each(function () {
            var comment_id = $(this).attr('id');
            var commentUniqueID = comment_id.substring(comment_id.lastIndexOf('-') + 1);
            wc_visible_comments_ids += getCommentID(commentUniqueID) + ',';
        });

        $.ajax({
            type: 'POST',
            url: wc_ajax_obj.url,
            data: {
                wc_requested_comments_type: 2,
                wc_last_comment_id: wc_last_new_reply_id,
                wc_comments_offset: wc_comments_offset_value,
                wc_curr_user_comment_count: wc_curr_user_comment_count,
                wc_post_id: wc_comment_post_ID,
                wc_author_email: wc_email,
                wc_visible_comments_ids: wc_visible_comments_ids,
                action: 'wc_list_new_comments'
            }
        }).done(function (response) {
            try {
                var obj = $.parseJSON(response);
                if (obj.code != 0) {
                    $('.wc-thread-wrapper').html(obj.message);
                    $('#wc_last_new_reply_id').val(obj.wc_last_comment_id);
                    $('.wc_new_reply').hide();
                }
            } catch (e) {
                console.log(e);
            }
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

    function getCommentDepth(field) {
        var fieldClasses = field.attr('class');
        var classesArray = fieldClasses.split(' ');
        var depth = '';
        $.each(classesArray, function (index, value) {
            ;
            if ('wc_comment_level' === getParentDepth(value, false)) {
                depth = getParentDepth(value, true);
            }
        });
        return parseInt(depth) + 1;
    }

    function getParentDepth(depthValue, isNumberPart) {
        var depth = '';
        if (isNumberPart) {
            depth = depthValue.substring(depthValue.indexOf('-') + 1);
        } else {
            depth = depthValue.substring(0, depthValue.indexOf('-'));
        }
        return depth;
    }

    function isMainFormSubmit(wc_submitID, wc_comment_post_ID) {
        return wc_submitID === 'wc_comm-' + wc_comment_post_ID + '_0';
    }

    /**
     * live update
     */
    // MUST BE CHANGED IN NEXT VERSION OF PLUGIN
    function liveUpdate() {
        var isNewComment = $.cookie('wc_all_comments_count_new') ? false : true;
        if (wc_comment_list_update_type == 1) {
            if (!isFieldsActive(isNewComment)) {
                updateAutomatically();
            }
        } else if (wc_comment_list_update_type == 2) {
            if (!isFieldsActive(isNewComment)) {
                updateIfNewComments();
            }
        }
    }

    /**
     * update automatically
     */
    // MUST BE CHANGED IN NEXT VERSION OF PLUGIN
    function updateAutomatically() {
//        wc_submitID = $('.wc_main_comm_form input.wc_comm_submit').attr('id');
//        var uniqueID = wc_submitID.substring(wc_submitID.lastIndexOf('-') + 1);
        wc_comment_post_ID = $('#wpdiscuz_current_post_id').val();
        var wc_last_comment_id = $('#wc_last_comment_id_before_update').val();
        var wc_last_new_comment_id = $('#wc_last_new_comment_id').val();
        var wc_last_new_reply_id = $('#wc_last_new_reply_id').val();
        var comment_offset = $('#wc_comments_offset').length ? $('#wc_comments_offset').val() : 1;
        var wc_all_comments_count_old = $.cookie('wc_all_comments_count_old');
        var wc_curr_user_comment_count = $('#wc_curr_user_comment_count').val();
        var wc_author_email = $.cookie('wc_author_email');
        $.ajax({
            type: 'POST',
            url: wc_ajax_obj.url,
            data: {
                wc_author_email: wc_author_email,
                wc_curr_user_comment_count: wc_curr_user_comment_count,
                wc_last_comment_id: wc_last_comment_id,
                wc_last_new_comment_id: wc_last_new_comment_id,
                wc_last_new_reply_id: wc_last_new_reply_id,
                wc_all_comments_count_old: wc_all_comments_count_old,
                wc_comments_offset: comment_offset,
                wc_comment_list_update_type: wc_comment_list_update_type,
                wc_post_id: wc_comment_post_ID,
                action: 'wc_live_update'
            }
        }).done(function (response) {
            update(response);
        });
    }

    /**
     * check if post has new comments updates comment list
     */
    // MUST BE CHANGED IN NEXT VERSION OF PLUGIN
    function updateIfNewComments() {
        wc_submitID = $('.wc_main_comm_form input.wc_comm_submit').attr('id');
        var uniqueID = wc_submitID.substring(wc_submitID.lastIndexOf('-') + 1);
        wc_comment_post_ID = getPostID(uniqueID);
        wc_comment_parent = getCommentID(uniqueID);
        var comment_offset = $('#wc_comments_offset').length ? $('#wc_comments_offset').val() : 1;
        var wc_curr_user_comment_count = $('#wc_curr_user_comment_count').val();
        var wc_last_comment_id = $('#wc_last_comment_id').val();
        var wc_last_new_comment_id = $('#wc_last_new_comment_id').val();
        var wc_last_new_reply_id = $('#wc_last_new_reply_id').val();
        wc_email = $.cookie('wc_author_email');
        $.ajax({
            type: 'POST',
            url: wc_ajax_obj.url,
            data: {
                wc_last_comment_id: wc_last_comment_id,
                wc_last_new_comment_id: wc_last_new_comment_id,
                wc_last_new_reply_id: wc_last_new_reply_id,
                wc_comment_list_update_type: wc_comment_list_update_type,
                wc_comments_offset: comment_offset,
                wc_curr_user_comment_count: wc_curr_user_comment_count,
                wc_post_id: wc_comment_post_ID,
                wc_author_email: wc_email,
                action: 'wc_live_update'
            }
        }).done(function (response) {
            update(response);
        });
    }

    /**
     * update front end
     */
    // MUST BE CHANGED IN NEXT VERSION OF PLUGIN
    function update(response) {
        try {
            var obj = $.parseJSON(response);
            if (obj.code == 1) {
                $('.wc-thread-wrapper').html(obj.message);
                if ($('.wc_header_text_count').length) {
                    $('.wc_header_text_count').html(obj.wc_all_comments_count_new);
                }
                $('#wc_last_comment_id').val(obj.wc_last_comment_id);
            } else if (obj.code == 2) {
                if (obj.wc_new_comment_count) {
                    $('.wc_new_comment_button_text').html(obj.wc_new_comment_count + ' ' + obj.wc_new_comment_button_text);
                    $('.wc_new_comment').css('display', 'inline-block');
                } else {
                    $('.wc_new_comment').css('display', 'none');
                }
                if (obj.wc_new_reply_count) {
                    $('.wc_new_reply_button_text').html(obj.wc_new_reply_count + ' ' + obj.wc_new_reply_button_text);
                    $('.wc_new_reply').css('display', 'inline-block');
                } else {
                    $('.wc_new_reply').css('display', 'none');
                }
            }
            setInputsDataFromCookie();
        } catch (e) {
            console.log(e);
        }
    }

    /**
     * check update or not
     */
    // MUST BE CHANGED IN NEXT VERSION OF PLUGIN
    function isFieldsActive(isNewComment) {
        var isInpFocus = $('.wc_secondary_form input.wc_field_input').is(':focus');
        var isTextAreaFocused = $('.wc_secondary_form textarea.wc_field_input').is(':focus');
        var isInputNotEmpty = false;
        var isTextAreaNotEmpty = false;
        if (isNewComment) {
            $('.wc_secondary_form input.wc_field_input').each(function () {
                if ($(this).val() != '') {
                    isInputNotEmpty = true;
                }
            });
        }
        else {
            $('.wc_secondary_form input.wc_field_captcha').each(function () {
                if ($(this).val() != '') {
                    isInputNotEmpty = true;
                }
            });
        }

        $('.wc_secondary_form textarea.wc_field_input').each(function () {
            if ($(this).val() != '') {
                isTextAreaNotEmpty = true;
            }
        });
        return isInpFocus || isTextAreaFocused || isInputNotEmpty || isTextAreaNotEmpty;
    }

    if (wc_comment_list_update_type != 0) {
        setInterval(liveUpdate, wc_comment_list_update_timer * 1000);
    }

    function setInputsDataFromCookie() {
        if ($.cookie('wc_author_name') && $.cookie('wc_author_email')) {
            $('.wc_name').val($.cookie('wc_author_name'));
            $('.wc_email').val($.cookie('wc_author_email'));
        }
    }

    function notify_on_new_comment(post_id, comment_id, email, type) {
        $.ajax({
            type: 'POST',
            url: wc_ajax_obj.url,
            data: {
                wc_post_id: post_id,
                wc_comment_id: comment_id,
                wc_notifcattion_type: type,
                wc_email: email,
                action: 'wc_check_notification_type'
            }
        });
    }

    $(document).delegate('.wc_editable_comment', 'click', function () {
        var uniqueID = getUniqueID($(this));
        var commentID = getCommentID(uniqueID);

        $.ajax({
            type: 'POST',
            url: wc_ajax_obj.url,
            data: {
                comment_id: commentID,
                action: 'wc_get_editable_comment_content'
            }
        }).done(function (response) {
            try {
                var obj = $.parseJSON(response);
                if (obj.code == 1) {
                    wc_comment_text_before_editting = obj.message;
                    var editableTextarea = '<textarea required="required" name="wc_comment" class="wc_comment wc_field_input wc_edit_comment" id="wc_edit_comment-' + uniqueID + '" style="min-height: 2em;">' + obj.message + '</textarea>';
                    $('#wc-comm-' + uniqueID + ' > .wc-comment-right .wc-comment-text').replaceWith(editableTextarea);
                    document.getElementById('wc_edit_comment-' + uniqueID).focus();
                    $('#wc_save_edited_comment-' + uniqueID).show();
                    editableTextarea = '';
                    $('#wc_editable_comment-' + uniqueID).hide();
                    $('#wc_cancel_edit-' + uniqueID).show();
                } else {
                    var html = "<a href='#close' title='Close' class='close'>&nbsp;</a>";
                    $('#wc_openModalFormAction').css('opacity', '1');
                    $('#wc_openModalFormAction').css('pointer-events', 'auto');
                    $('#wc_openModalFormAction .close').css('display', 'block');
                    $('#wc_openModalFormAction > #wc_response_info').html(html + obj.phrase_message);
                }
            } catch (e) {
                console.log(e);
            }
        });
    });

    $(document).delegate('.wc_save_edited_comment', 'click', function () {
        var uniqueID = getUniqueID($(this));
        var commentID = getCommentID(uniqueID);
        var editableTextarea = $('#wc-comm-' + uniqueID + ' textarea#wc_edit_comment-' + uniqueID);
        var commentContent = editableTextarea.val();
        var submit = true;
        var depth = getCommentDepth($(this).parents('.wc-comment')) - 1;
        if ($.trim(commentContent).length <= 0) {
            submit = false;
        }

        if (submit) {
            $('#wc_openModalFormAction .close').css('display', 'none');
            $('#wc_openModalFormAction').css('opacity', '1');
            $('#wc_openModalFormAction').css('pointer-events', 'auto');
            $('#wc_openModalFormAction > #wc_response_info').html(wc_loading_image);

            $.ajax({
                type: 'POST',
                url: wc_ajax_obj.url,
                data: {
                    comment_id: commentID,
                    comment_content: commentContent,
                    comment_depth: depth,
                    action: 'wc_save_edited_comment'
                }
            }).done(function (response) {
                try {
                    var obj = $.parseJSON(response);
                    if (obj.code == 1) {
                        $('#wc_openModalFormAction').css('opacity', '0');
                        $('#wc_openModalFormAction').css('pointer-events', 'none');
                        wc_cancel_or_save(uniqueID,obj.message);
                    } else {
                        var html = "<a href='#close' title='Close' class='close'>&nbsp;</a>";
                        $('#wc_openModalFormAction').css('opacity', '1');
                        $('#wc_openModalFormAction').css('pointer-events', 'auto');
                        $('#wc_openModalFormAction .close').css('display', 'block');
                        $('#wc_openModalFormAction > #wc_response_info').html(html + obj.phrase_message);
                    }
                    editableTextarea = '';
                    commentContent = '';
                } catch (e) {
                    console.log(e);
                }
            });
        }
    });

    $(document).delegate('.wc_cancel_edit', 'click', function () {
        var uniqueID = getUniqueID($(this));
        wc_cancel_or_save(uniqueID,wc_comment_text_before_editting);
    });

    function wc_cancel_or_save(uniqueID,content){
        $('#wc_editable_comment-' + uniqueID).show();
        $('#wc_cancel_edit-' + uniqueID).hide();
        $('#wc_save_edited_comment-' + uniqueID).hide();
        var commentContentWrapper = '<div class="wc-comment-text">' + nl2br(content) + '</div>';
        $('#wc-comm-' + uniqueID + ' #wc_edit_comment-' + uniqueID).replaceWith(commentContentWrapper);
    }
    
    function nl2br(str, is_xhtml) {
        var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br/>' : '<br>';
        var string = (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
        return string.replace('<br><br>', '<br/>');
    }

    $('.wc_tooltipster').tooltipster({offsetY: 2});
});