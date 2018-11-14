<?php

use yii\helpers\Html;
use backend\widgets\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\CertificateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $settingsModel \backend\models\SiteSettings */

$this->title = 'Сертификаты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="certificate-index">

    <div class="box box-primary">
        <div class="box-body">
            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Создать галерею', ['create'], ['class' => 'btn btn-success']) ?>
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

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title font-weight-bold">Настройки вывода</h3>
        </div>
        <div class="box-body">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($settingsModel, 'certificate_id')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>
