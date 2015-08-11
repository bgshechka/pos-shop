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

	
   <script src="/js/bootstrap.min.js"></script>
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
				            <!-- <li id="news-nav-item"><a href="<?=$url?>">Новости</a></li> -->
				            <li id="news-nav-item"><a href="#" data-toggle="collapse" data-target="#news-nav-items-list">Новости</a>
				            <? $newsInfos = $this->getNewsInfoForNavs();  ?>
				            <ul id="news-nav-items-list" class="nav nav-pills nav-stacked collapse" style="padding-left:5px;">
				            	<? foreach ($newsInfos as $newsInfo) { ?>
					            	<li><a href="<?= $newsInfo['url'] ?>"><?= $newsInfo['title'] ?></a></li>
					            <? } ?>
					         </ul>
				            <? $url=$this->createUrl("admin/about"); ?>
				            <li id="about-nav-item"><a href="<?=$url?>">Текст "о нас"</a></li>
							</ul>
						</div>
						<div class="col-md-3">
						</div>
					</div>
          	</div>
          <div class="col-md-8 cl-md-offset-1">
          	<div id="alert_placeholder">
				</div>
          	<?php echo $content; ?>
          </div>
        </div>

    </div><!-- /.container -->
	<div id="footer">
	</div>
</body>
</html>