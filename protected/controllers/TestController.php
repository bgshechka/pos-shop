<?php

class TestController extends Controller
{
	public function actionIndex($id = 1)
	{

		//$criteria = new CDbCriteria;
		
		$productType= ProductTypes::model()->with('products')->findByPk($id);

		$this->render('index', array( 'productType' => $productType ));
	}

	public function actionAddXLS()
	{
		$file_path = './upload_dir/test.xls';
		$sheet_array = Yii::app()->yexcel->readActiveSheet($file_path);

		foreach ($sheet_array as $row)
		{

			if ( $this->isRowEmpty($row) )
			{
				continue;
			}

			$product = new NewProducts;
			$product->name = $row['B'];
			$product->model = $row['C'];
			$product->format = $row['D'];
			$product->orientation = $row['E'];
			$product->thickness = $row['F'];
			$product->mount = $row['G'];
			
			$product->save();

		};

		$this->actionIndex();
	}


	public static function isRowEmpty($row)
	{
	    foreach ($row as $cell) {
	        if ($cell != null) {
	            return false;
	        }
	    }

	    return true;
	}

	public function actionLoadPriceAjax()
	{
		Yii::log("on actionLoadPriceAjax");
		//файл сначала во временную папку сохраняется под именем $_FILES["file"]["tmp_name"]
		//его надо скопировать в нужное место $newFilePath
		$newFilePath = $_SERVER["DOCUMENT_ROOT"].'/upload_dir/'.$_FILES["file"]["name"]; //в эту переиенную можно абсолютный путь указать до файла c:\opensever\...
		$res=move_uploaded_file($_FILES["file"]["tmp_name"], $newFilePath);
		echo $newFilePath;	
	}

	public function actionImportPriceAjax()
	{
		//$_POST['filename'] - путь до загруженного файлы
		$fileName = $_POST['fileName'];
		$fileInfo = pathinfo($fileName);
		if ($fileInfo['extension'] != 'xls') 
		{
			echo "Неверный формат файла";
			return;
		}
		else
			echo "Всё ОК";
	}

}
?>