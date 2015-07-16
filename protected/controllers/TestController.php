<?php

class TestController extends Controller
{
	public function actionIndex($id = 1)
	{

		//$criteria = new CDbCriteria;
		
		$productType= ProductTypes::model()->with('products')->findByPk($id);

		//$this->actionAddXLS('./upload_dir/test.xls');
		$this->render('index', array( 'productType' => $productType ));
	}

	public function addXLS($file_path)
	{
		//$file_path = './upload_dir/test.xls';
		$sheet_array = Yii::app()->yexcel->readActiveSheet($file_path);

		$current_product = null;

		foreach ($sheet_array as $row)
		{

			if ( $this->isRowEmpty($row) )
			{
				continue;
			}

			if ($row['A'] != null && $row['B'] != null )
			{
				continue;
			}

			if ($row['A'] != null)
			{
				$current_product = ProductTypes::model()->findByAttributes( array('name' => $row['A']) );
				if (!$current_product)
				{
					$current_product = new ProductTypes;
					
				}
				
				$current_product->name = $row['A'];
				$properties = '[';
				foreach ($row as $cell) 
				{
					if ($cell != null && $cell != $row['A'])
						$properties = "{$properties}\"{$cell}\",";
				}
				$properties[strlen($properties) - 1] = ']';
				
				$current_product->properties = $properties;

				$objValues = json_decode($current_product->values_);
				if (!$objValues)
				{
					$objValues = array();
					$propCount = substr_count($current_product->properties, '","') + 1;
					for ($i = 0; $i < $propCount; $i++)
					{
						$objValues[$i] = array();
					}
				}
				$current_product->values_ = json_encode($objValues);
			
				$current_product->save();

				continue;
			}

			if (!$current_product)
				continue;

			//$cell = $row['B'];
			$product = Products::model()->findByAttributes(array('article' => $row['B']));
			if (!$product)
				$product = new Products;
			
			$product->type_id = $current_product->id;
			
			$product->article = $row['B'];
			//$cell = next($row);
			
			$product->description = $row['C'];
			//$cell = next($row);

			$product->prices = "[\"{$row['D']}\";\"{$row['E']}\";\"{$row['F']}\"]";

			$values = '[';		
			//$cell = $row['F'];
			//while ($cell = next($row))
						
			$objValues = json_decode($current_product->values_, true);

			$i = 'H';
			$nProp = 0;
			$isChanged = false;

			while($row[$i])
			{
				$values = "{$values}\"{$row[$i]}\",";

				if ( (is_array($objValues[$nProp]) && !in_array(strtolower($row[$i]), array_map('strtolower', $objValues[$nProp]))) ||
					 (!is_array($objValues[$nProp]) && $row[$i] != $objValues[$nProp]) )
				{
					$objValues[$nProp][] = $row[$i];
					$isChanged = true;
				}

				$i++; 
				$nProp++;
			}
			$values[strlen($values) - 1] = ']';
			$product->values_ = $values;

			if ($isChanged)
			{
				$current_product->values_ = json_encode($objValues, JSON_UNESCAPED_UNICODE);
				$current_product->save();
			}

			$product->save();

		};

		//$this->actionIndex();
	}

	// // public function getRecords($dbModel, $attributes)
	// {
	// 	$records = "$dbModel"::model()->findByAttributes($attributes);
	// 	if (!$records)
	// 		$records = new $dbModel;
	// 	return $records;
	// }

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
		{
			Yii::log("file : $fileName");
			echo "Всё ОК";
		}



		$this->addXLS($fileName);
	}

}
?>