<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \common\models\Category */

$this->title = 'Выбор Изображения: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Выбор изображения';
?>
<div class="category-set-image">

    <div class="box box-primary">
        <div class="box-body">
            <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', Yii::$app->request->referrer, ['class' => 'btn btn-default']) ?>

            <?= $this->render('_form-image', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
