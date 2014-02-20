<?php

App::uses('AppController', 'Controller');

/**
 * Indications Controller
 *
 * @property Indication $Indications

 */
class IndicationsController extends AppController {

    public function dirs() {
        $this->autoRender = false;
        $files = glob(TMP . 'fda\indications\*.{TXT}', GLOB_BRACE);
        foreach ($files as $file) {
            $this->parser($file);
        }
    }

    public function parser($file) {
        $this->autoRender = false;
        $data = file($file);
        $columns = array('ISR', 'DRUG_SEQ', 'INDI_PT');
        unset($data[0]);
        foreach ($data as $line) {
            $row = array_combine($columns, explode('$', $line));
            $this->Indication->create();
            $this->Indication->save($row);
        }
    }

}
