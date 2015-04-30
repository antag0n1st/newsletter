<div class="table">
    <table>
        <colgroup>
            <col class="colid" />
        </colgroup>
        <thead>
            <tr id="title-line">
                <th> ID </th>
                <th> Name </th>
                <th> Started </th>
                <th> Ended </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($events as $key => $event): /* @var $event Event */ ?>
                <tr>
                    <td> <?php echo $event->id; ?> </td>
                    <td> <?php echo $event->festival_name; ?> </td>
                    <td> 
                        <?php
                            if ($event->event_started_at == 0) {
                                echo "-";
                            } else {
                                echo date('d M Y', strtotime($event->event_started_at));
                            }
                        ?> 
                    </td>
                    <td> 
                        <?php
                            if ($event->event_ended_at == 0) {
                                echo "-";
                            } else {
                                echo date('d M Y', strtotime($event->event_ended_at));
                            }
                        ?> 
                    </td>
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