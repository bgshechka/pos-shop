<div class="mainWrapper">
	<div class="product-container">
		<div class="product-container-left">	
			<div class="image-block">
				<img src="<?=$product->photo?>" alt="" class="promo-image">
			</div>
		</div>
		<div class="product-container-right">
			<h1><?=$product->name ?></h1>
			<p><?=$product->text ?></p>

			<span class="structure-title">Состав</span>
			<ul class="structure-list">
				<li class="structure"><?=$product->sostav?></li>
			</ul>

			
			<?
				$k=0;
				$attributesAddPrice = array(); // надбавочная цена для каждого занчения каждого свойства
				
				echo '<table id="attributes-table">'; 
				foreach ($attributes as $attribute)
				{
					$valuesAddPrice = CHtml::listData($attribute["values"],"id","add_price");
					//var_dump($valuesAddPrice);
					//array_push($attributesAddPrice, $valuesAddPrice);
					$tmpAttributesAddPrice["name"] = $attribute["name"];
					$tmpAttributesAddPrice["tr_id"] = '#attribute'.$k;
					$tmpAttributesAddPrice["valuesAddPrice"] = $valuesAddPrice;
					$attributesAddPrice[$k]=$tmpAttributesAddPrice;
					

					//$valuesList=CHtml::listData($attribute["values"],"id","name");
					//var_dump($valuesList);
					//var_dump($attribute);
					/** ЗРИ *///echo CHtml::dropDownList('attribute'.$k,1,$valuesList,array('class'=>'inputNewTrade'));
				    echo '<tr class="attribute" id=attribute'.$k.'>';
				    echo '<td class="attr-name">'.$attribute['name'].'</td>';
				    foreach ($attribute["values"] as $value)
				    {
				    	 echo '<td class="value" id=val'.$value->id.'>'.$value['name'].'</td>';
				    }
				    echo '</tr>';

				    $k++;

				}
				echo '</table>';

				echo "<br/><br/><div class=amount>Количество: ";
				/** ЗРИ */echo CHtml::textField('count',"1", array('class'=>'classTextField'));
				echo "</div>";
			?>
			
			
			<div id="price"></div>
			<div id="pr-discount" style="margin-left:10px;"></div>
			

			<div id="to_cart" class="button_cart-product">В корзину</div>
		</div>	
	</div>
</div>

<div id="podlogka"></div>
<div id="success_window">
    <h2 class="title_h1">Спасибо!</h2>
    <p>Товар был добавлен в корзину.</p>
    <p>Благодарим за покупку.</p>
    <br>
    <div id="close_success_window" class="button button-contact-us">Ок</div>
</div>

<script type="text/javascript">
	var attributesAddPrice;
	var fixedPrice;
	var priceForOne;
	var dis_intervals = JSON.parse('<?= $dis_intervals ?>');
	var	dis_values = JSON.parse('<?= $dis_values ?>');
    var productId = <?= $product->id ?>;
	var discount=0;
	var currentValues=[]; // текущее значение аттрибута, ключ массива - номер строки


	$(document ).ready(function() {
		attributesAddPrice = <?php echo json_encode($attributesAddPrice) ?>;
		fixedPrice=0;
		fixedPrice = <? if ($product->main_price!= null) echo $product->main_price;?>;
		
		for (var i=0;i<attributesAddPrice.length;i++)
		{
			currentValues[i]=getKeys(attributesAddPrice[i]['valuesAddPrice'])[0];
			$('#val'+currentValues[i]).addClass('selectedValue');
		}

		calculate_price();
		
		

	});

	function getKeys(obj) {
	    var r = []
	    for (var k in obj) {
	        if (!obj.hasOwnProperty(k)) 
	            continue
	        r.push(k)
	    }
	    return r
	}

	<?
	
	/*
	foreach ($attributesAddPrice as $attribute)
	{
		echo "$(\"".$attribute["dropdown_id"]."\" ).change(function() {calculate_price();});";
		
	}
	*/
	?>

	$(".value").click(function(){
		var attr_id=$(this).closest('tr').attr('id');
		attr_id= attr_id.replace('attribute','');
		var value_id = $(this).attr('id');
		value_id = value_id.replace('val','');
		
		//снять выделение у ранее выбранной ячейки
		$('#val'+currentValues[attr_id]).removeClass('selectedValue');
		currentValues[attr_id] = value_id;

		$('#val'+value_id).addClass('selectedValue');
		calculate_price();

	});
    
    $("#count").keyup(function()
    {
    	if (!isNaN(parseInt($("#count").val()))) 
    	{
    		calculate_price();
    		$("#count").css("border","1px solid #C1BCBC");
    	}
    	else $("#count").css("border","1px solid red");
    	//console.log(parseInt($("#count").val()));
    }); 

    $("#to_cart").click(function(){
    	calculate_price();
    	<? $url = $this->createUrl("main/tocart"); ?>

    	//составми строку с атрибутами товара по текущим значения dropdown-ов
		var attributesStr="";

		for (var i in attributesAddPrice)
		{
			attributesStr = attributesStr + attributesAddPrice[i]["name"] + ": ";
			attributesStr = attributesStr + '<b>' + $('#val'+currentValues[i]).html() + '</b>  ';
		}
		var date = new Date();
		$.post(
		  "<?= $url ?>",
		  {
		    name: '<?= $product->name;?>',
		    attributes: attributesStr,
		    count: parseInt($("#count").val()),
		    price: priceForOne,
		    discount:discount,
		    productId:productId,
		    id: date.getTime()
		  },
		  onAjaxSuccess
		);
    });

    function onAjaxSuccess(data)
	{
	  // Здесь мы получаем данные, отправленные сервером и выводим их на экран.
	  $("#cartcount").html("Корзина (" + data + ")");
	  $("#success_window").show();
       $("#podlogka").show();
	}

	$("#close_success_window").click(function(){
        $("#success_window").hide();
        $("#podlogka").hide();
    });

	function calculate_price()
	{
		
		var price=fixedPrice;
		for (var i in attributesAddPrice)
		{
			
			//var selectedValue= $(attributesAddPrice[i]["dropdown_id"]).val();
			if (attributesAddPrice[i]["valuesAddPrice"][currentValues[i]]!=null)
			price=price + parseInt(attributesAddPrice[i]["valuesAddPrice"][currentValues[i]]);
			//console.log(attributesAddPrice[i]["valuesAddPrice"][currentValues[i]]);
		}
		var count;
		var parse=parseInt($("#count").val());
		if (!isNaN(parse)) count = parse;
		else
		{
			count=1;
			 $("#count").val(count);
			 $("#count").css("border","1px solid #C1BCBC");
		}

		var dis_interval_num = dis_intervals.length -1; //последний инрвал (который до бесконечности)
		for (var i=0;i<dis_intervals.length;i++)
		{
			
			if (dis_intervals[i]!="i" && count <= parseInt(dis_intervals[i]))
			{
				
				dis_interval_num = i;
				break;
			}

		}
		if (dis_values[dis_interval_num] == 0) $("#pr-discount").html ("");
		else {
			$("#pr-discount").html ("СКИДКА: " + dis_values[dis_interval_num] + "%");
		}

		discount = dis_values[dis_interval_num];

		priceForOne = price;
		price = price * parseInt($("#count").val())*(1 - (discount/100));
		price = Math.round(price);
		$("#price").html("Цена: " + price);
	}

</script>