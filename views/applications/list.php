<div class="table">
    <?php if (isset($filter)): ?> 
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
                <th> Event Starting </th>
                <th> Application sent </th>
                <th> Created By </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($applications as $key => $row): ?>
                <tr>
                    <td> <a href="<?php echo URL::abs('applications/details/' . $row['id']); ?>"> <?php echo $row['id']; ?> </a> </td>
                    <td> <?php echo $row['group_name']; ?> </td>
                    <td> <?php echo $row['festival_name']; ?> </td>
                    <td> <?php echo $row['event_started_at']; ?> </td>
                    <td> <?php echo $row['application_date_sent'] ? TimeHelper::to_date($row['application_date_sent'],'d M Y') : '-'; ?> </td>
                    <td> <?php echo $row['username']; ?> </td>
                </tr>   
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php
    /* @var $paginator Paginator */
    if (isset($paginator)) {
        $paginator->build_pagination_html();
    }
    ?>

</div>