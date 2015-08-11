<div class="mainWrapper-showProduct">
	
			<?php 
				$header = json_decode($productType->properties);
				
			?>

			<h1 class="productTitle"><?=$productType->name;?></h1>

			<table id="productTable" class="display">
			<thead>	
				<tr>
					<td></td> <!-- фото -->
					<td></td> <!-- артикул -->

					<?php 
						if ($header)
						{
							foreach ($header as $prop)
							{
					?>
								<td><? echo $prop ?> </td>
						<?  }  ?>							
					<?
						} 
					?>
					
					<td></td> <!-- описание -->
					<td></td> <!-- цена -->
					<td></td>  <!-- в корзину -->
				</tr>
			</thead>
			<tbody>
			<?php		
				if ($productType)
				{ 
					$i=0;
					$productInfos = array(); // массив с информацие о позиции для передачи в js
					foreach( $productType->products as $product ) {
						
						$productInfo = array(
							'intervals'=>json_decode($product->price_intervals),
							'prices'=>json_decode($product->prices),
							'name' => $productType->name,
							'article' => $product->article,
							'attributes' => $product->getAttributesString($productType),
							'name' => $productType->name,
							'productId' => $product->id,
							);


						//var_dump($product->getAttributesString($productType));
						array_push($productInfos, $productInfo);
						$values = json_decode($product->values_);
			?>
						<tr>
							<td><img src="<?='./images/mini/'.$product->photo?>" alt="" class="mini-image"></td>
							<td><? echo $product->article ?></td>			    
							<?php
							    foreach ($values as $value) {
							?>
									<td><? echo $value ?></td>			    	
							<?  }  ?>
							<td><p class="description"><? echo $product->description ?></p></td>
							<td><? echo $product->getPriceString() ?></td>
							<td>
								<div id="positionPriceWrap-<?=$i?>" >
									<input type="text" id="positionCount-<?=$i?>" class="positionCount" value="1">
									<span>шт. </span>
									<p class="positionPrice" id="positionPrice-<?=$i?>"></p>
								</div>
								<p id="to-cart-<?=$i?>" class="to-cart">в корзину</p>
							</td>
						</tr>
			<?
						$i++;
				}
				}	
			?>

			
			</tbody>
			<tfoot>
				<tr>
					<th></th>
					<th>article</th>

					<?php 
						if ($header)
						{
							foreach ($header as $prop)
							{
					?>
								<th><? echo $prop ?> </th>
						<?  }  ?>							
					<?
						} 
					?>
					
					<th></th>
					<th>price</th>
					<th></th>  <!-- в корзину -->
				</tr>
			</tfoot>		
			</table>
			

			
		
	
</div>

<div id="podlogka"></div>
<div id="success_window">
    <h2 class="title_h1">Спасибо!</h2>
    <p>Товар был добавлен в корзину.</p>
    <p>Благодарим за покупку.</p>
    <br>
    <div id="close_success_window" class="button button-contact-us">Ок</div>
</div>

<script type="text/javascript">
$(document).ready(function() {

	var productInfos = JSON.parse('<?=json_encode($productInfos) ?>');

	$('.positionPrice').each(function(i,elem) {

		var positionNum = $(this).attr('id').substring(14);
		var count = $('#positionCount-'+positionNum).val();
		$(this).text(calculatePositionPrice(count,positionNum) + 'р.');
	});

	
	
   $('#productTable').dataTable({
   			dom:"t",
		    sPlaceHolder : 'head:before',
		    // aoColumnDefs: [ 
		    // 	{
		    // 		"aTargets": [ 0, -3, -1 ],
		    // 		"bSortable": false
		    // 	},
		    // 	{
		    // 		"aTargets": [ -3 ],
		    // 		"sClass": "description",
		    // 	},

		    // ],

		    columnDefs: [
		 
				{   //столбец с описанием
					targets: [ -3 ],  
					//className: "description",
					orderable: "false",
				},
				{   //столбец с ценами
					targets: [ -2 ],  
					width: "195px",
				},
				{   //столбец в корзину
					targets: [ -1 ],  
					width: "70px",
				}

			],

		    


		})
   		.columnFilter({
   			sPlaceHolder: "head:before",
   			aoColumns: 
   			[
   				null,
   				null,
   				//variable columns 
   				<?=$stringVariableColumns ?>

   				null,
   				null,
   				null
   			]
		}
		);

	$('.description').jTruncate({ 
					length: 100, 
					minTrail: 0, 
					moreText: "[читать дальше]", 
					lessText: "[спрятать]", 
					//ellipsisText: " (обрезано)", 
					moreAni: "fast", 
					lessAni: "fast"
					});

	$('.positionCount').keyup(function(){
		var positionNum = $(this).attr('id').substring(14);



		$('#positionPrice-'+positionNum).text(calculatePositionPrice($(this).val(),positionNum) + 'р.');
		
	});

	function calculatePositionPrice(count,positionNum)
	{

		var positionPrice;
		for (var i=0;i<productInfos[positionNum]['intervals'].length;i++)
		{
			if (count<=productInfos[positionNum]['intervals'][i] || productInfos[positionNum]['intervals'][i]==-1)
			{
				positionPrice = count*productInfos[positionNum]['prices'][i];
				break;
			}
		}

		return positionPrice;
	}


	$('.to-cart').click(function(){
		var positionNum = $(this).attr('id').substring(8);
		

		<? $url = $this->createUrl("main/tocart"); ?>
		var date = new Date();
		$.post(
		  "<?= $url ?>",
		  {
		    name: productInfos[positionNum]['name'],
		    attributes: productInfos[positionNum]['attributes'],
		    count: parseInt($("#positionCount-"+positionNum).val()),
		    prices: productInfos[positionNum]['prices'],
		    intervals:productInfos[positionNum]['intervals'],
		    priceForThisCount: calculatePositionPrice($("#positionCount-"+positionNum).val(),positionNum),
		    productId:productInfos[positionNum]['productId'],
		    article:productInfos[positionNum]['article'],
		    id: date.getTime()
		  },
		  onToCartAjaxSuccess
		);
	});


	function onToCartAjaxSuccess(data)
	{
	  // Здесь мы получаем данные, отправленные сервером и выводим их на экран.
	  $("#cartCount").html(" (" + data + ")");
	  $("#success_window").show();
       $("#podlogka").show();
	}

	$("#close_success_window").click(function(){
        $("#success_window").hide();
        $("#podlogka").hide();
    });

	

} );
</script>