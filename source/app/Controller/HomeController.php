<?php
/**
 * Created by PhpStorm.
 * User: JHA
 * Date: 27/4/14
 * Time: 9:49 PM
 */
class HomeController extends AppController {

    /**
     * Controller name
     *
     * @var string
     */
    public $name = 'Home';

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array('Post');

    /**
     * Displays Home Page View
     *
     * @param N/A
     * @return void
     */
    public function index() {
        $this->set('_posts', $this->Post->GetAll(15));
    }
}
