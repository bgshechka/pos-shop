<?php

Yii::import('application.extensions.*');
require_once('simpleImage/simpleImage.php');

class AdminController extends Controller
{


	public $layout='/layouts/admin';
	public $defaultAction = 'products';
	// public function filters()
 //    {
 //        return array(
 //            'accessControl',
 //        );
 //    }
    
	// public function accessRules()
 //    {
 //        return array(
            
 //             array('allow', // allow authenticated users to perform any action
	//             'users'=>array('@'),
	// 	        ),
	//         array('deny',  // deny all users
	//             'users'=>array('*'),
	//         	),
 //        );
 //    }



	public function actionProducts()
	{
		// $products = Products::model()->findAll();
		// $aboutPage = Pages::model()->find('type=:type',array(':type'=>'about'));
		// $news = Pages::model()->findAll('type=:type',array(':type'=>'news'));
		// $firstNews = $news[0];

		// $newsInfo = array();
		// foreach ($news as $new)
		// {
		// 	$tmpInfo = array();
		// 	$tmpInfo['id'] = $new->id;
		// 	$tmpInfo['title'] = $new->title;
		// 	array_push($newsInfo, $tmpInfo);
		// }

		//$cs = Yii::app()->clientScript;
		// $cs->registerCssFile('/css/admin.css');
		//$cs->registerScriptFile('/js/jquery.js');
		// $cs->registerScriptFile('/js/ckeditor/ckeditor.js');
		//$cs->registerScriptFile('/js/ajaxupload.min.js');
		// $cs->registerScriptFile('/js/jquery.jeditable.js');

		// $this->render('index',array('products' => $products,
		// 							'aboutPage' => $aboutPage,
		// 							'firstNews' => $firstNews,
		// 							'newsInfo' => $newsInfo,

		// 	));
		// 	

		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile('/js/jquery.js');
		$cs->registerScriptFile('/js/ckeditor/ckeditor.js');
		$cs->registerScriptFile('/js/ajaxupload.min.js');
		$this->render('products');
	}

	public function actionAbout()
	{
		$aboutPage = Pages::model()->find('type=:type',array(':type'=>'about'));
		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile('/js/jquery.js');
		$cs->registerScriptFile('/js/ckeditor/ckeditor.js');
		$this->render('about',array('aboutPage'=>$aboutPage));
	}

	// public function actionCreateProduct()
	// {
	// 	if ($_POST['name']=='')
	// 	{
	// 		$this->redirect(array('admin/index'));
	// 		return;
	// 	}

	// 	$product = new Products;
	// 	$product->name = $_POST['name'];
	// 	$product->discount = 'i;0';
	// 	$res=$product->save();
	// 	if ($res==false)
	// 	{
	// 		echo "не удалось создать товар.";
	// 		return;
	// 	}

	// 	$this->redirect(array('admin/editProduct','id'=>$product->id));
	// }

	// public function actionDeleteProduct($id)
	// {
	// 	$product = Products::model()->findByPk($id);
	// 	if ($product!=null)
	// 	{
	// 		//удмлим все значения, связанные с текущим атрибутом и сам атрибут
	// 		$attributes_AR = Attributes::model()->findAll("product_id=:product_id",array(':product_id' => $product->id));
	// 		foreach ($attributes_AR as $attribute)
	// 		{
	// 			Values::model()->deleteAll("attribute_id=:attribute_id",array(':attribute_id'=>$attribute->id));
	// 			$attribute->delete();
	// 		}

	// 		$product->delete();
	// 	}
	// 	$this->redirect(array('admin/index'));
	// }

	// public function actionEditProduct($id=1)
	// {
	// 	$product = Products::model()->findByPk($id);

	// 	$attributes = Attributes::model()->findAll('product_id=:product_id',array(':product_id'=>$id));
	// 	$attributes_array = array();
	// 	foreach ($attributes as $attribute)
	// 	{
	// 		$values = Values::model()->findAll(array('condition'=>'attribute_id=:attribute_id',
	// 											 	'params'=>array(':attribute_id'=>$attribute->id),
	// 										     ));

	// 		$values_array = array();
	// 		foreach ($values as $value)
	// 		{
	// 			$tmpValueArray = array();
	// 			$tmpValueArray["name"] = $value->name;
	// 			$tmpValueArray["add_price"] = $value->add_price;
	// 			array_push($values_array, $tmpValueArray);
	// 		}


