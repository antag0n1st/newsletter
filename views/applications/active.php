<div class="table">
    <?php if (isset($filter)): ?> 
        <h2><?php echo $filter ?></h2>
    <?php endif; ?>
    <table>
        <colgroup>
            <col class="colid" />
        </colgroup>
        <?php
        $people_count = 0;
        $groups_count = 0;
        $paid_sum = 0;
        $number_of_rooms = 0;
        ?>
        <thead>
            <tr id="title-line">
                <th> ID </th>
                <th> Name of festival </th>
                <th> Starting At </th>
                <th> Ending At </th>
                <th> People </th>
                <th> Groups </th>                
                <th> Rooms </th>
                <th> Paid sum </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($events as $key => $row): ?>

                <?php
                $people_count += $row['participants'];
                $groups_count += $row['number_of_groups'];
                $paid_sum += $row['invoice_paid_sum'];
                $number_of_rooms += $row['number_of_rooms'];
                ?>
            
                <tr>
                    <td> <a href="<?php echo URL::abs('groups/at-event/' . $row['id']); ?>"> <?php echo $row['id']; ?> </a> </td>
                    <td> <?php echo $row['festival_name']; ?> </td>
                    <td> <?php echo TimeHelper::to_date($row['event_started_at'], 'd M Y'); ?> </td>
                    <td> <?php echo TimeHelper::to_date($row['event_ended_at'], 'd M Y'); ?> </td>
                    <td> <?php echo $row['participants'] ? $row['participants'] : '-'; ?> </td>
                    <td> <?php echo $row['number_of_groups'] ? $row['number_of_groups'] : '-'; ?> </td>                
                    <td> <?php echo $row['number_of_rooms'] ? $row['number_of_rooms'] : '-'; ?> </td>
                    <td> <?php echo $row['invoice_paid_sum']; ?> </td>
                </tr>   
            <?php endforeach; ?>

            <?php if (count($events)): ?>
                <tr>
                    <td> <strong> <?php echo count($events) ?> </strong> </td>
                    <td> - </td>
                    <td> - </td>
                    <td> - </td>
                    <td> <strong><?php echo $people_count; ?></strong> </td>
                    <td> <strong><?php echo $groups_count; ?></strong> </td>
                    <td> <strong><?php echo $number_of_rooms; ?></strong> </td>
                    <td> <strong><?php echo $paid_sum; ?></strong> </td>
                </tr>  
            <?php endif; ?>

        </tbody>
    </table>

    <?php
    if (isset($paginator)) { /* @var $paginator Paginator */
        $paginator->build_pagination_html();
    }
    ?>
</div>