<?php

class UploadFile extends CFormModel {
    public $upfile;
    // другие свойства
 
    public function rules(){
        return array(
            
            array('upfile', 'file', 'types'=>'xls'),
        );
    }
}

?>