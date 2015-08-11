<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Продукция POS - ДОМИНАНТА</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<link rel="stylesheet" type="text/css" href="/css/style.css">
	<link type="text/css"  rel="stylesheet" href="/smslider/css/smslider.css" />
	<link type="image/x-icon" href="/images/dominanta_favicon.ico" rel="shortcut icon">
	<!--
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	-->
	<script type="text/javascript" src="./smslider/jquery.smslider.min.js"></script>

	<script src="js/jquery.glide.min.js"></script>
	<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<style type="text/css">
#header-cart-count-wrap {

}

#header-cart-count {
	border: 1px solid red;
	width: 18px;
	height: 18px;
	float: right;
}

</style>
<body class="about">
	<div class="Wrapper">
		<div class="navWrapper">
			<a href="/" title="Доминанта">
				<div class="logo"></div>
			</a>
			<ul class="mainNav">
				<? $url=$this->createUrl("main/products"); ?>
				<li><a href="<?= $url ?>" class="navLink">Продукция</a></li>
				<? $url=$this->createUrl("main/contacts"); ?>
			    <li><a href="<?= $url ?>" class="navLink">Где купить</a></li>
			    <? $url=$this->createUrl("main/about"); ?>
			    <li><a href="<?= $url ?>" class="navLink">О нас</a></li>
			    <? $url=$this->createUrl("main/news"); ?>
			    <li><a href="<?= $url ?>" class="navLink">Новости</a></li>
			    <? $url=$this->createUrl("main/form"); ?>
			    <li><a href="<?= $url ?>" class="navLink">Обратная связь</a></li>
			    <? $url=$this->createUrl("main/cart"); ?>
			    <? 
			    	$cart = new EShoppingCart;
					$cart->init();
					$c=$cart->getItemsCount();
					
					if ($c>0) $cartCount .= ' ('.$c.')';
				?>
			    <li><a href="<?= $url ?>" class="navLink">Корзина <span id="cartCount"><?=$cartCount?></span></a></li>
			</ul>

			<div class="header-contacts">
				<a href="tel:+73517298883"><div class="index-contacts index-phone"></div>8.351.729.88.83</a><br>
	    		<div class="index-contacts index-adress"></div><span class="adress">г.Челябинск, ул. Свободы, 22</22span>
			</div>
		</div>

		<?php echo $content; ?>
	<div class="footer">


	<div class="footer-contacts">
		<div class="footer-contacts-left">
	    	<a href="tel:+73517298883"><div class="index-contacts index-phone"></div>8.351.729.88.83</a><br>
	    	<a href=""><div class="index-contacts index-adress"></div>г.Челябинск, ул. Свободы, 22</a>
		</div>

		<div class="footer-contacts-right">
			<a href="mailto:mail@dominanta.ru"><div class="index-contacts index-mail"></div>mail@dominanta.ru</a><br>
			<a href="http://dominans.ru" target="_blank"><div class="index-contacts index-www"></div>dominans.ru</a><br>
			<a href="http://vk.com/rm_dominanta" target="_blank"><div class="index-contacts index-vk"></div>rm_dominanta</a><br>
		</div>
	</div>

			<a href="/" title="Доминанта">
				<img src="images/nav_logo.png" alt="" class="footer-logo">
			</a>

	</div>
		</div>

</body>



</html>