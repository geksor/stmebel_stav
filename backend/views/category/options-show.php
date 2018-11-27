<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $selectedAttr common\models\Category */
/* @var $attributes */

$this->title = 'Настройка характеристик: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Настройка характеристик';
?>
<div class="category-atribute">

    <div class="box box-primary">
        <div class="box-body">
            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
            </p>

            <?= $this->render('_form-attr', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
