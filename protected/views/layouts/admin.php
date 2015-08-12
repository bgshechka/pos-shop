<html lang="en">
<head>
	<!-- шаблон взят отсюда: http://code.jonathanbriehl.com/demos/bootstrap-vertical-menu/# -->
	<meta charset="UTF-8">
	<title>Доминанта POS-продукция</title>
	<link type="image/x-icon" href="/images/dominanta_favicon.ico" rel="shortcut icon">
	<link href="/css/bootstrap/bootstrap.css" rel="stylesheet">
	<link href="/css/bootstrap/bootstrap-theme.css" rel="stylesheet">
	<link href="/css/admin.css" rel="stylesheet">
	<!-- <link href="/css/bootstrap/vertical-nav.css" rel="stylesheet"> -->
	<!-- <link href="/css/bootstrap/non-responsive.css" rel="stylesheet"> -->

	
  
</head>
<body>

	<div class="container">
    	<!-- <div class="row">
        	<div class="col-md-12"></div>
      </div>     -->

		<div class="row">
			<div class="col-md-3 ">
				<p class="nav-title">POS - администрирование</p>
					<div class="row">
		           	<div class="col-md-9">
			         	<ul class="nav nav-pills nav-stacked">
				            <? $url=$this->createUrl("admin/products"); ?>
							   <li id="products-nav-item"><a href="<?=$url?>">Продукция</a></li>
							   <? $url=$this->createUrl("admin/news"); ?>
				            <li id="news-nav-item"><a href="<?=$url?>">Новости</a></li>
				            <? $url=$this->createUrl("admin/about"); ?>
				            <li id="about-nav-item"><a href="<?=$url?>">Текст "о нас"</a></li>
							</ul>
						</div>
						<div class="col-md-3">
						</div>
					</div>
          	</div>
          <div class="col-md-8 cl-md-offset-1">
          	
          	<?php echo $content; ?>
          </div>
        </div>

    </div><!-- /.container -->
	
</body>
<script src="/js/bootstrap.min.js"></script>
</html>