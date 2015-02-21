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
                <th> Address </th>
                <th> Website </th>
                <th> Phone </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hotels as $key => $hotel): /* @var $hotel Hotel */ ?>
            <tr>
                <td> <?php echo $hotel->id; ?> </td>
                <td> <?php echo $hotel->hotel_name; ?> </td>
                <td> <?php echo $hotel->country; ?> </td>
                <td> <?php echo $hotel->address; ?> </td>
                <td> <?php echo $hotel->website; ?> </td>
                <td> <?php echo $hotel->phone_number; ?> </td>
            </tr>   
            <?php endforeach; ?>
        </tbody>
    </table>
</div>