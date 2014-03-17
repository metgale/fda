<?php

class Drug extends AppModel {

    public $actsAs = array('Containable');
    public $primaryKey = 'ISR';
    public $hasMany = array(
        'Reaction' => array(
            'className' => 'Reaction',
            'foreignKey' => 'isr',
        ),
        'Outcome' => array(
            'className' => 'Outcome',
            'foreignKey' => 'isr'
        ),
        'Indication' => array(
            'className' => 'Indication',
            'foreignKey' => 'isr'
        ),
        'Information' => array(
            'className' => 'Information',
            'foreignKey' => 'isr'
        ),
        
    );

}
