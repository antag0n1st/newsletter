<div class="table">
    <?php if (isset($groups) && count($groups)): ?>
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
                    <th> Rooms </th>
                    <th> Invit. Status </th>                
                    <th> Country </th>
                    <th> Application By </th>
                    <th> Cancel </th>
                </tr>
            </thead>
            <?php
        $people_count = 0;
        $paid_sum = 0;
        $number_of_rooms = 0;
        ?>
            <tbody>
                <?php foreach ($groups as $key => $row): ?>
                
                <?php
                $people_count += $row['participants'];
                $paid_sum += $row['invoice_paid_sum'];
                $number_of_rooms += $row['number_of_rooms'];
                ?>
                
                    <tr>
                        <td> <a href="<?php echo URL::abs('applications/details/' . $row['application_id']); ?>"> <?php echo $row['application_id']; ?> </a> </td>
                        <td> <a href="<?php echo URL::abs('groups/details/' . $row['id']); ?>"> <?php echo $row['group_name']; ?> </a> </td>
                        <td> <?php echo $row['contact_name']; ?> </td>
                        <td> <?php echo $row['participants']; ?> </td>
                        <td> <?php echo $row['invoice_paid_sum']; ?> </td>
                        <td> <?php echo $row['number_of_rooms']; ?> </td>
                        <td> <?php echo $row['invitation_is_sent'] ? 'Sent' : '-'; ?> </td>
                        <td> <?php echo $row['country_name']; ?> </td>
                        <td> <?php echo $row['username']; ?> </td>
                        <td> <a class="confirm" href="<?php echo URL::abs('applications/cancel/' . $row['application_id']); ?>"> Cancel </a> </td>
                    </tr>   
                <?php endforeach; ?>

                <?php if (count($groups)): ?>
                    <tr>
                        <td> <strong> <?php echo count($groups) ?> </strong> </td>
                        <td> - </td>
                        <td> - </td>
                        <td> <strong><?php echo $people_count; ?></strong> </td>
                        <td> <strong><?php echo $paid_sum; ?></strong> </td>
                        <td> <strong><?php echo $number_of_rooms; ?></strong> </td>
                        <td> - </td>
                        <td> - </td>
                        <td> - </td>
                        <td> - </td>
                    </tr>  
                <?php endif; ?>

            </tbody>
        </table>
    <?php else: ?>
        <h2>There are no participants for this event yet.</h2>
        <p>If you want to set an application for your clients 
            <a href="<?php echo URL::abs('applications/add'); ?>">click here</a> 
        </p>
    <?php endif; ?>
</div>