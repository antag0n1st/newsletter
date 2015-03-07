<form id="add-applications" name="form" method="post" action="<?php echo URL::abs('applications/add'); ?>">
    <br />
    participant: <?php HTML::textfield('participant'); ?> <br /><br />
    date of arrival: <?php HTML::textfield('date_of_arrival'); ?>  <br /><br />
    date of departure: <?php HTML::textfield('date_of_departure'); ?><br /><br />

    needs airport pickup: <?php HTML::checkbox('needs_airport_pickup'); ?> <br /><br />
    number of rooms: <?php HTML::textfield('number_of_rooms'); ?> <br /><br />
    
    1 bed room: <?php HTML::textfield('bed_1'); ?> <br /><br />
    2 bed room: <?php HTML::textfield('bed_2'); ?> <br /><br />
    3 bed room: <?php HTML::textfield('bed_3'); ?> <br /><br />
    4 bed room: <?php HTML::textfield('bed_4'); ?> <br /><br />
    5 bed room: <?php HTML::textfield('bed_5'); ?> <br /><br />

    remarks:<?php HTML::textarea('remarks'); ?><br /><br />

    application is sent: <?php HTML::checkbox('application_is_sent'); ?> <br /><br />
    application has answer: <?php HTML::checkbox('applications_has_answer'); ?> <br /><br />

    invitation is sent: <?php HTML::checkbox('invitation_is_sent'); ?> <br /><br />
    invitation price: <?php HTML::textfield('invitation_price'); ?> <br /><br />

    invoice price: <?php HTML::textfield('invoice_price'); ?> <br /><br />
    invoice is paid: <?php HTML::checkbox('invoice_is_paid'); ?> <br /><br />

    group manager: <?php HTML::textfield('group_manager'); ?> <br /><br />


    <input type="submit" />

</form>

<script type="text/javascript">
    create_picker_by_id("date_of_arrival");
    create_picker_by_id("date_of_departure");
</script>