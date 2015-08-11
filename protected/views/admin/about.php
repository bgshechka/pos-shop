<h2>Текст "о нас" </h2>
<hr>
<div id="alert_placeholder">
</div>
<textarea id="aboutTextarea"><?=$aboutPage->text?></textarea>	
<br>
<button type="button" id="save-about" class="btn btn-primary">Сохранить</button>

<script type="text/javascript">
$( document ).ready(function() {
	$('#about-nav-item').addClass('active');

	CKEDITOR.replace('aboutTextarea', {
		height: 500,
	});

	$('#save-about').click(function(){
		<? $url=$this->createUrl("admin/changeAboutPageAjax"); ?>
		$.post(
            "<?= $url ?>",
            {
            	text:CKEDITOR.instances.aboutTextarea.getData(), 
            },
            onSaveAboutAjaxSuccess
        ); 
	});

	function onSaveAboutAjaxSuccess(data)
	{
		if (data!=false) bootstrapAlert('Сохранено!');
		else alert('Ошибка сохранения.')
	}

	function alertTimeout(wait){
	    setTimeout(function(){
	        $('#alert_placeholder').children('.alert:first-child').remove();
	    }, wait);
	}

	function bootstrapAlert(message) {
	    $('#alert_placeholder').append('<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert">&times;</button><h4>Info!</h4>'+ message +'</div>').hide().fadeIn(500);
	    alertTimeout(5000);
	}

});
</script>