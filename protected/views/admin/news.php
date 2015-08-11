<h2>Редактирование новости</h2>
<hr>

<input type="text" id="newsTitle" class="form-control" value="<?=$news->title?>">
<br>
<h3>Текст новости:</h3>
<textarea id="newsText"><?=$news->text?></textarea>	
<br>
<h3>Краткое содержание:</h3>
<br>
<textarea id="newsPreview"><?=$news->preview?></textarea>
<br>
<h3>Изображение <span id="upload-news-photo">загрузить</span></h3> 
<div id="photo-wrapper">
	<span class="label">Фото:</span>
	<img src="<?=$news->photo?>" id="newsPhoto">
	
	<span id="upload-news-photo-info"></span>
</div>

<br>	
<button type="button" id="save-news" class="btn btn-primary">Сохранить</button>

<script type="text/javascript">
$( document ).ready(function() {
	$('#news-nav-item').addClass('active');
	$('#news-nav-items-list').removeClass('collapse');

	CKEDITOR.replace('newsText', {
		height: 300,
	});

	CKEDITOR.replace('newsPreview', {
		height: 200,
	});

	
	//загрузка ФОТО для новости
	//
	$("#upload-news-photo").ajaxUpload({
    <? $url = $this->createUrl('admin/uploadNewsPhotoAjax') ?>
    url : "<?=$url?>",
    name: "file",
    newsId: $("#newsSelect").val(),
    onSubmit: function() {
        $('#upload-news-photo-info').html('Загрузка... ');
    },
    onComplete: function(result) {

        bootstrapAlert('Файл загружен');
        
        photo_filename = "/images/news/" + result;
        console.log(photo_filename);
        $('#newsPhoto').attr('src',photo_filename);
        
    }
    });

    //
    // СОХРАНИТЬ НОВОСТЬ
    //

    $("#save-news").click(function(){
    	<? $url=$this->createUrl("admin/saveNewsAjax"); ?>
		$.post(
            "<?= $url ?>",
            {
            	id:<?=$news->id ?>,
            	title:$("#newsTitle").val(),
            	preview:CKEDITOR.instances.newsPreview.getData(),
            	text:CKEDITOR.instances.newsText.getData(), 
            	photo:$('#newsPhoto').attr('src'),
            },
            onSaveNewsAjaxSuccess
        ); 
	});

	function onSaveNewsAjaxSuccess(data)
	{
		if (data!=false) alertSuccess('Сохранено!');
		else alertDanger('Ошибка сохранения.')
	}

	function alertTimeout(wait){
	    setTimeout(function(){
	        $('#alert_placeholder').children('.alert:first-child').remove();
	    }, wait);
	}

	function alertSuccess(message) {
	    $('#alert_placeholder').append('<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert">&times;</button><h4>'+ message +'</h4></div>').hide().fadeIn(500);
	    alertTimeout(2000);
	}

	function alertDanger(message) {
	    $('#alert_placeholder').append('<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert">&times;</button><h4>'+ message +'</h4></div>').hide().fadeIn(500);
	    alertTimeout(2000);
	}

});
</script>