<ul class="tabNavigation">
        <li><a class="" href="#first">Редактор товров</a></li>
        <li><a class="" href="#second">О нас</a></li>
        <li><a class="" href="#third">Новости</a></li>
</ul>


<div id="tab-wrapper">
	<div id="first">
		<div id="product-edit-wrpapper">
			<h1 style="color:#5B5A5A">РЕДАКТИРОВАНИЕ ТОВАРОВ</h1>
			<br>
			<br>
			<table>
				<?
				foreach ($products as $product)
				{
					$url = $this->createUrl("admin/editProduct",array('id'=>$product->id));
					echo "<tr>";
					echo "<td style=\"padding-right:20px;\"> $product->name </td>";
					echo "<td><a href=\"$url\"> редактировать </a></td>";
					$url = $this->createUrl("admin/deleteProduct",array('id'=>$product->id));
					echo "<td><a href=\"$url\"> удалить </a></td>";
					echo "</tr>";
				}
				?>

			</table>
			<p>Добавить товар:</p>
			<? $url=$this->createUrl("admin/createProduct"); ?>
			<form action="<?=$url ?>" method="post">
				<input type="text" placeholder="Название товара" name="name">
				<input type="submit" value="Добавить">
			</form>
			<br>
			<br>
		</div>
	</div>

	<div id="second">
		<div id="about-edit-wrapper">
			<H1 style="color:#5B5A5A">ТЕКСТ "О НАС"</h1>
			<br>
			<br>
			
			<textarea id="aboutTextarea"><?=$aboutPage->text?></textarea>	

			<input id="save-about" type="submit" value="Сохранить">
			<br>
			<br>
		</div>
	</div>

	<div id="third">
		<div id="news-edit-wrapper">
			<H1 style="color:#5B5A5A">НОВОСТИ</h1>
			<br>
			<br>
			<select id="newsSelect"  size="10">
		    	<? foreach ($newsInfo as $oneInfo) { ?>
		    	<option value="<?= $oneInfo['id'] ?>"><?= $oneInfo['title'] ?></option>
				<? } ?>
		    </select>
			<br>
		    <br>
			<p>Загаловок:</p>
			<input type="text" id="newsTitle" value="<?= $firstNews->title ?>" >
			<br>
			<br>
			<p>Краткое содержание:</p>
			<textarea id="newsPreview"></textarea>
			<br>
			<br>
			<p>Текст:</p>
			<textarea id="newsText"></textarea>
			<br>
			<br>
			<div id="photo-wrapper">
		        <span class="label">Фото:</span>
		        <?
		        echo CHtml::image($firstNews->photo, '' ,array('id'=>'newsPhoto'));
		        ?>
		        <span id="upload-news-photo">Загрузить</span>
		        <span id="upload-news-photo-info"></span>
		    </div>
		    <br>
		    <br>
		    
		    <input id="save-news" type="submit" value="Сохранить">
		</div>
	</div>
</div>

<script type="text/javascript">
$( document ).ready(function() {

	CKEDITOR.replace('aboutTextarea');
	CKEDITOR.replace('newsPreview');
	CKEDITOR.replace('newsText');

	//CKEDITOR.instances.newsPreview.setData('<? htmlentities($firstNews->preview, ENT_QUOTES) ?>');
	//CKEDITOR.instances.newsText.setData();
	<?//'CKEDITOR.instances.newsPreview.setData('."'".htmlentities("<p>jr</p>", ENT_QUOTES)."');"  ?>

	//
	// СОХРАНИТЬ О НАС
	//
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
		if (data!=false) alert ('Сохранено!');
		else alert('Ошибка сохранения.')
	}

	//
	// ВЫБОР НОВОСТИ
	//

	$("#newsSelect").change(function(){
		<? $url=$this->createUrl("admin/getNewsAjax"); ?>
		$.post(
            "<?= $url ?>",
            {
            	id: $("#newsSelect").val(),
            },
            onGetNewsAjaxSuccess
        ); 
	});

	function onGetNewsAjaxSuccess(data)
	{
		var j_data= JSON.parse(data);

		$("#newsTitle").val(j_data['title']);
		CKEDITOR.instances.newsPreview.setData(j_data['preview']);
		CKEDITOR.instances.newsText.setData(j_data['text']);
		$("#newsPhoto").attr('src',j_data['photo']);
	}

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

        $('#upload-news-photo-info').html('Файл загружен');
        
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
            	id:$("#newsSelect").val(),
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
		if (data!=false) alert ('Сохранено!');
		else alert('Ошибка сохранения.')
	}

	//для табов 
		//
		//
		var tabContainers = $('#tab-wrapper > div');
	    tabContainers.hide().filter(':first').show();
	    
	    $('ul.tabNavigation a').click(function () {
	        tabContainers.hide();
	        tabContainers.filter(this.hash).show();
	        $('ul.tabNavigation a').removeClass('selected');
	        $(this).addClass('selected');
	        return false;
	    }).filter(':first').click();

});
</script>