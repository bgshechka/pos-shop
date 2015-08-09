<div class="mainWrapper-showProduct">
	
			<?php 
				$header = json_decode($productType->properties);
				
			?>
			<h1><?=$productType->name;?></h1>

			<table id="productTable" class="display">
			<thead>	
				<tr>
					<td>photo</td>
					<td>article</td>

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
					
					<td>description</td>
					<td>price</td>
					<td></td>  <!-- в корзину -->
				</tr>
			</thead>
			<tbody>
			<?php		
				if ($productType)
				{ 
					foreach( $productType->products as $product ) {

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
							<td><? echo $product->description ?></td>
							<td><? echo $product->getPriceString() ?></td>
							<td><p >в корзину</p></td>
						</tr>
			<?
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
			

			<div id="to_cart" class="button_cart-product">В корзину</div>
		
	
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


   $('#productTable').dataTable({
		    sPlaceHolder : 'head:before',
		    "aoColumnDefs": [ 
		    	{
		    		"aTargets": [ 0, -3, -1 ],
		    		"bSortable": false
		    	},
		    	{
		    		"aTargets": [ -3 ],
		    		"sClass": "description",
		    	},

		    ],

		    "fnDrawCallback": function( oSettings ){
  				$('.description').jTruncate({ 
					length: 100, 
					minTrail: 0, 
					moreText: "[читать дальше]", 
					lessText: "[спрятать]", 
					//ellipsisText: " (обрезано)", 
					moreAni: "fast", 
					lessAni: "fast"
					});
  			}
		})
   		.columnFilter({

   			aoColumns: 
   			[
   				null,
   				{ type: "text" },
   				//variable columns 
   				<?=$stringVariableColumns ?>

   				null,
   				{ type: "text" },
   				null
   			]
		}
		);


} );

</script>