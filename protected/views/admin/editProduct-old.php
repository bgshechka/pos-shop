<? $url=$this->createUrl("admin/index");?>
<a id="back-link" href = "<?=$url?>">Назад к списку товаров </a>
<div id="product-info-wrapper">
    <p id="title">ИНФОРМАЦИЯ О ТОВАРЕ</p>
    <div class="label">Название: </div>
    <? echo CHtml::textField('name', $product->name, array()); ?>
    <br>
    <br>
    <span class="label">Описание:</span>
    <? echo CHtml::textArea('text', $product->text, array('class'=>'cart-count')); ?>
    <br>
    <br>
    <span class="label">Состав:</span>
    <? echo CHtml::textField('sostav', $product->sostav, array('class'=>'cart-count')); ?>
    <br>
    <br>
    <span class="label">Основаная цена:</span>
    <? echo CHtml::textField('main_price', $product->main_price, array('class'=>'cart-count')); ?>
    <br>
    <br>
    <div id="photo-wrapper">
        <span class="label">Фото:</span>
        <?
        echo CHtml::image($product->photo, '' ,array('id'=>'product-photo'));
        ?>
        <span id="upload-product-photo">Загрузить</span>
        <span id="upload-product-photo-info"></span>
    </div>
</div>

<div id="attribute-wrapper">
    <p id="title">СВОЙСТВА ТОВАРА</p>
    <div id="inline-wrapper">
    <div id="attributes-block">
        <p>Свойства:</p>
        <br>
        <select id="attributes" size="10">
        </select>
        <div id="up-down-wrapper">
            <img class="img-click" id="attr-up" src="images/up.png">
            <img class="img-click" id="attr-down" src="images/down.png">
        </div>
        <br>
        <br>
        <span class="j-link" id="deleteAtribute"> Удалить свойство</span>
        <br>
        <br>
        <? echo CHtml::textField('newAttribute', '', array('class'=>'cart-count')); ?>
        <span class="j-link" id="addAtribute"> Добавить свойство</span>
    </div>

    <div id="values-block">

        <p>Значения:</p>
        <br>
        <select id="values" size="10">
        </select>
        <div id="up-down-wrapper">
            <img class="img-click" id="val-up" src="images/up.png">
            <img class="img-click" id="val-down" src="images/down.png">
        </div>
        <br>
        <br>
        <span class="j-link" id="deleteValue"> Удалить значение</span>
        <br>
        <br>
        <? echo CHtml::textField('newValue', '', array('class'=>'cart-count')); ?>
        <span class="j-link" id="addValue"> Добавить значение</span>

    </div>

    <div id="add-price-block">
        <p>Добавочная цена</p>
        <br>
        <? echo CHtml::textField('add_price',"", array('class'=>'cart-count')); ?>
    
    </div>
    </div>
</div>



<div id="discount-wraper">
    <p id="title">СКИДКА</p>
    
    <table id="discount-table">
    	<thead>
    		<tr>
    			<th align=left >Количество</th>
    			<th align=left>Скидка</th>
    		</tr>
    	</thead>
    	<tbody>
    		
    	</tbody>
    </table>
    <br>

    <? echo CHtml::textField('newInterval', '', array('class'=>'cart-count')); ?>
    <span class="j-link" id="addInterval"> Добавить границу</span>
</div>

<button id="savebtn">Сохранить</button>

