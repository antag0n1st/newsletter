<?php
/**
 * @property BlogCategory $category 
 */
class BlogController extends Controller{
    
    private $category;
    
    function __construct() {
        parent::__construct();
       
       Load::plugin_model('blog', 'blog_post');
       Load::plugin_model('blog', 'blog_category');
               
    }
        
    public function main($page = 1){
        
        if($page == 1 and $_GET['params'] == '1'){
            URL::redirect($_GET['cat']);
        }
        
        global $_active_page_;
        $_active_page_ = $_GET['cat'];
        $category =  BlogCategory::find_by_name($_GET['cat']);
        
        $category = $category ? $category : new BlogCategory();
        
        $grouped = BlogCategory::find_grouped($category->id);
        $grouped_ids = array();
        foreach($grouped as $catt){
            $grouped_ids[] = $catt->id;
        }
        
        
        Load::helper('paginator');
        $paginator = new Paginator(BlogPost::count_by_category($grouped_ids), $page, 8,$category->latin_name.'/');
        
        
        $posts = BlogPost::find_all($paginator, array(), $grouped_ids, false);
        
      
        
        $duplicate_page = '';
            if($page > 1){
                $duplicate_page = ' - Страна '.$page;
            }
        
        Head::instance()->title = $category->title.' '.$duplicate_page;
        Head::instance()->description = $category->description.' '.$duplicate_page;
        Head::instance()->keywords = $category->keywords;
        
        Load::assign('posts', $posts);
        Load::assign('category',$category);
        Load::assign('paginator', $paginator);
    }
    
    
    public function single($id = 1){
        /* @var $post BlogPost */
        $post = BlogPost::find_by_id($id);
        
        
        
        if(!$post){
            URL::redirect('access-denied');
        }
        
        $post->add_count($id);
        
       // Load::plugin_model('comments', 'comment');
        
       // if($this->category->id == 4){
            $user = new User();
            $user->user_id = $post->author;
            $user->LoadUserFromId();
            Load::assign('author', $user);
      //  }
        
        
        $comments = Comments::get_recent_comments_by_id($post->id.'_post');
        
       
        $related_posts = BlogPost::find_related($post->blog_categories_id,5,false,array($post->id));
        
        Head::instance()->title = $post->title;
        Head::instance()->description = str_replace(array('\'','"'), '', $post->description);
        Head::instance()->keywords = $post->keywords;
        
        $category =  BlogCategory::find_by_id($post->blog_categories_id);
        
        Head::instance()->add_fb_meta_tags($post->title,
                    str_replace(array('\'','"'), '', $post->description),
                    URL::abs($post->permalink.'/'.$post->id),
                    URL::abs('public/uploads/large-thumbnails/'.$post->thumbnail_image_url),BASE_URL,'article');
        
        Load::assign('related_posts', $related_posts);
        Load::assign('post', $post);
        Load::assign('comments', $comments);
        Load::assign('category', $category);
        
        global $_active_page_;
        $_active_page_ = $category ? $category->latin_name : null;
        
    }
}