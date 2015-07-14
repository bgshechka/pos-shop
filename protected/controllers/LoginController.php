<?php

class LoginController extends Controller
{
	public $layout='/layouts/admin';

	public function actionIndex()
	{
		$error;
		if (isset($_POST))
		{
			if (isset($_POST['username']) && isset($_POST['password']))

			{

				$identity=new UserIdentity($_POST['username'],$_POST['password']);
				if($identity->authenticate())
				{
				    Yii::app()->user->login($identity);
				   
				    Yii::app()->request->redirect($this->createUrl("admin/index"));
				}
				else
				    $error = 'login or passwor incorrect!';
			}
		}

		$this->render('index',array('error'=>$error));
	}

}