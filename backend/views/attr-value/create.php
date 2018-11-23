<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AttrValue */

$this->title = 'Создание пункта';
$this->params['breadcrumbs'][] = ['label' => 'Заполнение списка', 'url' => ['index', 'par_id' => $model->attr_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attr-list-create">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
