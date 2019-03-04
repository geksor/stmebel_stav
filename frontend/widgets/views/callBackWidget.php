<?

/* @var $model \common\models\CallBack */

use yii\widgets\ActiveForm;

$css=<<< CSS
.addInput{
    display: none!important;
}
.field-callback-lastname{
    display: none!important;
}
.callBackModal{
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.77);
    z-index: 99;
}
.flexWrap{
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 10px;
    width: 100%;
    height: 100%;
}
.callBackFormWrap{
    background: #ffffff;
    box-shadow: 0 0 56px 0 rgba(0, 0, 0, 0.33);
    padding: 15px;
    max-width: 400px;
}
.modal-header{
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 15px;
}
.callBackBtnBlock{
    display: flex;
    justify-content: flex-end;
    margin-top: 20px;
}
.callBackBtn{
    font-size: 16px;
    letter-spacing: 0.4px;
    text-align: center;
    color: #fff;
    padding: 10px 14px;
    border: none;
    cursor: pointer;
}
.callBackBtn.close{
    background-color: #f34e4e;
}
.callBackBtn.success{
    background-color: #00d181;
    margin-right: 15px;
}
.modal-footer{
    padding-top: 15px;
}
.modal-content input{
    background: #fff;
    width: 100%;
    border: 1px solid #bdbebe;
    padding: 15px 10px;
    font-size: 14px;
    letter-spacing: 0.4px;
    color: #9fa4a2;
    margin-top: 20px;
}
.modal-content .help-block{
    min-height: 18px;
}
.modal-title{
    font-size: 24px;
    font-family: 'RobotoBold', sans-serif;
    letter-spacing: 1.4px;
    color: #424242;
}
.agreeText{
    text-align: center;
}
CSS;
$this->registerCss($css, ["type" => "text/css"], "callBackWidget" );
?>


<div class="callBackModal" id="callBackModal" style="display: none">
    <div class="flexWrap">
        <div class="callBackFormWrap">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Заказ обратного звонка</h5>
                    <button type="button" class="callBackBtn close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?php $form = ActiveForm::begin([
                    'action' => '/site/call-back'
                ]); ?>

                <div class="modal-body">
                    <?= $form->field($model, 'lastName')->textInput([
                        'class' => 'addInput',
                    ])->label(false) ?>


                    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Введите ваше имя *'])->label(false) ?>

                    <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'placeholder' => 'Введите ваш телефон *'])->label(false) ?>

                </div>
                <div class="modal-footer">
                    <div class="main__about-popup-agree-wrapper">
                        <p class="agreeText">Нажимая кнопку отправить, я даю согласие на обработку
                            своей <span><a href="/agree">персональной информациии.</a></span></p>
                    </div>
                    <div class="callBackBtnBlock">
                        <?= \yii\helpers\Html::submitButton('Заказать', ['class' => 'callBackBtn success']) ?>
                        <button type="button" class="callBackBtn close" >Отмена</button>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>

<?php

$js = <<<JS
    $('.callBackModalShow').on('click', function(){
        $('#callBackModal').show('fade', 300, function() {
            $('html, body').css({
                overflow: 'hidden',
            });
        });
    });

    $('.close').on('click', function() {
        $('#callBackModal').hide('fade', 300, function() {
            $('html, body').css({
                overflow: 'auto'
            });
        });
    })
JS;

$this->registerJs($js, $position = yii\web\View::POS_END, $key = null);

?>