<a id="back-link" href = "<?=$url?>">Назад к списку товаров </a>
<br>
<br>
<script type="text/javascript">
	var attributes = JSON.parse('<?= $attributes ?>');
	var selected_attr;
	var selected_value;
    var photo_filename;

	//var dis_intervals = [5,10,'i'];
	//var dis_values = [1,4,5];
    var dis_intervals = JSON.parse('<?= $dis_intervals ?>');
    var dis_values = JSON.parse('<?= $dis_values ?>');

    //
    //ЗАГРУЗКА ФОТО
    //  
    $("#upload-product-photo").ajaxUpload({
    <? $url = $this->createUrl('admin/uploadPhotoAjax') ?>
    url : "<?=$url?>",
    name: "file",
    productId:'<?=$product->id?>',
    onSubmit: function() {
        $('#upload-product-photo-info').html('Загрузка... ');
    },
    onComplete: function(result) {
        
        $('#upload-product-photo-info').html('Файл загружен');
        
        photo_filename = "/images/products/" + result;
        console.log(photo_filename);
        $('#product-photo').attr('src',photo_filename);

        <? $url = $this->createUrl('admin/updatePhotoAjax') ?>
        /*
        //мктод для обновления БД
        $.post(
            "<?= $url ?>",
            {
               productId:'<?=$product->id?>',
               filename:result,
            },
            function(data) {
                //в случае успешного обновления бд, обновим фото
                if (data == 'false')
                {
                 alert ('Не удалось загрузить изображение.');
                 $('#upload-photo-info').html('Файл загружен');
                }
                else $('#product-photo').attr('src',data);    
            }
        );
        */ 
    }
    });

	// Свойства товара
	//
	for (var i=0; i< attributes.length; i++)
	{
		$("#attributes").append( $('<option value="'+ i +'">'+ attributes[i]['name'] +'</option>'));
	}

	$("#attributes").change(function(){
		$("#values").empty();
		$("#add_price").val('');
		selected_attr = $(this).children(":selected").val();
	    
	    console.log(selected_attr);
		for (var i=0;i<attributes[selected_attr]['values'].length;i++)
		{
			$("#values").append( $('<option value="'+ i +'">'+attributes[selected_attr]['values'][i]['name'] +'</option>'));
		}
	});

	$("#values").change(function(){
		selected_value =  $(this).children(":selected").val();
		$("#add_price").val(attributes[selected_attr]['values'][selected_value]['add_price']);
	});

	$("#add_price").keyup(function()
    {
    	if (!isNaN(parseInt($(this).val()))) 
    	{
    		$(this).css("border","1px solid #C1BCBC");
    		attributes[selected_attr]['values'][selected_value]['add_price'] = $("#add_price").val();
    		

    	}
    	else $(this).css("border","1px solid red");
    	
    }); 

    $("#addAtribute").click(function()
    {
    	if ($("#newAttribute").val()!='')
    	{
    		var tmpAttribute = {name:$("#newAttribute").val(),values:new Array()};
    		attributes.push(tmpAttribute);
    		var attr_index = (attributes.length - 1);
    		$("#attributes").append( $('<option value="'+  attr_index +'">' + $("#newAttribute").val() + '</option>'));
    		$("#attributes").val(attr_index).change();
    		$("#newAttribute").val('');
    		console.log(attributes);
    	}
    });

    $("#deleteAtribute").click(function()
    {
    	var attr_index = $("#attributes").val();
    	attributes.splice(attr_index,1);
    	$("#attributes option[value='" + attr_index + "']"). remove();
    	if ((attr_index - 1) >= 0) $("#attributes").val(attr_index - 1).change();
    	else if (attributes.length==0) $("#values").empty();
    	else
    	{
         console.log("kk: " + attr_index);		
    	 $("#attributes").val(attr_index).change();
    	}
    });

    $("#addValue").click(function()
    {
    	if ($("#newValue").val()!='')
    	{
    		var tmpValue = {name:$("#newValue").val(),add_price:0};
    		attributes[selected_attr]['values'].push(tmpValue);
    		var value_index = (attributes[selected_attr]['values'].length - 1);
    		$("#values").append( $('<option value="'+  value_index +'">' + $("#newValue").val() + '</option>'));
    		$("#values").val(value_index).change();
    		$("#newValue").val('');
    	}
    });

    $("#deleteValue").click(function()
    {
    	var value_index = $("#values").val();
    	attributes[selected_attr]['values'].splice(value_index,1);
    	$("#values option[value='" + value_index + "']"). remove();
    	if ((value_index - 1) >= 0) $("#values").val(value_index - 1).change();
    	else if (attributes[selected_attr]['values'].length==0) $("#values").empty();
    	else
    	{
         	
    	 $("#values").val(value_index).change();
    	}
    });

    //изменение порядка следования аттрибутов
    $("#attr-up").click(function(){
        if (selected_attr!=0)
        {
            selected_attr = parseInt(selected_attr);
            var tmp_attr = attributes[selected_attr];
            attributes[selected_attr] = attributes[selected_attr-1];
            attributes[selected_attr-1] = tmp_attr;
            
            $('#attributes option').eq(selected_attr).text(attributes[selected_attr]['name']);
            $('#attributes option').eq(selected_attr-1).text(attributes[selected_attr-1]['name']);
            $("#attributes").val(selected_attr-1).change();
        }
    });

    $("#attr-down").click(function(){
        if (selected_attr!=attributes.length-1)
        {
            selected_attr = parseInt(selected_attr);
            var tmp_attr = attributes[selected_attr];
            attributes[selected_attr] = attributes[selected_attr+1];
            attributes[selected_attr+1] = tmp_attr;   

            $('#attributes option').eq(selected_attr).text(attributes[selected_attr]['name']); 
            $('#attributes option').eq(selected_attr+1).text(attributes[selected_attr+1]['name']);
            $("#attributes").val(selected_attr+1).change();

        }
    });

    //изменение порядка следования значений
    $("#val-up").click(function(){
        if (selected_value!=0)
        {
            selected_value = parseInt(selected_value);
            var tmp_val = attributes[selected_attr]['values'][selected_value];
            attributes[selected_attr]['values'][selected_value] = attributes[selected_attr]['values'][selected_value-1];
            attributes[selected_attr]['values'][selected_value-1] = tmp_val;
            
            $('#values option').eq(selected_value).text(attributes[selected_attr]['values'][selected_value]['name']);
            $('#values option').eq(selected_value-1).text(attributes[selected_attr]['values'][selected_value-1]['name']);
            $("#values").val(selected_value-1).change();
        }
    });

    $("#val-down").click(function(){
        if (selected_value!=values.length-1)
        {
            selected_value = parseInt(selected_value);
            var tmp_val = attributes[selected_attr]['values'][selected_value];
            attributes[selected_attr]['values'][selected_value] = attributes[selected_attr]['values'][selected_value+1];
            attributes[selected_attr]['values'][selected_value+1] = tmp_val;
            
            $('#values option').eq(selected_value).text(attributes[selected_attr]['values'][selected_value]['name']);
            $('#values option').eq(selected_value+1).text(attributes[selected_attr]['values'][selected_value+1]['name']);
            $("#values").val(selected_value+1).change();
        }
    });
    //
    //СКИДКИ
    //
    
    drawDiscountTable();

    function drawDiscountTable()
    {
        $("#discount-table tbody tr").remove();
        for (var i=0; i < dis_intervals.length ;i++)
        {
            var inteval_str;

            
            if (i==0 && dis_intervals[i]=='i') inteval_str = '1 - беск.'; 
            else if (i==0 && dis_intervals[i]!='i') inteval_str = '1 - ' + dis_intervals[i];
            else if (dis_intervals[i]=='i') inteval_str = dis_intervals[i-1] + '- беск.' ;
            else inteval_str = dis_intervals[i-1] + ' - ' +  dis_intervals[i];
            $("#discount-table").find('tbody')
                .append('<tr id="dtr'+ i +'" ><td width=300>'+ inteval_str +'</td> <td width=200 id="dvtd'+i+'"></td>  <td id="deldvtd'+i+'"></td> </tr>');

            //Вставлеям в столюец "значение" поле ввода и его обработчик
            var in_dis_value = $('<input id="indv'+i+'" type="text" >%</input>');
            in_dis_value.val(dis_values[i]);
            in_dis_value.keyup(function()
            {
               var parseVal = parseInt($(this).val());
               if (!isNaN(parseVal))
               {
                    
                   $(this).css("border","1px solid #ccc");  
                   var this_dis_index = $(this).attr("id").substring(4);
                   dis_values[this_dis_index] =  parseVal;
                   
               }
               else
               {
                   $(this).css("border","1px solid red");    
               }
            
            });
            $('#dvtd'+i).append(in_dis_value);

            //Вставлеям в столюец "удалить" кнопку удаления
            if (i!=dis_intervals.length-1) 
            {
                var del_dis_value = $('<p>удалить</p>');
                del_dis_value.attr("id","pdeldv"+i);
                del_dis_value.attr("class","pdeldv");
                del_dis_value.click(function()
                {
                    var this_dis_index = $(this).attr("id").substring(6);
                    dis_intervals.splice(this_dis_index,1);
                    dis_values.splice(this_dis_index,1);
                    drawDiscountTable(); 
                    
                });
                $('#deldvtd'+i).append(del_dis_value);
            }
        }      
    }

    

	$("#addInterval").click(function()
    {
    	if ($("#newInterval").val()!='')
    	{
    		var newInterval = parseInt($("#newInterval").val());
    		if (!isNaN(newInterval) && newInterval>0) 
    		{
    			//проверим был ли уже введен такой интервал
    			for (var i=0;i<dis_intervals.length; i++)
    			{
    				if (dis_intervals[i]==newInterval) 
    				{
    					$("#newInterval").css("border","1px solid red");
    					return;
    				}
    			}

    			/*
    			var interval_index = dis_intervals.length-1;
    			for (var i=0;i<dis_intervals.length-1; i++)
    			{
    				if (newInterval < dis_intervals[i+1])
    				{
    					interval_index  = i;
    					break;
    				}
    			}
    			*/

    			var interval_index = dis_intervals.length -1; //последний инрвал (который до бесконечности)
				for (var i=0;i<dis_intervals.length;i++)
				{
					
					if (dis_intervals[i]!="i" && newInterval <= parseInt(dis_intervals[i]))
					{
						
						interval_index = i;
						break;
					}

				}

                var newValue = dis_values[interval_index];
    			dis_intervals.splice(interval_index,0,newInterval);
                dis_values.splice(interval_index,0,newValue);

                drawDiscountTable();

                $("#newInterval").val('');
    		}
    		else
    		{
    			$("#newInterval").css("border","1px solid red");
    		}
    	}
    }); 

    //
    //Кнопка сохранить
    //
    $("#savebtn").click(function(){
        <? $url = $this->createUrl("admin/saveProduct"); ?>
        var discount = "";
        for (var i=0;i<dis_intervals.length;i++)
        {
            discount= discount + dis_intervals[i] +';' + dis_values[i]; 
            if (i!=dis_intervals.length-1) discount= discount +';';
        }

        $.post(
            "<?= $url ?>",
            {
               productId:'<?=$product->id?>',
               attributes:JSON.stringify(attributes),
               discount:discount,
               name:$("#name").val(),
               text:$("#text").val(),
               sostav:$("#sostav").val(),
               main_price:$("#main_price").val(),
               photo:photo_filename,
            },
            onSaveAjaxSuccess
        ); 
    });

    function onSaveAjaxSuccess(data)
    {
        if (data=="true") alert("Cохранено!");
        else alert("Ошибка сохранения!");
    }
</script>