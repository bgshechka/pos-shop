<div class="mainWrapper">
	<div class="main">	
		<h1 class="title_h1">Корзина покупателя</h1>
		<p class="center">Вы можете оплатить ваш товар безналичным расчетом, карточкой или наличными у нас в офисе <br>
		Наличными при получении покупка товара возможна до 10 штук в общей сложности, либо до 2500 рублей. <br>
		Сюда не входят индивидуальные заказы. Они оплачиваются предварительно <br>
		Напомним, что отгрузка товара производится с 9.00 до 18.00 <br>
		Пожалуйста, убедитесь в готовности вашего заказа, либо дождитесь звонка нашего менеджера, <br>
		который сразу же сообщит вам по изготовлении. </p>
<?
	$positions = $cart->getPositions();
	$dostavka = false;
	$totalPrice = 0;
	if (count($positions)!=0)
	{
?>
		<table class="cart-table">
		<thead>
		<tr>
			<th class="left">Продукт</th>
			<th>Количество</th>
			<th>Цена</th>
			<th></th>
		</tr>
		</thead>
		<tbody>

		<?
			//$cart->removeAll();
			//var_dump(array_keys($cart->getPositions()));
			//$p = $cart->getPositions();
			//var_dump($p['1']);

			

			foreach ($positions as $position)
			{
				//если в корзине есть доставка поставим флаг
				if ($position->id == 100) $dostavka = true;
				$totalPrice+= $position->priceForOne * $position->count;
				if ($position->id != 100) { //позицию доставки выводить не надо
		?>	
			<tr>
				<td width=300px class="left">
					<p><?=$position->name ?> </p>
					<p><?=$position->attributes ?> </p>
				</td>

				<td width=60px>
					<? echo CHtml::textField('count'.$position->id, $position->count, array('class'=>'cart-count')); ?>
				</td>
				<td width=100px>
					<div id="priceForOne<?=$position->id?>" class="priceForOne" style="display:none">$position->priceForOne</div>
					<div id="pp<?=$position->id?>" class="pricePosition"><?= ($position->priceForOne*$position->count) ?></div>
				</td>
				<td width=100px>
					<? $url=$this->createUrl("main/deletePosition",array("id"=>$position->id)) ?>
					<a href="<?=$url?>"><div class="delete"></div></a>
				</td>
			</tr>


		<?
				
			}
			} 
		?>
		</tbody>
		</table>
		
		<div  class="cart-kostil">
		<hr align="left" class="hr-cart">
		<p>Дополнительные услуги</p>
		<hr align="left" class="hr-cart">

		<table>
				<tr>
					<td width=442px>
						<span class="left">Как вам удобно забрать ваш товар?</span>
						<?

						if ($dostavka) $select = 'yes';
						else $select = 'no';
						echo CHtml::dropDownList('dostavka', $select,array('yes' => 'Доставка', 'no' => 'Самовывоз'));
						?>
					</td>
					<td width=100px id="dostavka-price">
						<? if ($dostavka) echo "+200" ?>
					</td>
				</tr>
		</table>
		<div class="cart-fullSum">
			<span>Итого:</span>
			<span id="totalPrice"><?=$totalPrice ?></span>
		</div>

		<div class="cart-pay_container">

			<div id="podlogka"></div>
			<div id="show_nal_window" class="button_cart-pay">Наличный</div>
			<div id="show_beznal_window" class="button_cart-pay">Безналичный</div>
		</div>
		
		</div>

		<?
			}
			else 
			{
		?>
		<div>Корзина пуста</div>
		<?
			}
		?>
		</div>
	</div>

    <!--Окошко безналичного расчета-->
	<div id="beznal_window">
		<div id="close_beznal_window">Закрыть</div>
		<div id="beznal_window_form">
			<h2 class="title_h1">Безналичный расчет</h2>
			
			<div class="beznal-container">
				<p class="contact_head">Полное имя</p>
				<input type="text" id="beznal_name">
				<p class="contact_head">Контактный телефон</p>
				<input type="text" id="beznal_phone">
				<p class="contact_head">Электронный ящик</p>
				<input type="text" id="beznal_email"> 
				

				<div class="dostavka_in_window"> <!--активен либо этот блок,либо нижестоящий-->
					<p class="contact_head">Адрес доставки</p>
					<textarea id="nal_address">
					</textarea>
				</div>
				
				<div class="samovivoz_in_window" >
					<p>Самовывоз товара.</p>
				</div>
			</div>
			<div id="beznal_submit" class="button_cart-pay">Оплатить</div>

		</div>

		
	</div>

	<!--Окошко наличного расчета-->
	<div id="nal_window">
		<div id="close_nal_window">Закрыть</div>
		<div id="nal_window_form">
			<h2 class="title_h1">Наличный расчет</h2>
			
			<div class="beznal-container">
				<p class="contact_head">Полное имя</p>
				<input type="text" id="nal_name">
				<p class="contact_head">Контактный телефон</p>
				<input type="text" id="nal_phone">
				<p class="contact_head">Электронный ящик</p>
				<input type="text" id="nal_email"> 
				

				<div class="dostavka_in_window" > <!--активен либо этот блок,либо нижестоящий-->
					<p class="contact_head">Адрес доставки</p>
					<textarea id="nal_address">
					</textarea>
				</div>
				
				<div class="samovivoz_in_window" >
					<p>Самовывоз товара.</p>
				</div>
			</div>
			<div id="nal_submit" class="button_cart-pay">Отправить</div>
		</div>

		<div id="nal_window_success">
		  <h2 class="title_h1">Спасибо</h2>
		   <p>Наш менеджер свяжется
		   с вами в ближайшее время</p>

		   <p>Хорошего времени
		   суток</p>
		   <p>Номер заявки: <span id="tradeNumber"></span></p>
		  </div>
	</div>


