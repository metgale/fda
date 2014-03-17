<?php

App::uses('AppController', 'Controller');

/**
 * Indications Controller
 *
 * @property Indication $Indications

 */
class ReactionsController extends AppController {

    public function index() {
        if ($this->request->is('post')) {
            debug($this->request->data('drug'));
            die;
            $options = array(
                'conditions' => array(
                    'Reaction.isr' => 5846196
                )
            );
            $reactions = $this->Reaction->find('all', $options);
            $this->set('reactions', $reactions);
            debug($reactions);
        }
    }

}
