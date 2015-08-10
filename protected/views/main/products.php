<div class="mainWrapper-index">
		<div class="main">	
			<h1 class="title_h1">Продукция</h1>
			<ul class="products">
				<?
				

				foreach ($productTypes as $productType)
				{

					$url=$this->createUrl("main/showProduct",array("id"=>$productType->id));
				?>
				<li><a href="<?= $url ?>">
						<div class="product-thumbnail-container">
							 <span class="pt-container-helper"></span><img src="/images/<?=$productType->photo?>" alt="">
						</div>
						<span class="product-name"><?=$productType->name ?></span>
						<div class="button button-product-position button-invisible">КУПИТЬ</div>
					</a>
				</li>
				<?
				}
				?>
			</ul>
		</div>
	</div>