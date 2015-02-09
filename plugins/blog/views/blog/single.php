<div class="container o">
    
    <div class="left">
        <h2>
            <?php /* @var $post BlogPost */ 
            if(Membership::instance()->user->user_level >= 4){
                //echo $post->title; 
                echo '<a href="'.URL::abs('admin-posts/edit-post/'.$post->id).'">'.$post->title.'</a>';
            }else{
                echo $post->title; 
            }
            
            /* @var $category BlogCategory */ ?>
        </h2>
        
        <span class="blog-date">Објавено на: <?php echo Date::format($post->release_date); ?></span>
        <span class="blog-date"> во <a href="<?php echo URL::abs($category ? $category->latin_name : ''); ?>"><?php echo $category ? $category->category_name : ''; ?></a></span>
        <div class="separator dashed"></div>
        <div class="blog-post o"><?php echo $post->post; ?></div>


        <div style="margin-top: 20px; margin-bottom: 20px;">
            <div id="fb-root"></div>

            <script type="text/javascript">
                //<![CDATA[    
                document.write('<fb:like href="<?php echo URL::current_page_url(); ?>" send="false" width="450" show_faces="true" font="arial"></fb:like>');
                (function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) {return;}
                    js = d.createElement(s); js.id = id;
                    js.src = "//connect.facebook.net/mk_MK/all.js#xfbml=1";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
                //]]>
            </script>
            
            <a href="https://twitter.com/share" class="twitter-share-button" data-via="ladymk_info">Tweet</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

        </div>
        <div>
            <h2 style="margin-bottom: 10px;">Може да ве интересира и:</h2>
            <div class="separator"></div>
            <div class="related-items">
                <?php foreach($related_posts as $p): ?>
                <div class="item">
                    <div class="frame">
                        <a href="<?php echo URL::abs($p->permalink.'/'.$p->id); ?>">
                            <img style="<?php echo $p->thumbnail_attribute; ?>" alt="" src="<?php echo URL::abs('public/uploads/'.$p->thumbnail_image_url); ?>" />
                        </a>
                    </div>
                    <h3>
                        <a href="<?php echo URL::abs($p->permalink.'/'.$p->id); ?>">
                        <?php echo $p->title; ?>
                        </a>
                    </h3>
                </div>
                <?php endforeach; ?>
                
            </div>
            
            
        </div>
        <div class="o">
            Тагови:
            <?php $tags = explode(',', $post->keywords);
           
            $tags_data = array();
            foreach($tags as $tag){
                $tags_data[] = " <a href='".URL::abs('tag/'.  urlencode(trim($tag))."'>".trim($tag)."</a>");
            }
            
            echo implode(',', array_values($tags_data));
            ?>
        </div>
        <?php if (false): //if(isset($author)): ?>
            <div class="rounded-10 profile">
                <img alt="" src="<?php echo $author->image_url; ?>" />
                <span>Напишано од </span>
                <h2><?php echo $author->full_name; ?></h2>
                <p> <?php echo $author->bio; ?> </p>

            </div>
        <?php endif; ?>
        <h2 style="margin-bottom: 5px; margin-top: 10px;">Коментари:</h2>
        
        <?php echo $comments; ?>
    </div>
    
    
    <div class="right">
        
        <?php Load::view('elements/side_panel'); ?>

    </div>
    
    
</div>


