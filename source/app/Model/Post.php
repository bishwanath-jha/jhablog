<?php

App::uses('Model', 'AppModel');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       Post.Model
 *
 * @author : Bishwanath Jha <bishwanathkj@gmail.com>
 */
class Post extends AppModel
{
    public $name = 'Post';
    public $useTable = 'posts';
    public $primaryKey = 'post_id';

    const DEFAULT_POST_LIMIT = 10;

    const POST_PUBLISHED = 1;
    const POST_UNPUBLISHED = 2;

    /**
     * First n latest post to display on home page
     *
     * @param int $limit
     * @return array
     *
     * @since: 10-May-2013
     */
    public function GetAll($limit = self::DEFAULT_POST_LIMIT)
    {
        $param = array();
        $param['conditions'] = array(' post_status = ' . self::POST_PUBLISHED);
        $param['order'] = array(' post_date DESC ');
        $param['limit'] = $limit;
        $posts = $this->find('all', $param);

        $results = array();
        foreach ($posts as $postid => $post) {
            $results[$postid] = $post['post'];
        }
        return $results;
    }

    /**
     * Get post on post title
     *
     * @param: String $name
     *
     * @return array
     *
     * @since: 10-May-2013
     */
    public function GetOnName($postName)
    {
        if (empty ($postName)) {
            return false;
        }
        $postParam = array('conditions' => array('post.post_name' => $postName));
        $postData = $this->find('first', $postParam);
        return $postData;
    }

    /**
     * Get posts on category
     *
     * @param $name
     *
     * @throws InvalidArgumentException
     * @return array
     *
     * @since: 10-May-2013
     */
    // @todo :  need to work on this
    public function GetOnCategory($name)
    {
        if (empty ($name)) {
            throw new InvalidArgumentException('Invalid Argument provided.');
        }

        $param['joins'] = array(array('table' => 'postrels',
            'alias' => 'postrel',
            'type' => 'LEFT',
            'conditions' => array(' term.term_id =  postrel.term_id')),
            array('table' => 'posts',
                'alias' => 'post',
                'type' => 'LEFT',
                'conditions' => array(' postrel.post_id =  post.post_id AND post_status = 1'))
        );

        $param['fields'] = array('post.post_id', 'post.post_title', 'post.post_name', 'post.post_date',
                                 'term.title', 'term.name', 'term.type', 'term.description');
        $param['conditions'] = array("term.name = '" . $name . "' AND term.type = '" . Term::TYPE_CATEGORY . "' ");

        $posts = array();
        foreach ($this->find('all', $param) as $value) {
            $posts[$value['post']['post_id']] = array_merge($value['post'], $value['term']);
        }
        return $posts;
    }


    /**
     * Get posts on tags
     *
     * @param $name
     *
     * @throws InvalidArgumentException
     * @return array
     *
     * @since: 10-May-2013
     */
    public function GetOnTag($name)
    {
        if (empty ($name)) {
            throw new InvalidArgumentException('Invalid Argument provided.');
        }

        $param['joins'] = array(array('table' => 'postrels',
            'alias' => 'postrel',
            'type' => 'LEFT',
            'conditions' => array(' term.term_id =  postrel.term_id')),
            array('table' => 'posts',
                'alias' => 'post',
                'type' => 'LEFT',
                'conditions' => array(' postrel.post_id =  post.post_id AND post_status=1'))
        );
        $param['fields'] = array('post.post_id', 'post.post_title', 'post.post_name', 'post.post_date', 'term.title', 'term.name', 'term.type');
        $param['conditions'] = array("term.name ='$tagName' AND term.type='tag'");

        $posts = array();
        foreach ($this->find('all', $param) as $key => $value) {
            $posts[$value['post']['post_id']] = array_merge($value['post'], $value['term']);
        }
        return $posts;

    }

    public function Search($text)
    {
    }

}
