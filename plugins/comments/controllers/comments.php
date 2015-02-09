<?php

class CommentsController extends Controller{
    
    function __construct() {
        global $layout;
        global $view;
        
        $layout = null;        
        $view = null;
    }

    
    public function send_like(){
        
        Load::plugin_model('comments', 'comment');
        
       if(isset ($_POST['id'])){
         
         $comment_id = $_POST['id'];
         
         $comment = Comment::find_by_id($comment_id);
         /* @var $comment Comment */
         
         if(!preg_match('/'.URL::get_real_ip_addr().'/', $comment->ip_addresses)){
             $comment->likes += 1;
             $comment->ip_addresses = "|".URL::get_real_ip_addr();
             $comment->save();
             echo 1;
         }else{
             echo 0;
         }
         
       }
        
    }
    
    public function add_comment(){
        Load::plugin_model('comments', 'comment');
        Load::helper('time_helper');
        
        if(isset ($_POST['comment']) and isset ($_POST['item_id']) and Membership::instance()->user){
            
            $comment = new Comment();
            $comment->comment = String::url_to_anchor(String::plain_text($_POST['comment']));
            $comment->item_id = $_POST['item_id'];
            $comment->url = $_POST['url'];
            $comment->likes = 0;
            $comment->username = Membership::instance()->user->username;
            if(filter_var(Membership::instance()->user->email, FILTER_VALIDATE_EMAIL)){
                $comment->email    = Membership::instance()->user->email;
                //TODO see if the server has a response
            }
            
            $comment->username_avatar = Membership::instance()->user->image_url;
            $comment->date_created = TimeHelper::DateTimeAdjusted();
            
         
            
            if($comment->comment and $comment->comment != ' '){
                
                echo $comment->comment;
                
                $comments = Comment::get_recent_comments_by_id($comment->item_id);
                
                // filter duplicates
                $emails = array();
                foreach ($comments as $c) {
                    if($c->email){
                        $emails[] = $c->email;
                    }
                }
                if(!empty($emails)){
                    $emails = array_unique($emails);
                
                    $title  = 'известување за нов коментар';

                    $body  = "Корисникот '".$comment->username."' , ";
                    $body .= "остави нов коментар на темата:\n".$comment->url;
                    $body .= "\n\n";
                    $body .= "Коментар:\n";
                    $body .= $comment->comment;

                    $query  = " INSERT INTO emails (id,title,content) ";
                    $query .= " VALUES(NULL,'".Model::db()->prep($title)."','".Model::db()->prep($body)."') ";
                    Model::db()->query($query);
                    $email_id = Model::db()->last_inserted_id();
                    
                    $query = " INSERT INTO mailer_queue (id,`from`,`to`,email_id,date_created) VALUES ";
                    $values = array();
                    Load::helper('time_helper');
                    
                    foreach($emails as $email){
                        $values[] = "(NULL,'no-replay@lady.mk','".Model::db()->prep($email)."','".Model::db()->prep($email_id)."','".TimeHelper::DateTimeAdjusted()."')";
                    }
                    $query .= implode(',', $values);
                    Model::db()->query($query);
                }
                
                
                // add to mailer queue
                
                
                
                $comment->save();
            }else{
                echo "you'r comment was not saved";
            }
            
        } else {
            echo 'please login to send comments';
        }
        
        
    }
    
    public function edit_comment(){
        Load::plugin_model('comments', 'comment');
        Comment::edit_comment_by_id($_POST['id'], $_POST['comment']);
    }
    public function delete_comment($id){
        Load::plugin_model('comments', 'comment');
        Comment::delete_comment_by_id($id);
    }
    
    
    
    
}
?>
