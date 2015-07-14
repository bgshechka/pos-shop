<div class="contactWrapper">
        <div class="main">  
            <h1 class="title_h1">Обратная связь</h1>
            <p>
                Вы можете поделиться Вашими эмоциями, сказать нам: "Спасибо",
                <br/> либо упрекнуть в чем-то. Если у Вас трещина на только что полученном 
                <br/>стекле или вы недовольны нашими менеджерами, говорите нам. 
                <br/>Мы ставим высокие цели и без Вас тут не обойтись.
            </p>
                <div class="contact-form">
                    <?
                    /*
                    $model = new ContactForm();
                    ?>
                    <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'contact-form',
                        'action'=>Yii::app()->createUrl('main/sendMessage'),
                        'enableAjaxValidation'=>false,
                        ));
                    */
                    ?>
                    <?php //echo $form->errorSummary($model); ?>

                    <?php echo CHtml::textField('name',"",array("class"=>'contact-form_field contact-form_field-mini', "placeholder"=>'Ваше имя')) ?>
                    <?php echo CHtml::textField('email',"",array("class"=>'contact-form_field contact-form_field-mini', "placeholder"=>'Ваш email')) ?>
                    <?php echo CHtml::textArea('text',"",array("class"=>'contact-form_field contact-form_field-message', "placeholder"=>'Ваше сообщение...')) ?>
                    <div class="submit">
                        <?php //echo CHtml::submitButton('Отправить',array("class"=>'button button-contact-us')); ?>
                        <div id="send_btn" class="button button-contact-us">Отправить</div>
                    </div>
                    <div class="contact-us_container">
                        <a href="mailto:2233215@mail.ru"><div class="contact-us contact-us_mail"></div>2233215@mail.ru</a><br>
                        <a href="tel:+79191233215"><div class="contact-us contact-us_phone"></div>223.32.15 / +7.919.123.32.15</a><br>
                        <a href=""><div class="contact-us contact-us_map"></div>Челябинск, ул. Свободы, дом 22</a>
                    </div>

                    <?php //$this->endWidget(); ?>
                    </div><!-- form -->
    </div>
</div>

<div id="podlogka"></div>
<div id="success_window">
    <h2 class="title_h1">Спасибо</h2>
    <p>Ваше сообщение отправлено!</p>
    <p>Наши менеджеры ответят Вам в ближайшее время.</p>
    <br>
    <div id="close_success_window" class="button button-contact-us">Ок</div>
</div>

<script type="text/javascript">
    $("#send_btn").click(function(){

        if ($("#name").val()=="")
        {
            $("#name").css("border-color","red");
            return;
        }

        if ($("#email").val()=="")
        {
            $("#email").css("border-color","red");
            return;
        }

        <? $url = $this->createUrl("main/answerFormSend"); ?>

        $.post(
        "<?= $url ?>",
        {
            name:$("#name").val(),
            email:$("#email").val(),
            text:$("#text").val(),
        },
        onAnswerFormSendAjaxSuccess
        );


    });

    function  onAnswerFormSendAjaxSuccess()
    {
        $("#success_window").show();
        $("#podlogka").show();
    }



    $("#close_success_window").click(function(){
        $("#success_window").hide();
        $("#podlogka").hide();
    });
</script>