<div class="container o">
    
    <div class="left">
    <h2>
        <a href="<?php /* @var $category BlogCategory */ echo URL::abs($category->latin_name); ?>">
        <?php echo $category->category_name; ?>
        </a>
    </h2>
    <div class="separator"></div>
    
    <div class="home-items-container">

            <?php foreach($posts as $post):  /* @var $post BlogPost */ ?>
                <div class="item">
                    <div class="frame">
                        <a href="<?php echo URL::abs($post->permalink.'/'.$post->id); ?>">
                            <img alt="" src="<?php echo URL::abs('public/uploads/large-thumbnails/'.$post->thumbnail_image_url); ?>" />
                        </a>
                    </div>
                    <h3>
                        <a href="<?php echo URL::abs($post->permalink.'/'.$post->id); ?>">
                        <?php echo $post->title; ?>
                        </a>
                    </h3>
                    <p><?php echo String::smart_short($post->description); ?></p>
                </div>        
            <?php endforeach; ?>
     </div>
    
    <?php /* @var $paginator Paginator */ $paginator->build_pagination_html(); ?>
    
</div>

<div class="right">
    <?php Load::view('elements/side_panel'); ?>
</div>
    
</div>
