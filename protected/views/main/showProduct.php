<div class="mainWrapper-showProduct">
	
			<?php 
				$header = json_decode($productType->properties);
				
			?>
			<h1><?=$productType->name;?></h1>

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
					$priceInfos = array(); // массив с ценами и интервалами для передачи в js
					foreach( $productType->products as $product ) {
						
						$priceInfo = array(
							'intervals'=>json_decode($product->price_intervals),
							'prices'=>json_decode($product->prices)
							);
						array_push($priceInfos, $priceInfo);
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
									<input type="text" id="productCount-<?=$i?>" class="productCount" value="1">
									<span>шт. </span>
									<p class="positionPrice"></p>
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

	var priceInfos = JSON.parse('<?=json_encode($priceInfos) ?>');
	
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
					targets: [ 5 ],  
					//className: "description",
					orderable: "false",
				},
				{   //столбец с ценами
					targets: [ 6 ],  
					width: "195px",
				},
				{   //столбец в корзину
					targets: [ 7 ],  
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

$('.productCount').keyup(function(){
	var i = $(this).attr('id').substring(13);
	console.log(priceInfos[i]);
});


$('.to-cart').click(function(){
	var i = $(this).attr('id').substring(8);
	console.log(priceInfos[i]);
});


} );
</script>