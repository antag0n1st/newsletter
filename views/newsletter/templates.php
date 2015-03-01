<div class="table">
    <table>
        <colgroup>
            <col class="colid" />
        </colgroup>
        <thead>
            <tr id="title-line">
                <th> ID </th>
                <th> Title </th>
                <th> Created At </th>
                <th> Preview </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($newsletters as $key => $newsletter): /* @var $newsletter Newsletter */ ?>
            <tr>
                <td> <?php echo $newsletter->id; ?> </td>
                <td> <?php echo $newsletter->title; ?> </td>
                <td> <?php echo date('d M Y', strtotime($newsletter->created_at)); ?> </td>
                <td> <a target="_blank" href="<?php echo URL::abs('newsletter/template-details/'.$newsletter->id); ?>" class="link2">
                        <img  class="view-hover" src="<?php echo URL::image('view.png'); ?>" width="80" height="20" 
                              alt="view" title="view" />
                    </a> </td>
            </tr>   
            <?php endforeach; ?>
        </tbody>
    </table>
</div>