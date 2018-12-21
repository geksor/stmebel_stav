<?

/* @var $items \frontend\widgets\HeaderMenuWidget */


?>

<div class="head_catalog">
    <div class="cd-dropdown-wrapper">
        <a class="cd-dropdown-trigger" href="#0">Каталог мебели</a>
        <nav class="cd-dropdown">
            <h2>Каталог мебели</h2>
            <a href="#0" class="cd-close">Закрыть</a>
            <ul class="cd-dropdown-content">
                <? if ($items) {?>
                    <? foreach ($items as $item) {?>
                        <? if (array_key_exists('items', $item)) {?>
                            <li class="has-children">
                                <a href="<?= \yii\helpers\Url::to($item['url']) ?>"><?= $item['label'] ?></a>

                                <ul class="cd-secondary-dropdown is-hidden">
                                    <li class="go-back"><a href="#0">Каталог мебели</a></li>
                                    <li class="see-all"><a href="<?= \yii\helpers\Url::to($item['url']) ?>">Перейти в <?= $item['label'] ?></a></li>
                                    <? foreach ($item['items'] as $item1) {?>
                                        <? if (array_key_exists('items', $item1)) {?>
                                            <li class="has-children">
                                                <a href="<?= \yii\helpers\Url::to($item1['url']) ?>"><?= $item1['label'] ?></a>

                                                <ul class="is-hidden">
                                                    <li class="go-back"><a href="#0"><?= $item1['label'] ?></a></li>
                                                    <li class="see-all"><a href="<?= \yii\helpers\Url::to($item1['url']) ?>">Перейти в <?= $item1['label'] ?></a></li>
                                                    <? foreach ($item1['items'] as $item2) {?>
                                                        <li><a href="<?= \yii\helpers\Url::to($item2['url']) ?>"><?= $item2['label'] ?></a></li>
                                                    <?}?>
                                                </ul>
                                            </li>
                                        <?}else{?>
                                            <li>
                                                <a href="<?= \yii\helpers\Url::to($item1['url']) ?>"><?= $item1['label'] ?></a>
                                                <!--<ul class="is-hidden">
                                                    <li class="see-all"><a href="<?= \yii\helpers\Url::to($item1['url']) ?>">Перейти в <?= $item1['label'] ?></a></li>
                                                </ul>-->
                                            </li>
                                        <?}?>
                                    <?}?>
                                </ul> <!-- .cd-secondary-dropdown -->
                            </li> <!-- .has-children -->
                        <?}else{?>
                            <li><a href="<?= \yii\helpers\Url::to($item['url']) ?>"><?= $item['label'] ?></a></li>
                        <?}?>
                    <?}?>
                <?}?>
            </ul> <!-- .cd-dropdown-content -->
        </nav> <!-- .cd-dropdown -->
    </div> <!-- .cd-dropdown-wrapper -->
</div>