	// 		$tmpAttributeArray = array();
	// 		$tmpAttributeArray["name"]=$attribute->name;
	// 		$tmpAttributeArray["values"]=$values_array;
			
	// 		array_push($attributes_array, $tmpAttributeArray);
	// 	}

	// 	//скидки
	// 	$dis_split = explode(';',$product->discount);
	// 	$dis_intervals = array();
	// 	$dis_values = array();
	// 	for ($i=0,$k=0;$i<count($dis_split);$i+=2,$k++)
	// 	{
	// 		$dis_intervals[$k] = $dis_split[$i];
	// 		$dis_values[$k] = $dis_split[$i+1];
	// 	}


	// 	$cs = Yii::app()->clientScript;
	// 	$cs->registerCssFile('/css/admin.css');
	// 	$cs->registerScriptFile('/js/jquery.js');
	// 	$cs->registerScriptFile('/js/ajaxupload.min.js');

	// 	$this->render('editProduct',array('product'=>$product,
	// 								      'attributes'=>json_encode($attributes_array),
	// 								      'dis_intervals' => json_encode($dis_intervals),
	// 								      'dis_values' => json_encode($dis_values),
	// 		));
	// }

	public function actionUploadPhotoAjax()
	{
		//echo $_FILES['file']['tmp_name'];
		// copy($_FILES['file']['tmp_name'],'/var/www/aaa1ru/data/www/pos/images/products/'.$_FILES["file"]["name"]);
		
		

		$image = new SimpleImage();
	    $image->load($_FILES['file']['tmp_name']);
	    $image->resizeToWidth(193);
	    $image->save('/var/www/aaa1ru/data/www/pos/images/products/'.$_FILES["file"]["name"]);

	    //$image->save('/images/products/'. $_FILES["file"]["name"]);
		$file = $_FILES['file'];
		//move_uploaded_file($_FILES["file"]["tmp_name"], 'D:\OpenServer\domains\dominanta-pos\images\products\\' . $_FILES["file"]["name"]);
		//var_dump(basename($_FILES["file"]["name"]));
		echo basename($_FILES["file"]["name"]);
		
	}

	public function actionUpdatePhotoAjax()
	{
		$product = Products::model()->findByPk($_POST['productId']);
		$product->photo = "/images/products/".$_POST['filename'];
		$res=$product->save();
		if ($res==false)
		{
			echo "false";
			return;
		}
		echo $product->photo;
	}


	public function actionSaveProduct()
	{
		$product = Products::model()->findByPk($_POST['productId']);
		
		$attributes = json_decode($_POST['attributes']);

        
        //удмлим все значения, связанные с текущим атрибутом и сам атрибут
		$attributes_AR = Attributes::model()->findAll("product_id=:product_id",array(':product_id' => $_POST['productId']));
		foreach ($attributes_AR as $attribute)
		{
			Values::model()->deleteAll("attribute_id=:attribute_id",array(':attribute_id'=>$attribute->id));
			$attribute->delete();
		}

		
		
		foreach ($attributes as $attribute)
		{
			$attribute_AR = new Attributes;
			$attribute_AR->product_id = $product->id;
			$attribute_AR->name = $attribute ->name;

			$res = $attribute_AR->save();
			if ($res==false)
			{
				echo "false-attr";
				return;
			}

			
			foreach ($attribute->values as $value)
			{
				$value_AR = new Values;
				$value_AR->name = $value->name;
				$value_AR->add_price = $value->add_price;
				$value_AR->attribute_id = $attribute_AR->id;

				$res=$value_AR->save();

				if ($res==false)
				{
					echo "false-value";
					return;
				}
			}

		
		}

		$product->discount = $_POST['discount'];
		$product->name = $_POST['name'];
		$product->text = $_POST['text'];

		if ($_POST['photo']!='') $product->photo = $_POST['photo'];
		$product->main_price = $_POST['main_price'];
		$product->sostav = $_POST['sostav'];
		$res = $product->update();
		if ($res==false)
		{
			var_dump($product->errors);
			echo "false-prod";
			
			return;
		}
		echo "true";
	}

	public function actionChangeAboutPageAjax()
	{

		$aboutPage = Pages::model()->find('type=:type',array(':type'=>'about'));
		$aboutPage->text = $_POST['text'];
		$res = $aboutPage->update();
		if ($res==false)
		{
			echo 'false';
			return;
		}
		echo 'true';
		
	}

