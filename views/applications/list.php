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
                <th> Group Name </th>
                <th> Festival Name </th>
                <th> Starting </th>
                <th> Created By </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($applications as $key => $row):  ?>
            <tr>
                <td> <a href="<?php echo URL::abs('applications/details/'.$row['id']); ?>"> <?php echo $row['id']; ?> </a> </td>
                <td> <?php echo $row['group_name']; ?> </td>
                <td> <?php echo $row['festival_name']; ?> </td>
                <td> <?php echo $row['event_started_at']; ?> </td>
                <td> <?php echo $row['username']; ?> </td>
            </tr>   
            <?php endforeach; ?>
        </tbody>
    </table>
</div>