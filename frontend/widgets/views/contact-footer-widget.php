<?

/* @var $model \common\models\Contact */

?>

<div class="footer_adress">
    <h5>Поддержка</h5>
    <p><?= $model->phone_1 ?></p>
    <p><?= $model->phone_2 ?></p>
    <p><?= $model->email ?></p>
</div>
<div class="footer_adress">
    <h5>График работы:</h5>
    <p>Пн-Пт: <?= $model->mo_sa ?></p>
    <p>Сб-Вс: <?= $model->su ?></p>
    <!--<p>Вс: <?= $model->break ?></p>-->
</div>
