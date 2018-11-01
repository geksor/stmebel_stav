<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $selectedAttr common\models\Category */
/* @var $attributes */

$this->title = 'Настройка атрибутов: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Настройка атрибутов';
?>
<div class="category-atribute">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form-attr', [
                'model' => $model,
                'attributes' => $attributes,
            ]) ?>

        </div>
    </div>

</div>
