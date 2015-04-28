function create_picker_by_id(id) {

    var val = $("#" + id).val();
    $("#" + id).datepicker({
        inline: true
    });

    $("#" + id).datepicker("option", "dateFormat", 'dd-mm-yy');
}


function set_picker_date(picker_id, date, date_format) {
    if (date.length) {
        date_format = date_format ? date_format : 'yy-mm-dd'; // 'dd M yy';
        var last_date_format = $("#" + picker_id).datepicker('option', 'dateFormat');
        $("#" + picker_id).datepicker('option', 'dateFormat', date_format);
        $("#" + picker_id).datepicker('setDate', date);
        $("#" + picker_id).datepicker('option', 'dateFormat', last_date_format);
    }

}

function random_string(n) {
    if (!n) {
        n = 5;
    }
    var text = '';
    var possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

    for (var i = 0; i < n; i++) {
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    }

    return text;
}

$(function () {
    $('.confirm').click(function () {
        return window.confirm("Are you sure?");
    });
});