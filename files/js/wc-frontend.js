jQuery(document).ready(function ($) {
    $(document).delegate('.wc_manage_subscribtions', 'click', function () {
        $(this).next('.wc_notification_checkboxes').slideToggle(700);
    });
});