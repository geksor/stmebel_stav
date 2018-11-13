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
CSS;
$this->registerCss($css, ["type" => "text/css"], "callBackWidget" );
?>
<div class="modal fade" id="callBack" tabindex="-1" role="dialog" aria-labelledby="Заказать обратный звонок" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Заказ обратного звонка</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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


                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            </div>
            <div class="modal-footer">
                <?= \yii\helpers\Html::submitButton('Заказать', ['class' => 'btn btn-primary']) ?>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
