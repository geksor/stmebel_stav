<?php

use yii\helpers\Html;
use backend\widgets\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\AttrListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заполнение списка';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attr-list-index">

    <div class="box box-primary">
        <div class="box-body">
            <?php Pjax::begin(); ?>

            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['attributes/view', 'id' => $searchModel->attr_id], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Создать', ['create', 'par_id' => $searchModel->attr_id], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'title',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
