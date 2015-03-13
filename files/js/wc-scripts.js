jQuery(document).ready(function ($) {
    var pickerImg1 = $('.wc_colorpicker_img1');
    var modalBox1 = $('div#wc_box1');
    var position1 = pickerImg1.position();
    /*modalBox1.css('margin-left', position1.left + 200);*/

    $('#wc_colorpickerHolder1').ColorPicker({
        flat: true,
        onChange: function (hsb, hex, rgb) {
            $('#wc_comment_bg_color').val('#' + hex);
        }
    });

    $('#wc_colorpickerHolder2').ColorPicker({
        flat: true,
        onChange: function (hsb, hex, rgb) {
            $('#wc_reply_bg_color').val('#' + hex);
        }
    });

    $('#wc_colorpickerHolder3').ColorPicker({
        flat: true,
        onChange: function (hsb, hex, rgb) {
            $('#wc_comment_text_color').val('#' + hex);
        }
    });

    $('#wc_colorpickerHolder4').ColorPicker({
        flat: true,
        onChange: function (hsb, hex, rgb) {
            $('#wc_author_title_color').val('#' + hex);
        }
    });

    $('#wc_colorpickerHolder5').ColorPicker({
        flat: true,
        onChange: function (hsb, hex, rgb) {
            $('#wc_vote_reply_color').val('#' + hex);
        }
    });

    $('#wc_colorpickerHolder6').ColorPicker({
        flat: true,
        onChange: function (hsb, hex, rgb) {
            $('#wc_form_bg_color').val('#' + hex);
        }
    });

    $('#wc_colorpickerHolder7').ColorPicker({
        flat: true,
        onChange: function (hsb, hex, rgb) {
            $('#wc_new_loaded_comment_bg_color').val('rgb(' + rgb.r + ',' + rgb.g + ',' + rgb.b + ')');
        }
    });
});