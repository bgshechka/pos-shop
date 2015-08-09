<?php

class MainController extends Controller
{
	public $layout='/layouts/main';
	public $cart;


	public function actionTest()
	{
		// $tests = Test::model()->findAll();
		// $names="";
		// foreach ($tests as $test)
	 //    {
	 //   	  $names=$names.$test->name."</br>";
	 //    }	
	 //        $this->render("test",array("names"=>$names));
	 //        
		$new = new Test;
		$new->name ="imya";
		$new->text="rrrr";
		$new->save();
		
	}

	public function actionIndex()
	{
		//$products = Products::model()->findAll();

		$products = ProductTypes::model()->with('products')->findAll();

		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile('/js/jquery.js');
		$cs->registerScriptFile('/js/responsiveslides.min.js');
		$this->render('index',array('products' => $products));
	}

	public function actionProducts()
	{
		$products = Products::model()->findAll();
		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile('/js/jquery.js');

		$this->render('products',array('products' => $products));
	}


	public function actionContacts()
	{
		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile('/js/jquery.js');

		$this->render('contacts');
	}

	public function actionAbout()
	{
		$aboutPage = Pages::model()->find('type=:type',array(':type'=>'about'));

		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile('/js/jquery.js');

		$this->render('about',array('aboutPage' => $aboutPage));
	}

	public function actionNews()
	{
		$news = Pages::model()->findAll('type=:type',array(':type'=>'news'));

		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile('/js/jquery.js');
		
		$this->render('news',array('news'=>$news));
	}

	public function actionShowNews($id)
	{
		$news = Pages::model()->findByPk($id);

		$this->render('showNews',array('news'=>$news));
	}

	public function actionForm()
	{
		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile('/js/jquery.js');
		$this->render('form');
	}

	/*
	public function actionSendMessage()
	{		
		$model = new ContactForm();
		$model->attributes=$_POST['ContactForm'];

		$text="Сообщение с сайта: Отправил: $model->name";
		$this->render('succesMessage');
	}
	*/

	public function actionAnswerFormSend()
	{
		$text = "Пользователь ".$_POST["name"]." оставил сообщение на сайте!\r\n";
		$text =$text."Email: ".$_POST["email"]."\r\n\r\n";
		$text = $text.$_POST["text"];
		mail("bkmz120@gmail.com","Dominanta: Новое сообщение!",$text);
	}

	

	public function actionShowProduct($id=1)
	{

		$productType= ProductTypes::model()->with('products')->findByPk($id);
		$productType->products[0]->getPriceString();

		Yii::app()->clientScript->registerCoreScript('jquery');
		Yii::app()->clientScript->registerCoreScript('ajaxupload');
		Yii::app()->clientScript->registerCoreScript('datatables');
		Yii::app()->clientScript->registerCoreScript('datatablesColumnFilter');
		Yii::app()->clientScript->registerCoreScript('jTruncate');

		Yii::app()->clientScript->registerCssFile('/css/jquery.dataTables.min.css');
		
		$this->render('showProduct', array( 'productType' => $productType ));
		
	}

	public function actionToCart()
	{
		//var_dump($_POST['name']);
		$product = Products::model()->findByPk($_POST['id']);

		$productInCart =  new ProductInCart();
	
		$productInCart->name = $_POST['name'];
		$productInCart->attributes = $_POST['attributes'];
		$productInCart->count = $_POST['count'];
		$productInCart->priceForOne = $_POST['price'];
		$productInCart->discount = $_POST['discount'];
		$productInCart->productId = $_POST['productId'];

		$productInCart->id = $_POST['id'];
		
		$cart = new EShoppingCart;
		$cart->init();
		$cart->put($productInCart);
		$c=$cart->getItemsCount();
		echo $c;
	}

	public function actionCart()
	{
		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile('/js/jquery.js');
		$cs->registerScriptFile('/js/ajaxupload.min.js');


		$cart = new EShoppingCart;
		$cart->init();
		$this->render("cart",array("cart"=>$cart));
	}

	public function actionDeletePosition($id)
	{
		$cart = new EShoppingCart;
		$cart->init();
		$cart->remove($id);
		$this->redirect(array('main/cart'));
	}

