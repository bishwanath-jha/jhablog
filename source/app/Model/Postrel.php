<?php

App::uses('Model', 'AppModel');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @author : Bishwanath Jha <bishwanathkj@gmail.com>
 *
 * @package       Post.Model
 */
class Postrel extends AppModel {
    public $name = 'Postrel';
    public $useTable = 'postrels';
    public $primaryKey = 'postrel_id';

    /**
     * Category and Tag Function
     * Return all tag and category based on post id
     * 
     * @param: int $postId
     * @return mixed on success or false on fail
     * @author: Bishwanath Jha <bishwanathkj@gmail.com>
     * @access: Public
     * @since: 30-April-2013
     */
    public function GetTagAndCategoryByPostId ($postId) {
        if(empty ($postId) || !is_int($postId)) {
            return false;
        }
        
        $param['joins'] = array(array('table' => 'terms', 
                                       'alias' => 'term', 
                                       'type' => 'LEFT', 
                                       'conditions' => array(' postrel.term_id = term.term_id '))
                                     );
        $param['fields'] = array( 'postrel.term_id', 'term.title', 'term.name', 'term.type', 'term.term_id');
        $param['conditions'] = array('postrel.post_id' => intval($postId));
        $terms = $this->find('all', $param);
        
        $finalTerms = array();
        foreach ($terms as $key => $value) {
            if($value['term']['type'] == 'tag') {
                $finalTerms['tag'][$value['term']['name']] = $value['term']['title'];
            } else {
                $finalTerms['category'][$value['term']['name']] = $value['term']['title'];
            }
        }
        return $finalTerms;
    }
    
    /**
     * Get Category and Tag
     * Return all tag and category based on post ID Array
     * 
     * @param: int $postId
     * @return mixed on success or false on fail
     * @author: Bishwanath Jha <bishwanathkj@gmail.com>
     * @access: Public
     * @since: 15-May-2013
     */
    function GetTagAndCategory ($postIds) {
        if(empty ($postIds)) {
            return false;
        }
        
        $param['joins'] = array(array('table' => 'terms', 
                                       'alias' => 'term', 
                                       'type' => 'LEFT', 
                                       'conditions' => array(' postrel.term_id = term.term_id '))
                                     );
        $param['fields'] = array( 'postrel.term_id', 'postrel.post_id', 'term.title', 'term.name', 'term.type', 'term.term_id');
        $param['conditions'] = array('postrel.post_id IN ('. BuildIN($postIds, 'true').')');
        $terms = $this->find('all', $param);
        
        $finalTerms = array();
        foreach ($terms as $key => $value) {
            if($value['term']['type'] == 'tag') {
                $finalTerms[$value['postrel']['post_id']]['tag'][$value['term']['title']] = $value['term']['name'];
            } elseif ($value['term']['type'] == 'category'){
                $finalTerms[$value['postrel']['post_id']]['category'][$value['term']['title']] = $value['term']['name'];
            }
        }
        return $finalTerms;
    }
}
