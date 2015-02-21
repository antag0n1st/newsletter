<div class="table">
    <table>
        <colgroup>
            <col class="colid" />
        </colgroup>
        <thead>
            <tr id="title-line">
                <th> ID </th>
                <th> Name </th>
                <th> Action </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($countries as $key => $country): /* @var $country Country */ ?>
            <tr>
                <td> <?php echo $country->id; ?> </td>
                <td> <?php echo $country->country_name; ?> </td>
                <td> 
                    <a href="<?php echo URL::abs('countries/delete/'.$country->id); ?>" class="link2">
                        <img  class="delite-hover" src="images/delite.png" width="80" height="20" 
                              alt="Delite" title="Delite" />
                    </a>
                </td>
            </tr>   
            <?php endforeach; ?>
        </tbody>
    </table>
</div>