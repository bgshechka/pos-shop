<h2>Загрузить excel-файл каталога</h2>
<hr>
<!--button type="button" class="btn btn-primary" id="btn">Загрузить</button-->
<button class="UploadButton" id="UploadButton">UploadFile</button>
<div id="loadStatus"></div>

<script type="text/javascript">
	$( document ).ready(function() {
		$('#products-nav-item').addClass('active');

	});

	//btn btn-primary

	$("#UploadButton").ajaxUpload({
			<? $url = $this->createUrl('admin/loadPriceAjax'); ?>
			url : "<?=$url?>",
			name: "file",
			onSubmit: function(input) {
				//alert(input);

				//debugger;
				$('#loadStatus').html('Загрузка файла... ');
			},
			onComplete: function(fileName) {
				//загрузка файла прошла успешно, передаем в action контролера название файла
				<? $url = $this->createUrl('admin/importPriceAjax'); ?>
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