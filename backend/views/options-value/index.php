<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\OptionsValueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Options Values';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="options-value-index">

    <div class="box box-primary">
        <div class="box-body">
            <?php Pjax::begin(); ?>

            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['options/view', 'id' => $searchModel->options_id], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Создать', ['create', 'par_id' => $searchModel->options_id], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'value',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>

</div>
