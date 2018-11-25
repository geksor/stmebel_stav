<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $selectedAttr common\models\Category */
/* @var $attributes */

$this->title = 'Выбор категорий: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Характеристики', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Выбор категорий';
?>
<div class="attr-categories">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form-categories', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
