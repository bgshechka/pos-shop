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
	?>  
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
	</script>

	<?php
		
		echo "<table>";

		echo "<tr><td>$productType->name</td></tr>";

		$header = json_decode($productType->properties);

		echo "<tr>";
		echo "<td>id</td>";
		if ($header)
			foreach ($header as $prop) {
				echo "<td>$prop</td>";
			}
		echo "<td>article</td>";
		echo "<td>photo</td>";
		echo "<td>description</td>";
		echo "<td>price</td>";
		echo "</tr>";
		if ($productType)
		{ 
			foreach( $productType->products as $product ) {

				$values = json_decode($product->values_);

				//var_dump($values);

			    echo "<tr>";
			    
				    echo "<td>$product->id</td>";

				    foreach ($values as $value) {
						echo "<td>$value</td>";			    	
				    }

				    echo "<td>$product->article</td>";
				    echo "<td>$product->photo</td>";
				    echo "<td>$product->description</td>";
				    echo "<td>$product->prices</td>";

					// echo "<td>$product->model</td>";
					// echo "<td>$product->format</td>";
					// echo "<td>$product->orientation</td>";
					// echo "<td>$product->thickness</td>";
					// echo "<td>$product->mount</td>";
					// echo "<td>$product->article</td>";
					// echo "<td>$product->price</td>";
					// echo "<td>$product->description</td>";
					// echo "<td>$product->photo</td>";
					// echo "<td>$product->price_number_1</td>";
					// echo "<td>$product->price_number_2</td>";
					// echo "<td>$product->price_number_3</td>";
					// echo "<td>$product->reserved_0</td>";
					// echo "<td>$product->reserved_1</td>";
					// echo "<td>$product->reserved_2</td>";
					// echo "<td>$product->reserved_3</td>";
					// echo "<td>$product->reserved_4</td>";

			    echo "</tr>";
			}

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

		 
		// echo "</table>";

		// echo "<table>";
		// echo "<tr>";
		// 	echo "<td>id</td>";
		// 	echo "<td>name</td>";
		// 	echo "<td>model</td>";
		// 	echo "<td>format</td>";
		// 	echo "<td>orientation</td>";
		// 	echo "<td>thickness</td>";
		// 	echo "<td>mount</td>";
		// 	echo "<td>article</td>";
		// 	echo "<td>price</td>";
		// 	echo "<td>description</td>";
		// 	echo "<td>photo</td>";
		// 	echo "<td>price_number_1</td>";
		// 	echo "<td>price_number_2</td>";
		// 	echo "<td>price_number_3</td>";
		// 	echo "<td>reserved_0</td>";
		// 	echo "<td>reserved_1</td>";
		// 	echo "<td>reserved_2</td>";
		// 	echo "<td>reserved_3</td>";
		// 	echo "<td>reserved_4</td>";
		// echo "</tr>";
		 
		// foreach( $products as $product ) {
		//     echo "<tr>";
		    
		// 	    echo "<td>$product->id</td>";
		// 		echo "<td>$product->name</td>";
		// 		echo "<td>$product->model</td>";
		// 		echo "<td>$product->format</td>";
		// 		echo "<td>$product->orientation</td>";
		// 		echo "<td>$product->thickness</td>";
		// 		echo "<td>$product->mount</td>";
		// 		echo "<td>$product->article</td>";
		// 		echo "<td>$product->price</td>";
		// 		echo "<td>$product->description</td>";
		// 		echo "<td>$product->photo</td>";
		// 		echo "<td>$product->price_number_1</td>";
		// 		echo "<td>$product->price_number_2</td>";
		// 		echo "<td>$product->price_number_3</td>";
		// 		echo "<td>$product->reserved_0</td>";
		// 		echo "<td>$product->reserved_1</td>";
		// 		echo "<td>$product->reserved_2</td>";
		// 		echo "<td>$product->reserved_3</td>";
		// 		echo "<td>$product->reserved_4</td>";

		//     echo "</tr>";
		// }
		 
		// echo "</table>";

	?>
</body>
</html>

