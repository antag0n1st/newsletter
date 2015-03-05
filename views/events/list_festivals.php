<div class="table">
    <table>
        <colgroup>
            <col class="colid" />
        </colgroup>
        <thead>
            <tr id="title-line">
                <th> ID </th>
                <th> Name </th>
                <th> Country </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($festivals as $key => $festival): /* @var $festival Festival */ ?>
                <tr>
                    <td> <?php echo $festival->id; ?> </td>
                    <td> <?php echo $festival->festival_name; ?> </td>
                    <td> <?php echo $countries[$festival->country_id]; ?> </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>