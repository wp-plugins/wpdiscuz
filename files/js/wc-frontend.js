jQuery(document).ready(function ($) {
    $(document).delegate('.wc_notification_new_comment', 'change', function () {
        if ($(this).is(':checked')) {
            $(this).val('1');
        } else {
            $(this).val('0');
        }
    });

    $(document).delegate('.wc_notification_new_reply', 'change', function () {
        if ($(this).is(':checked')) {
            $(this).val('1');
        } else {
            $(this).val('0');
        }
    });
});
