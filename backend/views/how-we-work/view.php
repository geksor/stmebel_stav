<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use zxbodya\yii2\galleryManager\GalleryManager;

/* @var $this yii\web\View */
/* @var $model common\models\HowWeWork */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Как мы работаем', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="how-we-work-view">

    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Будут удалены все связанные данные. Продолжить?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('Шаги', ['how-we-work-step/index', 'par_id' => $model->id,], ['class' => 'btn btn-default']) ?>

            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'title',
                ],
            ]) ?>

        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Изображения</h3>
        </div>
        <div class="box-body">
            <? if ($model->isNewRecord) {
                echo 'Нельзя загружать изображения до создания галлереи';
            } else {
                echo GalleryManager::widget(
                    [
                        'model' => $model,
                        'behaviorName' => 'galleryBehavior',
                        'apiRoute' => 'how-we-work/galleryApi'
                    ]
                );
            }?>
        </div>
    </div>

</div>
