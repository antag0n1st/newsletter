<div class="table">
    <table>
        <colgroup>
            <col class="colid" />
        </colgroup>
        <thead>
            <tr id="title-line">
                <th> ID </th>
                <th> Name </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $key => $category): /* @var $category Category */ ?>
            <tr>
                <td> <?php echo $category->id; ?> </td>
                <td> <?php echo $category->category_name; ?> </td>
            </tr>   
            <?php endforeach; ?>
        </tbody>
    </table>
</div>