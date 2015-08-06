<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<title></title>
</head>
<body>

	<div>
		<!--? $url=$this->createUrl("uploadFile/create"); ?>
		<a href="<?= $url ?>" class="navLink">upload</a-->

		<!--? $url=$this->createUrl("test/addXLS"); ?>
		<a href="<?= $url ?>" class="navLink">!!!Add to DB test.xls!!!</a-->
		<!--form name="upload">
			<input type="file" name="myfile">
    		<input type="submit" value="Загрузить" id="loadPriceBtn">	
		</form-->

		<button class="UploadButton" id="UploadButton">UploadFile</button>

		<!--form class="UploadButton" id="UploadButton">UploadFile</form-->

		<div id="loadStatus"></div>
		
	</div>

	<?php 
		Yii::app()->clientScript->registerCoreScript('jquery');
		Yii::app()->clientScript->registerCoreScript('ajaxupload');
		Yii::app()->clientScript->registerCoreScript('datatables');
		
		Yii::app()->clientScript->registerCoreScript('datatables');
		$header = json_decode($productType->properties);
	?>  

	<table id="productTable">
		<tr>
			<td> <? echo $productType->name; ?></td>
		</tr>
		<tr>
			<td>id</td>
			<?php 
				if ($header)
					foreach ($header as $prop) {
			?>
				<td><? echo $prop ?> </td>
			<? } ?>
			
			<td>article</td>
			<td>photo</td>
			<td>description</td>
			<td>price</td>
		</tr>

	<?php		
		if ($productType)
		{ 
			foreach( $productType->products as $product ) {

				$values = json_decode($product->values_);
	?>
		<tr>			    
			<td><? echo $product->id ?></td>
			<?php
			    foreach ($values as $value) {
			?>
			<td><? echo $value ?></td>			    	
			<?  }  ?>

			<td><? echo $product->article ?></td>
			<td><? echo $product->photo ?></td>
			<td><? echo $product->description ?></td>
			<td><? echo $product->prices ?></td>

		</tr>
	<?	} ?>

	<?
			echo "<tr>";
			echo "</tr>";

			echo "<tr>";
				$tmp = json_decode($productType->values_);
				foreach ($tmp as $prop)
				{
					foreach ($prop as $val)
					{
						echo "<td>";
						echo "$val";
						echo "</td>";
					}
				}
			echo "</tr>";

		}		 

	?>

	</table>

	<script type="text/javascript">
		$("#UploadButton").ajaxUpload({
			<? $url = $this->createUrl('test/loadPriceAjax'); ?>
			url : "<?=$url?>",
			name: "file",
			onSubmit: function(input) {
				//alert(input);

				//debugger;
				$('#loadStatus').html('Загрузка файла... ');
			},
			onComplete: function(fileName) {
				//загрузка файла прошла успешно, передаем в action контролера название файла
				<? $url = $this->createUrl('test/importPriceAjax'); ?>
				$.post(
					"<?= $url?>",
					{
						fileName:fileName,
						
					},
					onImportPriceAjaxSuccess
				);
				
				 $('#loadStatus').html('Файл загружен : ' + fileName);
			}
		});

		/* вызовется после получения ответа от ImportPriceAjax */
		function onImportPriceAjaxSuccess(data)
		{
			console.log(data);
			$('#loadStatus').html('Файл загружен : ' + data);
			//<? $url = $this->createUrl('test/index'); ?>
			//$.post("<?= $url?>");

		}

		$(document).ready(function() {
    		$('#productTable').DataTable();
		} );
				
	</script>

</body>
</html>

