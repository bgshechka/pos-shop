$("#loadPriceBtn").ajaxUpload({
	<? $url = $this->createUrl('main/loadPriceAjax') ?>
	url : "<?=$url?>",
	name: "file",
	onSubmit: function() {
	$('#loadStatus').html('Загрузка файла... ');
	},
	onComplete: function(fileName) {

		//загрузка файла прошла успешно, передаем в action контролера название файла
		<? $url = $this->createUrl("main/importPriceAjax"); ?>
		$.post(
			"<?= $url ?>",
			{
				fileName:fileName,
				
			},
			onImportPriceAjaxSuccess
		);
	}
	});

/* вызовется после получения ответа от ImportPriceAjax */
function onImportPriceAjaxSuccess(data)
{
	alert(data);
}