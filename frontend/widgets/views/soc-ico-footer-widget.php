<?

/* @var $model \common\models\Contact */

?>

<div class="socicoWrapFromFooter" style="display: flex; flex-wrap: nowrap">
    <div  style="flex: 1; padding: 10px">
        <a href="<?= $model->insta ?>" class="socicolinkFromFooter" style="display: block; font-size: x-large">
            <img src="/public/img/insta.png" alt="insta.png">
        </a>
    </div>
    <div  style="flex: 1; padding: 10px">
        <a href="<?= $model->whatsApp ?>" class="socicolinkFromFooter" style="display: block; font-size: x-large">
            <img src="/public/img/watsapp.png" alt="insta.png">
        </a>
    </div>
    <div  style="flex: 1; padding: 10px">
        <a href="<?= $model->telegram ?>" class="socicolinkFromFooter" style="display: block; font-size: x-large">
            <img src="/public/img/telegramm.png" alt="telegramm.png">
        </a>
    </div>
</div>