	public function actionGetNewsAjax()
	{
		$news = Pages::model()->findByPk($_POST['id']);

		$newsInfo = array();
		$newsInfo['id'] = $news->id;
		$newsInfo['title'] = $news->title;
		$newsInfo['preview'] = $news->preview;
		$newsInfo['text'] = $news->text;
		$newsInfo['photo'] = $news->photo;

		echo json_encode($newsInfo);
	}

	public function actionUploadNewsPhotoAjax()
	{
		
		
		$image = new SimpleImage();
	    $image->load($_FILES['file']['tmp_name']);
	    $image->resizeToWidth(220);
	    $image->save('/var/www/aaa1ru/data/www/pos/images/news/'.$_FILES["file"]["name"]);

	    //$image->save('/images/products/'. $_FILES["file"]["name"]);
		$file = $_FILES['file'];
		//move_uploaded_file($_FILES["file"]["tmp_name"], 'D:\OpenServer\domains\dominanta-pos\images\products\\' . $_FILES["file"]["name"]);
		//var_dump(basename($_FILES["file"]["name"]));
		echo basename($_FILES["file"]["name"]);
	}

	public function actionSaveNewsAjax()
	{
		$news = Pages::model()->findByPk($_POST['id']);
		$news->title = $_POST['title'];
		$news->preview = $_POST['preview'];
		$news->text = $_POST['text'];
		$news->photo = $_POST['photo'];
		$res=$news->update();
		if ($res==false)
		{
			echo 'false';
			return;
		}
		echo 'true';
	}


function resizeImg($img, $w, $h, $newfilename) {
 
 //Check if GD extension is loaded
 if (!extension_loaded('gd') && !extension_loaded('gd2')) {
  trigger_error("GD is not loaded", E_USER_WARNING);
  return false;
 }
 
 //Get Image size info
 $imgInfo = getimagesize($img);
 switch ($imgInfo[2]) {
  case 1: $im = imagecreatefromgif($img); break;
  case 2: $im = imagecreatefromjpeg($img);  break;
  case 3: $im = imagecreatefrompng($img); break;
  default:  trigger_error('Unsupported filetype!', E_USER_WARNING);  break;
 }
 
 //If image dimension is smaller, do not resize
 if ($imgInfo[0] <= $w && $imgInfo[1] <= $h) {
  $nHeight = $imgInfo[1];
  $nWidth = $imgInfo[0];
 }else{
                //yeah, resize it, but keep it proportional
  if ($w/$imgInfo[0] > $h/$imgInfo[1]) {
   $nWidth = $w;
   $nHeight = $imgInfo[1]*($w/$imgInfo[0]);
  }else{
   $nWidth = $imgInfo[0]*($h/$imgInfo[1]);
   $nHeight = $h;
  }
 }
 $nWidth = round($nWidth);
 $nHeight = round($nHeight);
 
 $newImg = imagecreatetruecolor($nWidth, $nHeight);
 
 /* Check if this image is PNG or GIF, then set if Transparent*/  
 if(($imgInfo[2] == 1) OR ($imgInfo[2]==3)){
  imagealphablending($newImg, false);
  imagesavealpha($newImg,true);
  $transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
  imagefilledrectangle($newImg, 0, 0, $nWidth, $nHeight, $transparent);
 }
 imagecopyresampled($newImg, $im, 0, 0, 0, 0, $nWidth, $nHeight, $imgInfo[0], $imgInfo[1]);
 
 //Generate the file, and rename it to $newfilename
 switch ($imgInfo[2]) {
  case 1: imagegif($newImg,$newfilename); break;
  case 2: imagejpeg($newImg,$newfilename);  break;
  case 3: imagepng($newImg,$newfilename); break;
  default:  trigger_error('Failed resize image!', E_USER_WARNING);  break;
 }
   
   return $newfilename;
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


	public function actionTrades()
	{
		$trades = Trades::model()->findAll();

		Yii::app()->clientScript->registerCoreScript('jquery');
		Yii::app()->clientScript->registerCoreScript('ajaxupload');
		Yii::app()->clientScript->registerCoreScript('datatables');
		Yii::app()->clientScript->registerCoreScript('jTruncate');

		Yii::app()->clientScript->registerCssFile('/css/jquery.dataTables.min.css');

		$this->render('trades', array('trades'=>$trades));		
	}
}