<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Продолжить удаление?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('Добавить изображение', ['set-image', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Атрибуты/Характеристики', ['attribute', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Создать категорию', ['create'], ['class' => 'btn btn-default']) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
//                    'categoryType_id',
                    [
                        'attribute' => 'parent_id',
                        'value' => function($data){
                            /* @var $data \common\models\Category */
                            return $data->getParentName();
                        },
                    ],
                    'title',
                    'description:html',
                    'alias',
                    'meta_title',
                    'meta_description',
                    [
                        'attribute' => 'publish',
                        'label' => 'Состояние',
                        'value' => function ($data){
                            /* @var $data \common\models\Category */
                            if ($data->publish){
                                return 'Опубликован';
                            }
                            return 'Не опубликован';
                        }
                    ],
                    [
                        'attribute' => 'image',
                        'format' => 'raw',
                        'value' => function ($data){
                            /* @var $data \common\models\Category */
                            return "<div style=\"max-width: 100px\"> $data->image </div>";
                        }
                    ],
                ],
            ]) ?>

        </div>
    </div>

</div>

<?php //echo file_get_contents("https://s.cdpn.io/3/kiwi.svg"); ?>
