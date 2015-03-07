function create_picker_by_id(id) {
    $("#"+id).datepicker({
        inline: true
    });

    $("#"+id).datepicker("option", "dateFormat", 'dd-mm-yy');
}