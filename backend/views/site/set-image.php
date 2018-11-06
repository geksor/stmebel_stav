<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \common\models\ImageUpload */
/* @var $width */
/* @var $height */

$this->title = 'Выбор изображения: ';
?>
<div class="pages-set-image">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form-image', [
                'model' => $model,
                'width' => $width,
                'height' => $height,
            ]) ?>

        </div>
    </div>


</div>
