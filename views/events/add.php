<form id="add-event" name="form" method="post" action="<?php echo URL::abs('events/add'); ?>">
    
    Title: <input type="text" name="event_name" value="<?php echo isset($_POST['event_name']) ? $_POST['event_name'] : ""; ?>" /> <br /><br />
    Start Date: <input name="start_date" type="text" id="start-date-datepicker" value="<?php echo isset($_POST['start_date']) ? $_POST['start_date'] : ""; ?>"> <br /><br />
    End Date: <input name="end_date" type="text" id="end-date-datepicker" value="<?php echo isset($_POST['end_date']) ? $_POST['end_date'] : ""; ?>"> <br /><br />
    <input type="submit" value="save" />

</form>

<script type="text/javascript">

    function create_picker_by_id(id) {
        $(id).datepicker({
            inline: true
        });

        $(id).datepicker("option", "dateFormat", 'dd-mm-yy');
    }

    create_picker_by_id('#start-date-datepicker');
    create_picker_by_id('#end-date-datepicker');

</script>