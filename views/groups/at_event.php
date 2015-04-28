<div class="table">
    <?php if(isset($groups) && count($groups)): ?>
    <table>
        <colgroup>
            <col class="colid" />
        </colgroup>
        <thead>
            <tr id="title-line">
                <th> ID </th>
                <th> Group name </th>
                <th> Contact name </th>
                <th> Participants </th>
                <th> Sum paid </th>
                <th> Number of rooms </th>
                <th> Invitation status </th>                
                <th> Country </th>
                <th> Application By </th>
                <th> Cancel </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($groups as $key => $row):  ?>
            <tr>
                <td> <a href="<?php echo URL::abs('applications/details/'.$row['application_id']); ?>"> <?php echo $row['application_id']; ?> </a> </td>
                <td> <a href="<?php echo URL::abs('groups/details/'.$row['id']); ?>"> <?php echo $row['group_name'];  ?> </a> </td>
                <td> <?php echo $row['contact_name'];  ?> </td>
                <td> <?php echo $row['participants']; ?> </td>
                <td> <?php echo $row['invoice_paid_sum']; ?> </td>
                <td> <?php echo $row['number_of_rooms']; ?> </td>
                <td> <?php echo $row['invitation_is_sent'] ? 'Sent' : '-'; ?> </td>
                <td> <?php echo $row['country_name']; ?> </td>
                <td> <?php echo $row['username']; ?> </td>
                <td> <a class="confirm" href="<?php echo URL::abs('applications/cancel/'.$row['application_id']); ?>"> Cancel </a> </td>
            </tr>   
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <h2>There are no participants for this event yet.</h2>
    <p>If you want to set an application for your clients 
        <a href="<?php echo URL::abs('applications/add'); ?>">click here</a> 
    </p>
    <?php endif; ?>
</div>