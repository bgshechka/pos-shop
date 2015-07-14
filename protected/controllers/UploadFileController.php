<?php

class UploadFileController extends CController {
    public function actionCreate(){
        $model = new UploadFile;
        if(isset($_POST['UploadFile'])){
            $model->attributes = $_POST['UploadFile'];
            $model->upfile = CUploadedFile::getInstance($model,'upfile');
            //if($model->saveAs()) {
                $path = Yii::getPathOfAlias('webroot').'/upload/'.$model->upfile->getName();
                $model->upfile->saveAs($path);
                // перенаправляем на страницу, где выводим сообщение об
                // успешной загрузке
                
                $this->render('uploadOk', array());
            //}
        }
        $this->render('index', array('uploadFile' => $model));
    }
}

?>