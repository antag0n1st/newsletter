<?php

class AdminPostsController extends Controller{
    
    function __construct() {
        
        parent::__construct();
        
        if(Membership::instance()->user->user_level < 4){
            URL::redirect('oops/no-privileges');
        }
        
        Load::plugin_model('blog', 'blog_post');
        Load::plugin_model('blog', 'blog_category');
        
        global $_active_page_;
        $_active_page_ = 'admin';
        
        global $layout;
        $layout = 'admin';
        
        Head::instance()->load_css('../../plugins/blog/css/blog');
        Head::instance()->load_css('../../plugins/blog/css/flick/jquery-ui-1.8.16.custom');
        Head::instance()->load_css('../../plugins/blog/css/jquery.tagit');
      
        Head::instance()->add('<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>');
        
      //  Head::instance()->load_css('../../plugins/blog/css/examples');
        Head::instance()->load_css('../../plugins/blog/css/master');
      //  Head::instance()->load_css('../../plugins/blog/css/reset');
     //   Head::instance()->load_css('../../plugins/blog/css/tagit.ui-zendesk');
        
        
        Head::instance()->load_js('../../plugins/blog/js/jquery.ui.core.min');
        Head::instance()->load_js('../../plugins/blog/js/jquery.ui.datepicker');
        Head::instance()->load_js('../../plugins/blog/js/jquery.ui.widget.min');
        Head::instance()->load_js('../../plugins/blog/js/jquery.ui.position.min');
        
        Head::instance()->load_js('../../plugins/blog/js/tag-it');
        
    }

    
    public function browse_posts($page_id = 1){
        
        global $view;
        $view  = 'browse_posts';
        
        Load::helper('paginator');
        
        $paginator = new Paginator(BlogPost::count_all(), $page_id, 30, 'admin-posts/browse-posts/');
        
        $posts = BlogPost::find_all($paginator);
        $categories = BlogCategory::find_all();
        
        Load::assign('posts', $posts);
        Load::assign('categories', $categories);
        Load::assign('paginator', $paginator);
        
        
    }
    
    public function avtori($page_id = 1){
        $this->browse_posts($page_id);
        
        $query = " SELECT * FROM users where user_level >= 9 ";
        $result = Model::db()->query($query);
        $writers = array();
        while($row = Model::db()->fetch_assoc($result)){
            $writers[] = $row;
        }
        Load::assign('writers', $writers);
        global $view;
        $view = 'avtori';
    }
    public function change_avtor(){
        global $layout;
        $layout = false;
        /* @var $post BlogPost */
        if(isset($_POST) and $_POST){
            $post = BlogPost::find_by_id($_POST['post_id']);
            $post->author_name = $_POST['full_name'];
            $post->author      = $_POST['writer_id'];
            $post->save();
        }
    }
    
    public function write_post(){
        
        global $view;
        $view  = 'write_post';
        
        
        
        if(isset ($_POST) and $_POST){
            
         
         $post = BlogPost::find_by_id($_POST['auto_save_id']);
         
         if(!$post){
             
             $post = new BlogPost();
             $post->id = $_POST['auto_save_id'];
             $post->release_date = $_POST['publish_date'].' 9:00:00';
         }
         
         
         $post->title = str_replace(array("\r\n","\r","\n") , '', $_POST['title']);
         $post->description = str_replace(array("\r\n","\r","\n") , '', $_POST['description']);
         $post->author = Membership::instance()->user->id;
         $post->author_name = Membership::instance()->user->full_name;
         $post->blog_categories_id = $_POST['category'];
         $post->date_created = TimeHelper::DateTimeAdjusted();
         $post->keywords = str_replace(array("\r\n","\r","\n") , '', $_POST['keywords']);
         $post->post = $_POST['post'];
         
         $post->thumbnail_image_url = $_POST['thumnail_url'];
         $post->enabled = $_POST['enabled'];
         $post->permalink = String::clean_for_url($_POST['title'], true);
         $post->thumbnail_tag = $_POST['thumbnail-tag'];
         
         $post->save();
         
         Load::model('tag');
         $terms = explode(',', $post->keywords);
         foreach ($terms as $term){
             Tag::add_tag($term);
         }
         Tag::asign_tags_to_post($post->id, $terms);
            
         URL::redirect('admin-posts/browse-posts');
            
        }else{
            
        $categories = BlogCategory::find_all();
      
        Load::assign('categories', $categories);
            
        }
        
    }
    
    public function auto_save_post(){
        global $layout;
        $layout = false;
        
         $post = new BlogPost();
         $post->id = $_POST['auto_save_id'];
         $post->title = str_replace(array("\r\n","\r","\n") , '', $_POST['title']);
         $post->description = str_replace(array("\r\n","\r","\n") , '', $_POST['description']);
         $post->author = Membership::instance()->user->id;
         $post->author_name = Membership::instance()->user->full_name;
         $post->blog_categories_id = $_POST['category'];
         $post->date_created = date("Y-m-d");
         $post->keywords = str_replace(array("\r\n","\r","\n") , '', $_POST['keywords']);
         $post->post =  $_POST['post'];
         $post->release_date = $_POST['publish_date'].' 9:00:00';
         $post->thumbnail_image_url = $_POST['thumnail_url'];
         $post->enabled = 0;
         $post->permalink = String::clean_for_url($_POST['title'], true);
         $post->save();
         echo $post->id;
       
    }
    
    public function edit_post($id){
        
        global $view;
        $view  = 'edit_post';        
        
        
        
        if(isset ($_POST) and $_POST){
            /* @var $post BlogPost */
         $post = BlogPost::find_by_id($_POST['post_id']);
         $post->title = str_replace(array("\r\n","\r","\n") , '', $_POST['title']);
         $post->description =str_replace(array("\r\n","\r","\n") , '',  $_POST['description']);
         $post->blog_categories_id = $_POST['category'];
         $post->date_created = date("Y-m-d");
         $post->keywords = $_POST['keywords'];
         $post->post = $_POST['post'];
       //  $post->release_date = $_POST['publish_date'].' 9:00:00';
         $post->thumbnail_image_url = $_POST['thumnail_url'];
         $post->enabled = $_POST['enabled'];
         $post->thumbnail_tag = $_POST['thumbnail-tag'];
         
         $post->save();
         
         
         Load::model('tag');
         $terms = explode(',', $post->keywords);
         foreach ($terms as $term){
             Tag::add_tag($term,true);
         }
         Tag::asign_tags_to_post($post->id, $terms);
            
         URL::redirect('admin-posts/browse-posts');
            
        }else{
        
            $post = BlogPost::find_by_id($id);
            $categories = BlogCategory::find_all();
            
            usort($categories,function ( $a, $b )
            { 
              return (mb_strtolower($a->category_name,'UTF-8') < mb_strtolower($b->category_name,'UTF-8')) ? -1 : 1;
            });
            
            Load::assign('post', $post);
            Load::assign('categories', $categories);
        }
        
    }
    
   
    
     
    
    public function delete_post(){
        
        if(isset ($_POST) and $_POST){
            $post = BlogPost::find_by_id($_POST['post_id']);
            $post->enabled = 2;
            $post->save();
      
            URL::redirect('admin-posts/browse-posts');
        }
        
    }
}