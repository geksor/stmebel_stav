<?php

/* @var $this \frontend\components\View */

/* @var $model \common\models\Comment */
/* @var $formModel \common\models\Comment */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$css= <<< CSS

.addInput{
    display: none!important;
} 

CSS;

$this->registerCss($css, ["type" => "text/css"], "reviews" );

$this->headerClass = 'reviews-page';
$this->title = 'Отзывы';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="reviews-text" class="container mw-1200 mt-5 pt-5">
    <div class="row justify-content-center justify-content-lg-between">
        <div class="col-11 col-lg-12 text-justify text-lg-left">
            <? foreach ($model as $item) {
                /* @var $item \common\models\Comment */ ?>
                <p class="font-weight-bold mb-1">
                    <span class="name-blue">
                        <?= $item->user_name ?>,&nbsp;</span>
                    <span class="date-review">
                        <?= Yii::$app->formatter->asDate($item->created_at, 'long') ?>
                    </span>
                </p>
                <p>
                    <?= $item->text ?>
                </p>
            <? } ?>
        </div>
    </div>
</div>
<div id="reviews-form" class="container mw-1200 mt-5">
    <div class="row justify-content-center py-5 mx-0 review">
        <h2 class="col-11 text-center mb-5">Оставь свой отзыв</h2>
        <?php $form = ActiveForm::begin([
            'options' => [
                'class' => 'col-11 col-md-8',
            ]
        ]); ?>

            <div class="form-row">
                <?= $form->field($formModel, 'name')->textInput([
                    'class' => 'addInput',
                ])->label(false) ?>
                <div class="col-12 col-md-6">
                    <?= $form->field($formModel, 'user_name')
                        ->textInput([
                            'maxlength' => true,
                            'class' => 'custom-form-control form-control rounded-0 bg-transparent text-white',
                            'placeholder' => 'ФИО'
                        ])
                        ->label(false) ?>
                </div>
                <div class="col-12 col-md-6">

                    <?= $form->field($formModel, 'email')
                        ->textInput([
                            'maxlength' => true,
                            'class' => 'custom-form-control form-control rounded-0 bg-transparent text-white',
                            'placeholder' => 'E-mail'
                        ])
                        ->label(false) ?>

                </div>
            </div>

        <?= $form->field($formModel, 'text')
            ->textarea([
                'class' => 'custom-form-control form-control rounded-0 bg-transparent text-white',
                'placeholder' => 'Текст сообщения...',
                'rows' => '5'
            ])
            ->label(false) ?>

            <div class="col-auto my-1 pl-0">
                <?= $form->field($formModel, 'agree')
                    ->checkbox([
                        'class' => 'custom-control-input',
                        'template' => '<div class="custom-control custom-checkbox mr-sm-2">{input}{label}<p class="help-block help-block-error"></p></div>',
                    ])
                    ->label(
                            'Нажимая кнопку «Отправить отзыв», я даю свое согласие на обработку моих персональных данных, в
                            соответствии с Федеральным законом от 27.07.2006 года №152-ФЗ «О персональных данных», на
                            условиях и для целей, определенных в
                            <a href="#agree" data-toggle="modal">Согласии на обработку персональных данных</a>',
                            ['class' => 'custom-control-label small text-muted']
                    )
                ?>

            </div>
            <div class="col-12 text-center mt-3">
                <button type="submit" class="btn btn-outline-light my-2 my-sm-0 rounded-0">Отправить отзыв</button>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