</div>

<script type="text/javascript">
	var dostavka;
	<? if ($dostavka) echo "dostavka=\"on\";";
		else echo "dostavka=\"off\";";
	?>

	if (dostavka=="on")
	{
		$(".dostavka_in_window").show();
		$(".samovivoz_in_window").hide();
	}
	else
	{
		$(".dostavka_in_window").hide();
		$(".samovivoz_in_window").show();
	}

	console.log(dostavka);
	$("#dostavka").change(function(){
		
		
		if ( $(this).val()=="yes" )
		{
			$("#dostavka-price").html("+200");
			dostavka="on";

			//в окне подтверждения заказа активировать поле с адресом
			$(".dostavka_in_window").show();
			$(".samovivoz_in_window").hide();
		}
		else
		{
			$("#dostavka-price").html("");
			dostavka="off";
			//в окне подтверждения заказа оставить надпись "самовывоз"
			$(".dostavka_in_window").hide();
			$(".samovivoz_in_window").show();

		}

		<? $url = $this->createUrl("main/switchDostavka"); ?>
    		
    	$.post(
			"<?= $url ?>",
			{
			   dostavka:dostavka
			},
			onSwitchDostavkaAjaxSuccess
		); 

	});

	//при включении/отключении доставки - обновим итого
	function onSwitchDostavkaAjaxSuccess(data)
	{
		$("#totalPrice").html(data);
	}

	var positionId;

	$(".cart-count").keyup(function()
    {
    	if (!isNaN(parseInt($(this).val()))) 
    	{
    		
    		$(this).css("border","1px solid #C1BCBC");
    		//вычислим id позиции
    		positionId = $(this).attr('id').substring(5);
    		
    		<? $url = $this->createUrl("main/updatePositionCount"); ?>
    		
    		$.post(
			  "<?= $url ?>",
			  {
			    positionId:positionId,
			    newCount:$(this).val()
			  },
			  onChangeCountAjaxSuccess
			); 

    	}
    	else $(this).css("border","1px solid red");
    	//console.log(parseInt($("#count").val()));
    }); 

    function onChangeCountAjaxSuccess(data)
	{
	  var j_data = JSON.parse(data);
	
	  
	  //получим новую цену позиции и обновим вывод
	  var priceId = "#pp" + positionId;
	  $(priceId).html(j_data['positionPrice']);
	  $("#totalPrice").html(j_data['totalPrice']);
	  
	}

	
	//НАЛИЧНЫЙ РАСЧЕТ
	$("#show_nal_window").click(function(){
		$("#podlogka").fadeIn(300);
		$("#nal_window").show();
	});
	$("#close_nal_window").click(function(){
		$("#nal_window").hide();
		$("#nal_window_form").show();
		$("#nal_window_success").hide();
		$("#podlogka").hide();
	});

	//кнопка отправить в наличном расчете
	$("#nal_submit").click(function(){
		if ($("#nal_name").val()=="")
		{
			$("#nal_name").css("border-color","red");
			return;
		}
		if ($("#nal_phone").val()=="")
		{
			$("#nal_phone").css("border-color","red");
			return;
		}
		if ($("#nal_email").val()=="")
		{
			$("#nal_email").css("border-color","red");
			return;
		}
		
		/*
		if (dostavka=="on" && $.trim($("#nal_address").val()).length == 0)
		{
			console.log("ololo");
			$("#nal_address").css("border-color","red");
			return;
		}
		*/
		
		<? $url = $this->createUrl("main/tradeSubmit"); ?>
    		
    	$.post(
		"<?= $url ?>",
		{
			name:$("#nal_name").val(),
			phone:$("#nal_phone").val(),
			email:$("#nal_email").val(),
			address:$("#nal_address").val(),
			paymentType:"nal",
			totalPrice:$("#totalPrice").html(),
		
		},
		onNalTradeSubmitAjaxSuccess
		); 

	});

	function onNalTradeSubmitAjaxSuccess(data)
	{
		$("#nal_window_form").hide();
		$("#nal_window_success").show();
		$("#tradeNumber").html(data);
	}

	//БЕЗНАЛИЧНЫЙ РАСЧЕТ
	$("#show_beznal_window").click(function(){
		$("#beznal_window").show();
		$("#podlogka").fadeIn(300);
	});
	$("#close_beznal_window").click(function(){
		$("#beznal_window").hide();
		$("#podlogka").hide();
	});

	//кнопка отправить в безналичном расчете
	$("#beznal_submit").click(function(){
		if ($("#beznal_name").val()=="")
		{
			$("#beznal_name").css("border-color","red");
			return;
		}
		if ($("#beznal_phone").val()=="")
		{
			$("#beznal_phone").css("border-color","red");
			return;
		}
		if ($("#beznal_email").val()=="")
		{
			$("#beznal_email").css("border-color","red");
			return;
		}
		
		if (dostavka=="on" && $.trim($("#beznal_address").val()).length == 0)
		{
			
			$("#beznal_address").css("border-color","red");
			return;
		}

		<? $url = $this->createUrl("main/tradeSubmit"); ?>
    		
    	$.post(
		"<?= $url ?>",
		{
			name:$("#nal_name").val(),
			phone:$("#nal_phone").val(),
			email:$("#nal_email").val(),
			address:$("#nal_address").val(),
			paymentType:"beznal",
			totalPrice:$("#totalPrice").html(),
		
		},
		onBeznalTradeSubmitAjaxSuccess
		); 

	});

	function onBeznalTradeSubmitAjaxSuccess(data)
	{
		$("#beznal_window").hide();
		$("#podlogka").hide();

	}
</script>