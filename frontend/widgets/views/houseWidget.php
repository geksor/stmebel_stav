<?

/* @var $models \common\models\Product */
/* @var $title \frontend\widgets\ExamplesWidget */
/* @var $category \frontend\widgets\ExamplesWidget */

?>

<div id="houses" class="container mw-1200 mt-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-12 mb-4 text-center text-md-left">
            <h2 class="text-center text-lg-left"><?= $title ?></h2>
        </div>
        <? foreach ($models as $key => $model) {
            /* @var $model \common\models\Product */ ?>
            <? $images = $model->getBehavior('galleryBehavior')->getImages(); /* @var $images \zxbodya\yii2\galleryManager\GalleryImage */ ?>

            <? if ($key % 2 === 0) { ?>
                <div class="col-11 col-lg-6 text-center mt-4">

                    <? $image1 = $images[0]; /* @var $image1 \zxbodya\yii2\galleryManager\GalleryImage */ ?>

                    <div class="position-relative" style="padding-top: 80%; height: 100%">

                        <?= \yii\helpers\Html::img(
                            $image1 ? $image1->getUrl('medium') : '/no_image.png',
                            [
                                'class' => "img-fluid position-absolute w-100 h-100",
                                'alt' => $image1->name,
                                'style' => 'object-fit: cover; top:0;left:0;'
                            ]
                        ) ?>

                    </div>
                </div>
                <div class="col-11 col-lg-6 mt-4">
                    <div class="row mt-4 mt-lg-0 justify-content-center h-100">
                        <div class="col-6 text-right text-lg-center">

                            <? $image2 = $images[1]; /* @var $image2 \zxbodya\yii2\galleryManager\GalleryImage */ ?>

                            <div class="position-relative" style="padding-top: 80%; height: 100%">
                                <?= \yii\helpers\Html::img(
                                    $image2 ? $image2->getUrl('medium') : '/no_image.png',
                                    [
                                        'class' => "img-fluid position-absolute w-100 h-100",
                                        'alt' => $image2->name,
                                        'style' => 'object-fit: cover; top:0;left:0;'
                                    ]
                                ) ?>
                            </div>
                        </div>
                        <div class="col-6 text-left text-lg-center">

                            <? $image3 = $images[2]; /* @var $image3 \zxbodya\yii2\galleryManager\GalleryImage */ ?>

                            <div class="position-relative" style="padding-top: 80%; height: 100%">
                                <?= \yii\helpers\Html::img(
                                    $image3 ? $image3->getUrl('medium') : '/no_image.png',
                                    [
                                        'class' => "img-fluid position-absolute w-100 h-100",
                                        'alt' => $image3->name,
                                        'style' => 'object-fit: cover; top:0;left:0;'
                                    ]
                                ) ?>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="row bg-gray mx-0 pt-lg-3 pb-lg-5 py-2 h-100">
                                <h3 class="col-12 my-2 my-lg-4 text-center text-lg-left"><?= $model->title ?></h3>
                                <?
                                $i = 1;
                                $iClose = 1;
                                $resArr = $model->getAttributesOrderRes($model->attributesOrder, $model->productAttributesRank);
                                foreach ($resArr as $keyAttr => $attr) {
                                /* @var $attr \common\models\Attributes */ ?>
                                <? if (in_array($attr->id, $model->getViewOnWidget())) {?>

                                <? if ($i === 1) { ++$i;?>
                                <div class="col-6 col-md-4 mt-2 text-center text-md-left">
                                    <span class="gray mr-1"><?= $attr->viewName ?>:</span>
                                    <span>
                                        <? if ($attr->type >= 1 && $attr->type < 3) { ?>
                                            <?= $attr->getAttrValue($model->id) ?>
                                        <? } else if ($attr->type === 3) { ?>
                                            <?= $attr->getAttrValue($model->id)->title ?>
                                        <? } ?>
                                    </span><br>
                            <? if ($iClose === count($model->getViewOnWidget())) {?>
                                </div>
                            <?} ++$iClose?>
                                <?}elseif ($i === 2) { ++$i;?>
                                <span class="gray mr-1"><?= $attr->viewName ?>:</span>
                                <span>
                                    <? if ($attr->type >= 1 && $attr->type < 3) { ?>
                                        <?= $attr->getAttrValue($model->id) ?>
                                    <? } else if ($attr->type === 3) { ?>
                                        <?= $attr->getAttrValue($model->id)->title ?>
                                    <? } ?>
                                </span><br>
                                <? if ($iClose === count($model->getViewOnWidget())) {?>
                                    </div>
                                <?} ++$iClose?>
                            <?}elseif ($i === 3) { $i = 1;?>
                                <span class="gray mr-1"><?= $attr->viewName ?>:</span>
                                <span>
                                    <? if ($attr->type >= 1 && $attr->type < 3) { ?>
                                        <?= $attr->getAttrValue($model->id) ?>
                                    <? } else if ($attr->type === 3) { ?>
                                        <?= $attr->getAttrValue($model->id)->title ?>
                                    <? } ?>
                                </span><br>
                                </div>
                            <?}?>
                        <?}?>
                        <?}?>

                        <div class="col-12 col-md-4 mt-2 text-center align-self-center">
                            <a class="btn btn-outline-primary my-2 my-sm-0 rounded-0"
                               href="<?= $model->getLink(0, true) ?>">Подробнее</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <? } else { ?>
            <div class="col-11 col-lg-6 mt-4">
                <div class="row mt-4 mt-lg-0 justify-content-center h-100">
                    <div class="col-6 text-right text-lg-center">

                        <? $image2 = $images[1]; /* @var $image2 \zxbodya\yii2\galleryManager\GalleryImage */ ?>

                        <div class="position-relative" style="padding-top: 80%; height: 100%">
                            <?= \yii\helpers\Html::img(
                                $image2 ? $image2->getUrl('medium') : '/no_image.png',
                                [
                                    'class' => "img-fluid position-absolute w-100 h-100",
                                    'alt' => $image2->name,
                                    'style' => 'object-fit: cover; top:0;left:0;'
                                ]
                            ) ?>
                        </div>
                    </div>
                    <div class="col-6 text-left text-lg-center">

                        <? $image3 = $images[2]; /* @var $image3 \zxbodya\yii2\galleryManager\GalleryImage */ ?>

                        <div class="position-relative" style="padding-top: 80%; height: 100%">
                            <?= \yii\helpers\Html::img(
                                $image3 ? $image3->getUrl('medium') : '/no_image.png',
                                [
                                    'class' => "img-fluid position-absolute w-100 h-100",
                                    'alt' => $image3->name,
                                    'style' => 'object-fit: cover; top:0;left:0;'
                                ]
                            ) ?>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="row bg-gray mx-0 pt-lg-3 pb-lg-5 py-2 h-100">
                            <h3 class="col-12 my-2 my-lg-4 text-center text-lg-left"><?= $model->title ?></h3>
                            <?
                            $i = 1;
                            $iClose = 1;
                            $resArr = $model->getAttributesOrderRes($model->attributesOrder, $model->productAttributesRank);
                            foreach ($resArr as $keyAttr => $attr) {
                                /* @var $attr \common\models\Attributes */ ?>
                                <? if (in_array($attr->id, $model->getViewOnWidget())) {?>

                                    <? if ($i === 1) { ++$i;?>
                                        <div class="col-6 col-md-4 mt-2 text-center text-md-left">
                                            <span class="gray mr-1"><?= $attr->viewName ?>:</span>
                                            <span>
                                            <? if ($attr->type >= 1 && $attr->type < 3) { ?>
                                                <?= $attr->getAttrValue($model->id) ?>
                                            <? } else if ($attr->type === 3) { ?>
                                                <?= $attr->getAttrValue($model->id)->title ?>
                                            <? } ?>
                                        </span><br>
                                        <? if ($iClose === count($model->getViewOnWidget())) {?>
                                            </div>
                                        <?} ++$iClose?>
                                    <?}elseif ($i === 2) { ++$i;?>
                                            <span class="gray mr-1"><?= $attr->viewName ?>:</span>
                                            <span>
                                                <? if ($attr->type >= 1 && $attr->type < 3) { ?>
                                                    <?= $attr->getAttrValue($model->id) ?>
                                                <? } else if ($attr->type === 3) { ?>
                                                    <?= $attr->getAttrValue($model->id)->title ?>
                                                <? } ?>
                                            </span><br>
                                            <? if ($iClose === count($model->getViewOnWidget())) {?>
                                                </div>
                                            <?} ++$iClose?>
                                    <?}elseif ($i === 3) { $i = 1;?>
                                        <span class="gray mr-1"><?= $attr->viewName ?>:</span>
                                        <span>
                                            <? if ($attr->type >= 1 && $attr->type < 3) { ?>
                                                <?= $attr->getAttrValue($model->id) ?>
                                            <? } else if ($attr->type === 3) { ?>
                                                <?= $attr->getAttrValue($model->id)->title ?>
                                            <? } ?>
                                        </span><br>
                                        </div>
                                    <?}?>
                                <?}?>
                            <?}?>

                            <div class="col-12 col-md-4 mt-2 text-center align-self-center">
                                <a class="btn btn-outline-primary my-2 my-sm-0 rounded-0"
                                   href="<?= $model->getLink(0, true) ?>">Подробнее</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-11 col-lg-6 text-center mt-4">

                <? $images = $model->getBehavior('galleryBehavior')->getImages(); /* @var $images \zxbodya\yii2\galleryManager\GalleryImage */ ?>
                <? $image1 = $images[0]; /* @var $image1 \zxbodya\yii2\galleryManager\GalleryImage */ ?>

                <div class="position-relative" style="padding-top: 80%; height: 100%">

                    <?= \yii\helpers\Html::img(
                        $image1 ? $image1->getUrl('medium') : '/no_image.png',
                        [
                            'class' => "img-fluid position-absolute w-100 h-100",
                            'alt' => $image1->name,
                            'style' => 'object-fit: cover; top:0;left:0;'
                        ]
                    ) ?>

                </div>
            </div>
        <? } ?>
    <? } ?>

    </div>
    <div class="row mt-4"></div>
</div>
