<?php
Load::script('plugins/ckeditor/ckeditor');
Load::script('plugins/ckfinder/ckfinder');
?>
<form id="add-template" name="form" method="post" action="<?php echo URL::abs('newsletter/add-template'); ?>">

    <br />
    title: <input name="title" type="text" <?php HTML::post_value('title'); ?> /><br /><br />

    <?php
    $ckeditor = new CKEditor();
    $ckeditor->config['height'] = 500;
    $ckeditor->config['width'] = 800;
    $ckeditor->basePath = BASE_URL . 'plugins/ckeditor/';
    CKFinder::SetupCKEditor($ckeditor, '../plugins/ckfinder/');

    $content = isset($_POST['template']) ? $_POST['template'] : "";
    
    $ckeditor->editor('template',$content);
    ?>

    <input type="submit" />

</form>