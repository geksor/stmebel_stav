<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AttrColor */

$this->title = 'Создание пункта';
$this->params['breadcrumbs'][] = ['label' => 'Заполнение цвета', 'url' => ['index', 'par_id' => $model->attr_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attr-color-create">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
