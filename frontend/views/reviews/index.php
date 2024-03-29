<?php

/* @var $this \frontend\components\View */

use yii\widgets\ActiveForm;

/* @var $siteSettings \common\models\SiteSettings */
/* @var $models \common\models\AllReviews */
/* @var $formModel \common\models\AllReviews */

$this->registerMetaTag([
    'name' => 'title',
    'content' => $siteSettings->meta_title,
]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => $siteSettings->meta_description,
]);

$this->title = 'Отзывы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviews">
        <? if ($models) {?>
            <? foreach ($models as $model) {/* @var $model \common\models\AllReviews */?>
                <div class="review">
                    <div class="flex_4">
                        <p class="revew_name"><?= $model->user_name ?></p>
                        <p class="revew_date"><?= Yii::$app->formatter->asDate($model->created_at, 'long') ?></p>
                    </div>
                    <p class="revew_text"><?= $model->text ?></p>
                </div>
            <?}?>
        <?}?>
    <?php $form = ActiveForm::begin([
        'action' => '/reviews/send-reviews'
    ]); ?>

    <div class="addInput" style="display: none">
        <?= $form->field($formModel, 'lastName')->textInput([
            'class' => 'addInput',
        ])->label(false) ?>
    </div>
    <div class="reviews_form">
        <?= $form->field($formModel, 'user_name', ['options' => ['class' => 'reviewsGroup']])->textInput(['maxlength' => true, 'class' => 'form_text', 'placeholder' => 'Ваше имя'])->label(false) ?>

        <?= $form->field($formModel, 'email', ['options' => ['class' => 'reviewsGroup']])->textInput(['maxlength' => true, 'class' => 'form_text', 'placeholder' => 'Ваш Email'])->label(false) ?>

        <?= $form->field($formModel, 'text')->textarea(['class' => 'form_area', 'cols' => '30', 'rows' => '10', 'placeholder' => 'Текст отзыва...'])->label(false) ?>

        <?= \yii\helpers\Html::submitButton('Оставить отзыв', ['class' => 'zabron_read']) ?>

        <?php ActiveForm::end(); ?>
    </div>
</div>
