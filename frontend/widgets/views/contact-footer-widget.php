<?

/* @var $model \common\models\Contact */

?>

<div class="footer_adress">
    <div class="h5">Поддержка</div>
    <p><?= $model->phone_1 ?></p>
    <p><?= $model->phone_2 ?></p>
    <p><?= $model->email ?></p>
</div>
<div class="footer_adress">
    <div class="h5">График работы:</div>
    <p>Пн-Пт: <?= $model->mo_sa ?></p>
    <p>Сб-Вс: <?= $model->su ?></p>
    <!--<p>Вс: <?= $model->break ?></p>-->
</div>
