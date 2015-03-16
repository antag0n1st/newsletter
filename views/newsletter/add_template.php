<?php
Load::script('plugins/ckeditor/ckeditor');
Load::script('plugins/ckfinder/ckfinder');
?>
<form class="details1" id="add-template" name="form" method="post" action="<?php echo URL::abs('newsletter/add-template'); ?>">
    <div class="collum1 text">
    title: 
    </div>
    <div class="collum2">
    <input class="input-text" name="title" type="text" <?php HTML::post_value('title'); ?> /><br /><br />
    </div>
    <br/><br/><br/>

    <?php
    $ckeditor = new CKEditor();
    $ckeditor->config['height'] = 500;
    $ckeditor->config['width'] = 800;
    $ckeditor->basePath = BASE_URL . 'plugins/ckeditor/';
    CKFinder::SetupCKEditor($ckeditor, '../plugins/ckfinder/');

    $content = isset($_POST['template']) ? $_POST['template'] : "";
    
    $ckeditor->editor('template',$content);
    ?>
    
    <br/>

    <input class="save s" type="submit" value="Save"/>

</form>