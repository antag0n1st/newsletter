<div class="table">
    <?php if(isset($filter)): ?> 
    <h2><?php echo $filter ?></h2>
    <?php endif; ?>
    <table>
        <colgroup>
            <col class="colid" />
        </colgroup>
        <thead>
            <tr id="title-line">
                <th> ID </th>
                <th> Name of festival </th>
                <th> Starting At </th>
                <th> Ending At </th>
                <th> People coming </th>
                <th> Groups coming </th>                
                <th> Number of rooms </th>
                <th> Paid sum </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($events as $key => $row):  ?>
            <tr>
                <td> <a href="<?php echo URL::abs('groups/at-event/'.$row['id']); ?>"> <?php echo $row['id']; ?> </a> </td>
                <td> <?php echo $row['festival_name']; ?> </td>
                <td> <?php echo TimeHelper::to_date($row['event_started_at'],'d M Y'); ?> </td>
                <td> <?php echo TimeHelper::to_date($row['event_ended_at'],'d M Y'); ?> </td>
                <td> <?php echo $row['participants'] ? $row['participants'] : '-'; ?> </td>
                <td> <?php echo $row['number_of_groups'] ? $row['number_of_groups'] : '-';  ?> </td>                
                <td> <?php echo $row['number_of_rooms'] ? $row['number_of_rooms'] : '-'; ?> </td>
                <td> <?php echo $row['invoice_paid_sum']; ?> </td>
            </tr>   
            <?php endforeach; ?>
        </tbody>
    </table>
</div>