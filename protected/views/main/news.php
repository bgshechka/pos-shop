<div class="mainWrapper">
	<div class="main">	
		<h1 class="title_h1">Новости</h1>
		<div class="base">
			<ul class="base-row">
				
				<? foreach ($news as $new) { ?>

				<li class="cell2">
					<? $url=$this->createUrl('main/showNews',array('id'=>$new->id)); ?>
					<a href="<?=$url?>" class="h2-news"><?= $new->title ?></a>
					<div class="content2">
						<p><?= $new->preview ?>	</p>						
					</div>
				</li>	

				<? } ?>
				<!--
				<li class="cell1">
					<a href="#" class="h2-news">Открытие сайта</a>
					<div class="content1">
						<p>Мы рады представить
							вам наш новый сайт.
							С этого момента он
							начинает радовать вас.
							Заказывайте.
							Пользуйтесь.
							Наслаждайтесь.
						</p>						
					</div>
				</li>
				<li class="cell2">
					<a href="#" class="h2-news">Новые сорта менюхолдеров</a>
					<div class="content2">
						<p>Мы рады представить
							вам наш новый сайт.
							С этого момента он
							начинает радовать вас.
							Заказывайте.
							Пользуйтесь.
							Наслаждайтесь.
						</p>						
					</div>
				</li>
				<li class="cell3">
					<a class="h2-news">Бизнес-бизнесу</a>
					<div class="content3">
						<p>Мы решаем задачи
							наших клиентов, но мы
							гордимся, что часто
							являемся помощником
							наших друзей по труду.
							И тем самым, рады 
							сообщить о скидке
							рекламным агенствам
							нашего города.
						</p>						
					</div>
				</li>
				<li class="cell1">
					<a href="#" class="h2-news">Наружка + POS</a>
					<div class="content4">
						<p>При заказе световых
							букв в нашей мастерской
							вы получаете 10% скидку
							на наши POS материалы.
							Пусть буквы светят и
							отражаются в наших
							прозрачных изделиях.
						</p>						
					</div>
				</li>
				-->
			</ul>
		</div>
		<div class="news-arrow">
			<i class="news_prev"></i>
			<i class="news_next"></i>
		</div>
	</div>
</div>