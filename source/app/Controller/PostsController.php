<?php
/**
 * Created by PhpStorm.
 * User: JHA
 * Date: 3/5/14
 * Time: 1:02 PM
 */
class PostsController extends AppController {

    /**
     * Controller name
     *
     * @var string
     */
    public $name = 'Posts';

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array('Post', 'Term');

    /**
     * Displays Home Page View
     *
     * @param N/A
     * @return void
     */
    public function admin_manage() {
    }

    public function admin_create() {
        $this->set('categories', $this->Term->GetAllCategories());
        $this->set('tags', $this->Term->GetTags());
        $this->set('title_for_layout', 'JhaBlog\'s : Bishwanath');
    }

    public function admin_update() {

    }
}
