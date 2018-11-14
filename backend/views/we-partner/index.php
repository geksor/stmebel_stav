<?php

use yii\helpers\Html;
use backend\widgets\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\WePartnerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $settingsModel \backend\models\SiteSettings */

$this->title = 'Партнеры';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="we-partner-index">

    <div class="box box-primary">
        <div class="box-body">
            <?php Pjax::begin(); ?>

            <p>
                <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
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
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title font-weight-bold">Настройки вывода</h3>
    </div>
    <div class="box-body">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($settingsModel, 'homePagePartner_id')->textInput() ?>

        <?= $form->field($settingsModel, 'homePagePartner_count')->textInput() ?>

        <?= $form->field($settingsModel, 'pagePartner_id')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
