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
?>

<? if ($models) {?>
    <? foreach ($models as $model) {/* @var $model \common\models\AllReviews */?>
        <?= $model->user_name ?>
        <?= Yii::$app->formatter->asDate($model->created_at, 'long') ?>
        <?= $model->text ?>
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

<?= $form->field($formModel, 'user_name', ['options' => ['class' => 'reviewsGroup']])->textInput(['maxlength' => true, 'class' => 'form_text', 'placeholder' => 'Ваше имя'])->label(false) ?>

<?= $form->field($formModel, 'email', ['options' => ['class' => 'reviewsGroup']])->textInput(['maxlength' => true, 'class' => 'form_text', 'placeholder' => 'Ваш Email'])->label(false) ?>

<?= $form->field($formModel, 'text')->textarea(['class' => 'form_area', 'cols' => '30', 'rows' => '10', 'placeholder' => 'Текст отзыва...'])->label(false) ?>

<?= \yii\helpers\Html::submitButton('Оставить отзыв', ['class' => 'zabron_read']) ?>

<?php ActiveForm::end(); ?>

