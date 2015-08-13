
<table id='tableTrades' class='display'>
	<thead>
		<tr>
			<td>Дата</td>
			<td>Описание</td>
			<td>ФИО</td>
			<td>Телефон</td>
			<td>e-mail</td>
			<td>Адрес</td>
			<td>Комментарий</td>
			<td>Тип оплаты</td>
			<td>Сумма</td>
		</tr>
	</thead>
	<tbody>
	<?php
		if ($trades)
		{
			foreach($trades as $trade)
			{
	?>
				<tr>
					<td><?=$trade->date ?></td>
					<td><?=$trade->tradeInfo ?></td>
					<td><?=$trade->name ?></td>
					<td><?=$trade->phone ?></td>
					<td><?=$trade->email ?></td>
					<td><?=$trade->address ?></td>
					<td><?=$trade->comment ?></td>
					<td><?=$trade->paymentType ?></td>
					<td><?=$trade->totalPrice ?></td>
				</tr>
	<?			
			}
		}
	?>	
	</tbody>
	<tfoot>
		
	</tfoot>
</table>

<script type="text/javascript">
	$( document ).ready( function(){
		$('#trades-nav-item').addClass('active');

		$('#tableTrades').DataTable({
			//dom:"t",
		    sPlaceHolder : 'head:before',
		    aoColumnDefs: [ 
		    	{
		    		"aTargets": [ "_all" ],
		    		"sClass": "trunk",
		    	},

		    ],
		});

		$('.trunk').jTruncate({ 
					length: 100, 
					minTrail: 0, 
					moreText: "[читать дальше]", 
					lessText: "[спрятать]", 
					//ellipsisText: " (обрезано)", 
					moreAni: "fast", 
					lessAni: "fast"
					});
	});
</script>