<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model \backend\models\Contact */

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-params">

    <div class="box box-primary">
        <div class="box-body">

            <?php $form = ActiveForm::begin(); ?>

            <h2>Контакты</h2>
            <script>
                var n = <?= $model->coordinate_N ?>;
                var e = <?= $model->coordinate_E ?>;
                var address = '<?= $model->address ?>';
            </script>

            <?= $form->field($model, 'address') ?>
            <?
            $n = $model->coordinate_N?$model->coordinate_N:45.044521;
            $e = $model->coordinate_E?$model->coordinate_E:41.969083;
            $map = new \mirocow\yandexmaps\Map('yandex_map', [
                'center' => [$n, $e],
                'zoom' => 16,
                // Enable zoom with mouse scroll
                'behaviors' => ['default', 'scrollZoom'],
                'type' => "yandex#map",
                'controls' => [],
            ],
                [
                    // Permit zoom only fro 9 to 11
                    'minZoom' => 1,
                    'maxZoom' => 19,
                    'controls' => [
                        // v 2.1
                        'new ymaps.control.ZoomControl({options: {size: "small"}})',
                        //            'new ymaps.control.TrafficControl({options: {size: "small"}})',
//                    'new ymaps.control.GeolocationControl({options: {size: "small"}})',
                        'search' => 'new ymaps.control.SearchControl({options: {size: "small"}})',
                        //            'new ymaps.control.FullscreenControl({options: {size: "small"}})',
                        //            'new ymaps.control.RouteEditor({options: {size: "small"}})',
                    ],
                    'behaviors' => [
                        'scrollZoom' => 'enable',
                        'dblClickZoom' => 'disable',
                    ],
                    'objects' => [
                        <<<JS
point = new ymaps.GeoObject({
 geometry : {
  type: 'Point',
  coordinates : [n,e]
 },
 properties : {
      balloonContentBody : address
      // hintContent : 'подробнее'
     }
});

var clusterer = new ymaps.Clusterer();
clusterer.add(point);
\$Maps['yandex_map'].geoObjects.add(clusterer);

search.events.add("resultselect", function (result){

    // Remove old coordinates
    \$Maps['yandex_map'].geoObjects.each(function(obj){
        \$Maps['yandex_map'].geoObjects.remove(obj);
    });
    

    // Add selected coordinates
    var index = result.get('index');
    var searchControl = \$Maps['yandex_map'].controls.get(1);
    searchControl.getResult(index).then(function(res) {
        var coordinates = res.geometry.getCoordinates();
        $('#coordinate_N').val(coordinates[0]);
        $('#coordinate_E').val(coordinates[1]);
    });
    
});
JS

                    ],
                ]
            );
            ?>

            <?= \mirocow\yandexmaps\Canvas::widget([
                'htmlOptions' => [
                    'style' => 'height: 400px;',
                ],
                'map' => $map,
            ]);?>

            <?= $form->field($model, 'phone_1') ?>
            <?= $form->field($model, 'phone_2') ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'coordinate_N')->hiddenInput(['id' => 'coordinate_N'])->label(false) ?>
            <?= $form->field($model, 'coordinate_E')->hiddenInput(['id' => 'coordinate_E'])->label(false) ?>

            <h2>Реквизиты</h2>

            <?= $form->field($model, 'companyType') ?>
            <?= $form->field($model, 'company_name') ?>
            <?= $form->field($model, 'corpAddress') ?>
            <?= $form->field($model, 'inn') ?>
            <?= $form->field($model, 'kpp') ?>
            <?= $form->field($model, 'ogrn') ?>
            <?= $form->field($model, 'bank') ?>

            <h2>Соцсети</h2>

            <?= $form->field($model, 'insta') ?>
            <?= $form->field($model, 'vk') ?>
            <?= $form->field($model, 'face') ?>


            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>
