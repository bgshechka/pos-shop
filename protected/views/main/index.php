<script>
	jQuery(document).ready(function ($) {

     $(".rslides").responsiveSlides({
	  auto: true,             // Boolean: Animate automatically, true or false
	  speed: 500,            // Integer: Speed of the transition, in milliseconds
	  timeout: 4000,          // Integer: Time between slide transitions, in milliseconds
	  pager: false,           // Boolean: Show pager, true or false
	  nav: false,             // Boolean: Show navigation, true or false
	  random: false,          // Boolean: Randomize the order of the slides, true or false
	  pause: false,           // Boolean: Pause on hover, true or false
	  pauseControls: true,    // Boolean: Pause when hovering controls, true or false
	  prevText: "Previous",   // String: Text for the "previous" button
	  nextText: "Next",       // String: Text for the "next" button
	  maxwidth: "",           // Integer: Max-width of the slideshow, in pixels
	  navContainer: "",       // Selector: Where controls should be appended to, default is after the 'ul'
	  manualControls: "",     // Selector: Declare custom pager navigation
	  namespace: "rslides",   // String: Change the default namespace used
	  before: function(){},   // Function: Before callback
	  after: function(){}     // Function: After callback
	});
  
   });
</script>

	<ul class="rslides">
	  <li><img src="/images/main-slide-res1.jpg" alt=""></li>
	  <li><img src="/images/main-slide-res2.jpg" alt=""></li>
	</ul>
	
	<p class="index-about">Рекламная Мастерская «Доминанта» занимается  серийным и мелкотиражным производством изделий из оргстекла.</p>

	<p class="index-about">Мы используем современное лазерное, фрезерное  и термогибочное оборудование. Техническая база собственного производства и наших партнеров 
	 позволяет нам производить широкий ассортимент изделий из таких материалов,  как разноцветный акрил, полистирол, ПВХ, композит, литой поликарбонат, ПЭТ. 
	 Мы работаем с многочисленными видами материала, чтобы создавать нужное сочетание в изделиях для наших клиентах.</p>

	 <p class="index-about">Так у нас вы можете приобрести подставки под товары, держатели меню, буклетницы, пластиковые карманы, визитницы, короба для голосования,
	 горки, коробки под чеки, ценникодержатели и многое другое. </p>

	<div class="mainWrapper-index">
		<div class="main">
			<ul class="products">

				<?
				foreach ($products as $product)
				{

					$url=$this->createUrl("main/showProduct",array("id"=>$product->id));
				?>
				<li><a href="<?= $url ?>">
						<div class="product-thumbnail-container">
							 <span class="pt-container-helper"></span><img src="<?=$product->products[0]->photo?>" alt="">
						</div>
						<span class="product-name"><?=$product->name ?></span>
						<div class="button button-product-position button-invisible">КУПИТЬ</div>
					</a>
				</li>
				<?
				}
				?>
			</ul>
		</div>
	</div>

<!--
<script type="text/javascript">
	$(document).ready(function(){
        $('.slider').glide({
        autoplay: 5000,
        arrows: 'body',
        arrowRightText: '',
        arrowLeftText: '',
        navigation: ''
    });
	})
</script>
-->