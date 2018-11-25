<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $selectedAttr common\models\Category */
/* @var $attributes */

$this->title = 'Выбор категорий для: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Выбор категорий';
?>
<div class="attr-categories">

    <div class="box box-primary">
        <div class="box-body">
            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', Yii::$app->request->referrer, ['class' => 'btn btn-default']) ?>
            </p>

            <?= $this->render('_form-categories', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
