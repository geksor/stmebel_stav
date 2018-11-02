<?

/* @var $model \common\models\Personal */


?>

<div id="team" class="container mw-1200 mt-5 pt-5">
    <div class="row">
        <h2 class="col-12 text-center mb-5">Наша команда</h2>

        <? foreach ($model as $item) {/* @var $item \common\models\Personal */?>
            <div class="col-lg-3 col-sm-6 col-12 text-center">

                <?= \yii\helpers\Html::img($item->getPhotos('personal')['thumb_image'], ['class' => 'rounded-circle', 'alt' => $item->name]) ?>

                <p class="mt-3 mb-1 black">
                    <?= $item->name ?>
                </p>
                <p class="blue">
                    <?= $item->position ?>
                </p>
            </div>
        <?}?>
    </div>
</div>
