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

		Yii::app()->clientScript->registerCssFile('/css/jquery.dataTables.min.css');
		$header = json_decode($productType->properties);
	?>  
	<? echo $productType->name; ?>
	<table id="productTable" class="display">
	<thead>	
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
	</thead>
	<tbody>
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
	<?
		}
		}	
	?>

	
	</tbody>		
	</table>


	<table id="test-table">
		<thead>
			<th>t1</th>
			<th>t1</th>
		</thead>
		<tbody>
			<tr>
				<td>1</td>
				<td>2</td>
			</tr>
			<tr>
				<td>1</td>
				<td>2</td>
			</tr>
		</tbody>
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

