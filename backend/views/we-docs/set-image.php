<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \common\models\ImageUpload */
/* @var $imageFrom common\models\WeDocs */

$this->title = 'Выбор изображения: ' . $imageFrom->docNameView;
$this->params['breadcrumbs'][] = ['label' => 'Документы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $imageFrom->docNameView, 'url' => ['view', 'id' => $imageFrom->id]];
$this->params['breadcrumbs'][] = 'Выбор изображения';
?>
<div class="weDocs-set-image">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form-image', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
