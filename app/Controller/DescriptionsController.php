<?php

class DescriptionsController extends AppController {

    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');

    public function index() {

        $this->set('descs', $this->Description->find('all'));

    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Description->create();
            if ($this->Description->save($this->request->data)) {
                $this->Session->setFlash(__('Your job description has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your job description.'));
        }
    }


}