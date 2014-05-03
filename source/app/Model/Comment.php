<?php
/**
 * Application model for Cake.
 * Comment Model
 */
App::uses('Model', 'AppModel');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @author : Bishwanath Jha <bishwanathkj@gmail.com>
 *
 * @package       Comment.Model
 */
class Comment extends AppModel {
    public $name = 'Comment';
    public $useTable = 'comments';

    public $primaryKey = 'comment_id';
    
    const STATUS_PENDING  = -1;
    const STATUS_REJECT   = 0;
    const STATUS_APPROVED = 1;
    const STATUS_TRASH    = 2;
    
    
    public function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);
    }

    public function GetUnreadCount () {
        $commentCount = $this->find('count', array('conditions' => 'status = 1'));
        return $commentCount;
    }
    
    public function GetPostComment ($postId) {
        if(empty ($postId)) {
            return false;
        }
        $commentParam = array( 'fields'     => array('comment.author_name', 'comment.content', 'comment.date', 'comment.user_id'),
                               'conditions' => array('comment.post_id' => $postId, 'comment.status' => 1));
        $comments = $this->find('all', $commentParam);
        return $comments;
    }
    
    public function GetAllComment () {
        $param = $comments = array();
        
        $param['order'] =  array(' date DESC ');
        $param['fields'] = array('posts.post_title', 'posts.post_name', 'comment.comment_id', 'comment.author_name', 'comment.content', 'comment.date', 'comment.user_id',
                                   'comment.author_email', 'comment.author_url', 'comment.author_ip','comment.status', 'comment.post_id' );
        $param['joins'] = array( array('table' => 'posts', 
                                      'alias' => 'posts', 
                                      'type' => 'LEFT', 
                                      'conditions' => array(' comment.post_id =  posts.post_id')
                                    ));
        $data = $this->find('all', $param);
        
        foreach ($data as $key => $value) {
            $comments[$value['comment']['comment_id']] = array_merge($value['comment'],$value['posts'] ); 
        }
        return $comments;
    }
    
    public function UpdateStatus ($type, $id) {
        if($type == self::STATUS_APPROVED) {
            return $this->updateAll(array('status' => self::STATUS_APPROVED), array('comment_id' => intval($id)));
        } else if($type == self::STATUS_REJECT) {
            return $this->updateAll(array('status' => self::STATUS_REJECT), array('comment_id' => intval($id)));
        } else if($type == self::STATUS_TRASH) {
            return $this->updateAll(array('status' => self::STATUS_TRASH), array('comment_id' => intval($id)));
        }     
   }
   
}
