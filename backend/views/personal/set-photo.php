<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \common\models\ImageUpload */
/* @var $imageFrom common\models\Personal */

$this->title = 'Выбор фото: ' . $imageFrom->name;
$this->params['breadcrumbs'][] = ['label' => 'Сотрудники', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $imageFrom->name, 'url' => ['view', 'id' => $imageFrom->id]];
$this->params['breadcrumbs'][] = 'Выбор фото';
?>
<div class="personal-set-photo">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form-photo', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