	public function actionUpdatePositionCount()
	{
		

		$cart = new EShoppingCart;
		$cart->init();
		$positions = $cart->getPositions();

		//расчёт новой скидки (соответствующей новому количеству)
		$product = Products::model()->findByPk($positions[$_POST['positionId']]->productId);
		$dis_split = explode(';',$product->discount);
		$dis_intervals = array();
		$dis_values = array();
		for ($i=0,$k=0;$i<count($dis_split);$i+=2,$k++)
		{
			$dis_intervals[$k] = $dis_split[$i];
			$dis_values[$k] = $dis_split[$i+1];
		}
		$dis_interval_num = count($dis_intervals) - 1;
		for ($i=0;$i<count($dis_intervals);$i++)
		{
			if ($dis_intervals[$i]!='i' && $_POST['newCount']<= $dis_intervals[$i] )
			{
				$dis_interval_num = $i;
				break;
			}
		}
		$discount = $dis_values[$dis_interval_num];


		$cart->updateCount($positions[$_POST['positionId']],$_POST['newCount'],$discount);
        // updateCount - пересчитывет к томе же priceForOne

		$totalPrice = 0;
		foreach ($positions as $position)
		{
			$totalPrice+=round($position->count*$position->priceForOne * (1 - $position->discount/100),0);
		}

		$positionPrice = round($positions[$_POST['positionId']]->priceForOne * $_POST['newCount'] * (1 - $position->discount/100),0);
		
		$return = array();
		$return["discount"] = $discount;
		$return["totalPrice"] = $totalPrice;
		$return["positionPrice"] = $positionPrice;
		$return["priceForOne"] = $positions[$_POST['positionId']]->priceForOne;
		echo json_encode($return);
	}

	public function actionSwitchDostavka()
	{
		$cart = new EShoppingCart;
		$cart->init();
		if ($_POST['dostavka']=="on")
		{
			$productInCart =  new ProductInCart();
			$productInCart->name = $_POST['Доставка'];
			$productInCart->id = 100;
			$productInCart->count = 1;
			$productInCart->priceForOne = 200;
			$cart->put($productInCart);
		}
		else
		{
			$cart->remove(100);
		}

		$totalPrice = 0;
		$positions = $cart->getPositions();
		foreach ($positions as $position)
		{
			$totalPrice+=round($position->count*$position->priceForOne * (1 - $position->discount/100),0);
		}
		echo $totalPrice;
	}

	public function actionUploadRekvizitAjax()
	{
		// $image = new SimpleImage();
	 //    $image->load($_FILES['file']['tmp_name']);
	 //    $image->resizeToWidth(193);
	 //    $image->save('/var/www/aaa1ru/data/www/pos/images/products/'.$_FILES["file"]["name"]);

	    //$image->save('/images/products/'. $_FILES["file"]["name"]);
		$file = $_FILES['file'];
		//copy($_FILES["file"]["tmp_name"], '/var/www/aaa1ru/data/www/pos/rekviziti/'.$_FILES["file"]["name"]);
		//var_dump(basename($_FILES["file"]["name"]));
		echo basename($_FILES["file"]["name"]);
		
	}

	//оформление заказа
	public function actionTradeSubmit()
	{
		$cart = new EShoppingCart;
		$cart->init();
		$positions = $cart->getPositions();
		$tradeInfo = "";
		foreach ($positions as $position)
		{	
			if ($position->id!=100) //если это не доставка
			$tradeInfo=$tradeInfo.$position->name."  ".$position->attributes."   -".$position->count."шт  (цена за шт.:".$position->priceForOne."р.)  :".$position->count*$position->priceForOne."р.\r\n";
		}


		$trade = new Trades;
		$trade->name = $_POST["name"];
		$trade->phone= $_POST["phone"];
		$trade->email = $_POST["email"];
		$trade->address = $_POST["address"];
		$trade->paymentType = $_POST["paymentType"];
		$trade->tradeInfo = $tradeInfo;
		$trade->date = new CDbExpression('NOW()');
		$trade->totalPrice = $_POST["totalPrice"];

		$res=$trade->save();
		if ($res==false)
		{
			echo "error";
			return;
		} 

		$message = "Поступила новвый заказ!\r\n\r\n"."Номер заказа: ".$trade->id."\r\n\r\n".$tradeInfo."\r\n\r\n";
		$message = $message."Доставка";
		if ($_POST["address"]=="") $message=$message.":\r\nсамовывоз";
		else $message=$message." +200р.\r\nАдрес:".$_POST["address"];

		$message=$message."\r\n\r\nИтого: ".$_POST["totalPrice"]."р.";

		if ($_POST["paymentType"]=="nal") $message=$message."\r\n\r\nОплата наличными.";
		else $message=$message."\r\n\r\nОплата онлайн.";
		$message=$message."\r\n\r\nКонтакты:\r\nИмя:".$_POST["name"]."\r\nТелефон:".$_POST["phone"]."\r\nEmail:".$_POST["email"];

		mail ("bkmz120@gmail.com","Dominanta:Поступила новвый заказ!",$message);
		echo $trade->id;
	}



	/*
	public function actionCartCount()
	{
		$cart = new EShoppingCart;
		$cart->init();
		echo $cart->getItemsCount();
	}

	/*
	public function actionShowProductType($productType_id)
	{
		//$productType= productTypes::model()->f
		$cr = new CDbCriteria;
		$cr->condition="id=:productType_id";
		$cr->params= array(':productType_id'=>$productType_id);
		
		$cr->select('size');
		$colors=Product::model()->findAll($cr);

	}
	*/


	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}