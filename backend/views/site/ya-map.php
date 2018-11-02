<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'Настройка карты';
?>
<div class="box box-primary">
    <div class="box-body">

        <? $form = ActiveForm::begin([
            'options' => ['class' => 'user-settings'],
            'fieldConfig' => [
                'options' => [
                    'tag' => false,
                ],
            ],
        ]);

        $map = new \mirocow\yandexmaps\Map('yandex_map', [
            'center' => [45.043279, 41.968437],
            'zoom' => 13,
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
                    'new ymaps.control.GeolocationControl({options: {size: "small"}})',
                    'search' => 'new ymaps.control.SearchControl({options: {size: "small"}})',
        //            'new ymaps.control.FullscreenControl({options: {size: "small"}})',
        //            'new ymaps.control.RouteEditor({options: {size: "small"}})',
                ],
                'behaviors' => [
                    'scrollZoom' => 'enable',
                ],
                'objects' => [
                    <<<JS
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
                                $('#coordinates').html('');
                                $('#coordinates').append('<input type="hidden" name="User[coordinates][]" value="'+coordinates[0]+'">');
                                $('#coordinates').append('<input type="hidden" name="User[coordinates][]" value="'+coordinates[1]+'">');
                            });
                            
                        });


JS

                ],
            ]
        );?>

        <?= \mirocow\yandexmaps\Canvas::widget([
            'htmlOptions' => [
                'style' => 'height: 600px;',
            ],
            'map' => $map,
        ]);

        ?>

            <div id="coordinates"></div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
