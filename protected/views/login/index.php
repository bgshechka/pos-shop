<?
$url=$this->createUrl("login/index");


?>

<style type="text/css">

#login-form-wrapper {
	padding: 20px;
	border: 1px solid #ccc;
	border-radius: 5px;
	margin:0 auto;
	margin-top: 10%;
	width:300px;
	height: 150px;
}

</style>

<div id="login-form-wrapper">
<?if ($error!=null) echo $error;?>
<form action='<?=$url ?>' method="post">
	<p>
		<div style="width:70px;float:left;">Login: </div>
		<input name='username' type='text' >
	</p>
	<p>
		<div style="width:70px;float:left;">Password: </div>
		<input name='password' type='password'>
	</p>
	<p><input type="submit" value='Login'></p>
</form>
</div>