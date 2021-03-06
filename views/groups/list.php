<div class="table">
    <table>
        <colgroup>
            <col class="colid" />
        </colgroup>
        <thead>
            <tr id="title-line">
                <th> ID </th>
                <th> Name </th>
                <th> Contact </th>
                <th> Email </th>
                <th> Country </th>
                <th> Address </th>
                <th> Website </th>
                <th> Phone </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($groups as $key => $group): /* @var $group Group */ ?>
            <tr>
                <td> <a href="<?php echo URL::abs('groups/details/'.$group->id); ?>"> <?php echo $group->id; ?> </a> </td>
                <td> <?php echo $group->group_name; ?> </td>
                <td> <?php echo $group->contact_name; ?> </td>
                <td> <?php echo $group->email; ?> </td>
                <td> <?php echo $countries[$group->country_id]; ?> </td>
                <td> <?php echo $group->address; ?> </td>
                <td> <?php echo $group->website; ?> </td>
                <td> <?php echo $group->phone_number; ?> </td>
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