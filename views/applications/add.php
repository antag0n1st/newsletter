<form id="add-applications" name="form" method="post" action="<?php echo URL::abs('applications/add'); ?>">
    <br />
    participant: <input name="participant" type="text" <?php HTML::post_value('participant'); ?> /> <br /><br />
    date of arrival: <input id="date_of_arrival" name="date_of_arrival" type="text" <?php HTML::post_value('date_of_arrival'); ?> /> <br /><br />
    date of departure: <input id="date_of_departure" name="date_of_departure" type="text" <?php HTML::post_value('date_of_departure'); ?> /> <br /><br />
    
    needs airport pickup: <?php HTML::checkbox('needs_airport_pickup'); ?> <br /><br />
    number of rooms: <input name="number_of_rooms" type="text" <?php HTML::post_value('number_of_rooms'); ?> /> <br /><br />
    
    remarks:<textarea name="remarks"><?php echo isset($_POST['remarks']) ? $_POST['remarks'] : ''; ?></textarea><br /><br />
    
    application is sent: <?php HTML::checkbox('application_is_sent'); ?> <br /><br />
    application has answer: <?php HTML::checkbox('applications_has_answer'); ?> <br /><br />
    
    invitation is sent: <?php HTML::checkbox('invitation_is_sent'); ?> <br /><br />
    invitation price: <input name="invitation_price" type="text" <?php HTML::post_value('invitation_price'); ?> /> <br /><br />
    
    invoice price: <input name="invoice_price" type="text" <?php HTML::post_value('invoice_price'); ?> /> <br /><br />
    invoice is paid: <?php HTML::checkbox('invoice_is_paid'); ?> <br /><br />
    
    group manager: <input name="group_manager" type="text" <?php HTML::post_value('group_manager'); ?> /> <br /><br />
    
    
    <input type="submit" />
    
</form>