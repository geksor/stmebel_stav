<?php

/* @var $this \frontend\components\View */
/* @var $model \backend\models\Contact */


$this->headerClass = 'contacts';
$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="map" class="container mw-1200 mt-5">
    <div class="row justify-content-center justify-content-lg-between">
        <div class="col-11 col-lg-12 text-justify text-lg-left">
            <script>
                var n = <?= $model->coordinate_N ?>;
                var e = <?= $model->coordinate_E ?>;
                var address = '<?= $model->address ?>';
            </script>

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
//                        'search' => 'new ymaps.control.SearchControl({options: {size: "small"}})',
        //            'new ymaps.control.FullscreenControl({options: {size: "small"}})',
                        'new ymaps.control.RouteEditor({options: {size: "small"}})',
                    ],
                    'behaviors' => [
                        'scrollZoom' => 'disable',
                        'dblClickZoom' => 'enable',
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
JS

                    ],
                ]
            );
            ?>

            <?= \mirocow\yandexmaps\Canvas::widget([
                'htmlOptions' => [
                    'style' => 'height: 500px;',
                ],
                'map' => $map,
            ]);?>

        </div>
    </div>
</div>
<div id="contacts-list" class="container mw-1200 mt-5">
    <div class="row justify-content-center justify-content-lg-between">
        <div class="col-11 col-lg-6 mt-4">
            <div class="row justify-content-center bg-gray mx-0 h-100">
                <div class="col-12 align-self-center pl-5 py-5 ml-4">
                    <div class="row lh-14">
                        <i class="fas fa-map-marker-alt col-1 pl-0 pr-2 pt-2 mr-1 text-right"></i>
                        <div class="col pl-0">
                            <span class="gray">Наш адрес:</span><br>
                            <span class=""><?= $model->address ?></span>
                        </div>
                    </div>
                    <div class="row mt-3 lh-14">
                        <i class="fas fa-phone col-1 pl-0 pr-2 pt-2 mr-1 text-right"></i>
                        <div class="col pl-0">
                            <span class="gray">Телефон:</span><br>
                            <span class=""><?= $model->phone_1 ?></span>
                        </div>
                    </div>
                    <div class="row mt-3 lh-14">
                        <i class="fas fa-phone col-1 pl-0 pr-2 pt-2 mr-1 text-right"></i>
                        <div class="col pl-0">
                            <span class="gray">Телефон:</span><br>
                            <span class=""><?= $model->phone_2 ?></span>
                        </div>
                    </div>
                    <div class="row mt-3 lh-14">
                        <i class="far fa-envelope col-1 pl-0 pr-2 pt-2 mr-1 text-right"></i>
                        <div class="col pl-0">
                            <span class="gray">Почта:</span><br>
                            <span class=""><?= $model->email ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-11 col-lg-6 text-center mt-4">
            <div class="row justify-content-center py-5 mx-0 review-contacts h-100">
                <h2 class="col-11 text-center my-5">Остались вопросы?</h2>
                <div class="col-12 text-center py-5">
                    <a class="btn btn-outline-light my-2 my-sm-0 rounded-0" href="#">Заказать обратный звонок</a>
                </div>
            </div>
        </div>
    </div>
</div>
