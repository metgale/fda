<?php

App::uses('AppShell', 'Console/Command');

class ImportShell extends AppShell {

    public $uses = array('Indication');

    public function main() {
        $this->out('Indication');
        $this->dirs();
    }

    public function dirs() {
        $files = glob(TMP . 'do\*.{TXT}', GLOB_BRACE);
        foreach ($files as $file) {
            $this->parser($file);
        }
    }

    public function parser($file) {
        $data = file($file);
        $columns = array(
            'ISR',
            'DRUG_SEQ',
            'INDI_PT',
        );
       
        unset($data[0]);

        $chunks = array_chunk($data, 100);
        foreach ($chunks as $chunk) {
            $rows = array();
            foreach ($chunk as $line) {
                $rows[] = array_combine($columns, explode('$', $line));
            }
            $this->Indication->saveAll($rows, array('validate' => false, 'callbacks' => false, 'counterCache' => false));
            $this->out('.');
        }
    }

    public function count($file) {
        $linecount = 0;
        $handle = fopen($file, "r");
        while (!feof($handle)) {
            $line = fgets($handle);
            $linecount++;
        }
        fclose($handle);
        $fp = fopen(TMP . 'test.txt', 'a+');
        fwrite($fp, PHP_EOL . $linecount);
        fclose($fp);
    }

}
