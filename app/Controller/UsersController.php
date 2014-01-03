<?php

class UsersController extends AppController {


    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');


    public function index() {

        $this->layout = 'seokin'; //loads seokin default layout

    	$this->set( 'users', $this->User->find('all') );


    }

    // public function view( $id = null ) {

    //     $this->layout = 'seokin'; //loads seokin default layout

    //     if (!$id) {
    //         throw new NotFoundException(__('Invalid post'));
    //     }

    //     $post = $this->Post->findById($id);

    //     if (!$post) {
    //         throw new NotFoundException(__('Invalid post'));
    //     }
    //     $this->set('post', $post);
    // }


}