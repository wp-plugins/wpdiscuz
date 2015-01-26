jQuery(document).ready(function ($) {
    $('#wc_voting_buttons_show_hide').change(function () {
        if ($(this).is(':checked')) {
            $(this).val('1');
        } else {
            $(this).val('0');
        }
    });

    $('#wc_share_buttons_show_hide').change(function () {
        if ($(this).is(':checked')) {
            $(this).val('1');
        } else {
            $(this).val('0');
        }
    });

    $('#wc_captcha_show_hide').change(function () {
        if ($(this).is(':checked')) {
            $(this).val('1');
        } else {
            $(this).val('0');
        }
    });

    $('#wc_reply_button_guests_show_hide').change(function () {
        if ($(this).is(':checked')) {
            $(this).val('1');
        } else {
            $(this).val('0');
        }
    });

    $('#wc_reply_button_members_show_hide').change(function () {
        if ($(this).is(':checked')) {
            $(this).val('1');
        } else {
            $(this).val('0');
        }
    });

    $('#wc_author_titles_show_hide').change(function () {
        if ($(this).is(':checked')) {
            $(this).val('1');
        } else {
            $(this).val('0');
        }
    });

    $('#wc_jquery_ajax_features_on_off').change(function () {
        if ($(this).is(':checked')) {
            $(this).val('1');
        } else {
            $(this).val('0');
        }
    });

    $('#wc_held_comment_to_moderate').change(function () {
        if ($(this).is(':checked')) {
            $(this).val('1');
        } else {
            $(this).val('0');
        }
    });

    $('#wc_simple_comment_date').change(function () {
        if ($(this).is(':checked')) {
            $(this).val('1');
        } else {
            $(this).val('0');
        }
    });
    
    $('#wc_show_hide_comment_checkbox').change(function () {
        if ($(this).is(':checked')) {
            $(this).val('1');
        } else {
            $(this).val('0');
        }
    });

    $('#wc_show_hide_reply_checkbox').change(function () {
        if ($(this).is(':checked')) {
            $(this).val('1');
        } else {
            $(this).val('0');
        }
    });
});