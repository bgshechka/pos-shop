
<h2><?=$product->name ?></h2>
<p><?=$product->text ?></p>

<?
$k=0;
$attributesAddPrice = array(); // надбавочная цена для каждого занчения каждого свойства
foreach ($attributes as $attribute)
{
	$valuesAddPrice = CHtml::listData($attribute["values"],"id","add_price");
	//var_dump($valuesAddPrice);
	//array_push($attributesAddPrice, $valuesAddPrice);
	$tmpAttributesAddPrice["name"] = $attribute["name"];
	$tmpAttributesAddPrice["dropdown_id"] = '#attribute'.$k;
	$tmpAttributesAddPrice["valuesAddPrice"] = $valuesAddPrice;
	$attributesAddPrice[$k]=$tmpAttributesAddPrice;
	

	$valuesList=CHtml::listData($attribute["values"],"id","name");
	//var_dump($valuesList);
	echo CHtml::dropDownList('attribute'.$k,1,$valuesList,array('class'=>'inputNewTrade'));
    $k++;

}
echo "<br><br><p>Количество: ";
echo CHtml::textField('count',"1");
echo "</p>";
?>
<br>
<br>
<a id="to_cart" herf="">В корзину</a> 
<br>
<br>


<p id="price"></p>

<script type="text/javascript">
	var attributesAddPrice;
	var fixedPrice;
	var priceForOne;

	$(document ).ready(function() {
		attributesAddPrice = <?php echo json_encode($attributesAddPrice) ?>;
		fixedPrice=0;
		fixedPrice = <? if ($product->main_price!= null) echo $product->main_price;?>;
		calculate_price();
		
	});

	<?
	

	foreach ($attributesAddPrice as $attribute)
	{
		echo "$(\"".$attribute["dropdown_id"]."\" ).change(function() {calculate_price();});";
		
	}
	?>
    
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
			attributesStr = attributesStr + $(attributesAddPrice[i]["dropdown_id"]+" option:selected").text() + " ";
		}
		var date = new Date();
		$.post(
		  "<?= $url ?>",
		  {
		    name: '<?= $product->name;?>',
		    attributes: attributesStr,
		    count: parseInt($("#count").val()),
		    price: priceForOne,
		    id: date.getTime()
		  },
		  onAjaxSuccess
		);
    });

    function onAjaxSuccess(data)
	{
	  // Здесь мы получаем данные, отправленные сервером и выводим их на экран.
	  $("#cartcount").html("Корзина (" + data + ")");
	}

	function calculate_price()
	{
		console.log("calc");
		var price=fixedPrice;
		for (var i in attributesAddPrice)
		{
			
			var selectedValue= $(attributesAddPrice[i]["dropdown_id"]).val();
			if (attributesAddPrice[i]["valuesAddPrice"][selectedValue]!=null)
			price=price + parseInt(attributesAddPrice[i]["valuesAddPrice"][selectedValue]);
			
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
		priceForOne = price;
		price = price * parseInt($("#count").val());
		$("#price").html("Цена: " + price);
	}

</script>
