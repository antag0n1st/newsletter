<form id="edit-applications" name="form" method="post" action="<?php echo URL::abs('applications/details/' . $id); ?>">
    <br />    
    <p style="margin-left: 20px;">
        group name: <strong> <?php echo $application['group_name']; ?> </strong> <br />
        category name: <strong> <?php echo $application['category_name']; ?> </strong> <br />
        contact name: <strong> <?php echo $application['contact_name']; ?> </strong> <br />
        country: <strong> <?php echo $application['country_name']; ?> </strong> <br />
        city: <strong> <?php echo $application['city']; ?> </strong> <br />

        <br />

        participants: <strong> <?php echo $application['participants']; ?> </strong> <br />
        date of arrival: <strong> <?php echo $application['date_of_arrival']; ?> </strong> <br />
        date of departure: <strong> <?php echo $application['date_of_departure']; ?> </strong> <br />
        needs to be picked up from airport: <strong> <?php echo $application['needs_airport_pickup'] ? 'yes' : 'no'; ?> </strong> <br />

        <br />

        1 bed rooms: <strong> <?php echo $application['room_1']; ?> </strong> <br />
        2 bed rooms: <strong> <?php echo $application['room_2']; ?> </strong> <br />
        3 bed rooms: <strong> <?php echo $application['room_3']; ?> </strong> <br />
        4 bed rooms: <strong> <?php echo $application['room_4']; ?> </strong> <br />
        5 bed rooms: <strong> <?php echo $application['room_5']; ?> </strong> <br />

        number of rooms: <strong> <?php echo $application['number_of_rooms']; ?> </strong> <br />
        hotel: <strong> <?php echo $application['hotel_name']; ?> </strong> <br />

        <br />
        remarks: <?php HTML::textarea('remarks', '', '', array(), false, $application['remarks']); ?> <br />

        <br />
        
        group manager: <strong> <?php echo $application['group_manager']; ?> </strong> <br />
        <br />

        application is sent: <?php HTML::checkbox('application_is_sent', '', 'yes', '', array(), false, $application['application_is_sent']); ?> <br /><br />
        application has answer: <?php HTML::checkbox('application_has_answer', '', 'yes', '', array(), false, $application['application_has_answer']); ?> <br /><br />

        invitation is sent: <?php HTML::checkbox('invitation_is_sent', '', 'yes', '', array(), false, $application['invitation_is_sent']); ?> <br /><br />
        invitation price: <?php HTML::textfield('invitation_price', '', '', array(), false, $application['invitation_price']); ?> <br /><br />

        invoice price: <?php HTML::textfield('invoice_price', '', '', array(), false, $application['invoice_price']); ?> <br /><br />
        invoice is paid: <?php HTML::checkbox('invoice_is_paid', '', 'yes', '', array(), false, $application['invoice_is_paid']); ?> <br /><br />

    </p>
    
    <input type="submit" />

</form>

<script type="text/javascript">

</script>