<?

/* @var $model \common\models\Contact */

?>

<div class="socicoWrapFromFooter" style="display: flex; flex-wrap: nowrap">
    <div  style="flex: 1; padding: 10px">
        <a href="<?= $model->insta ?>" target="_blank" class="socicolinkFromFooter" style="display: block; font-size: x-large">
            <img src="/public/img/insta.png" alt="insta.png">
        </a>
    </div>
    <div  style="flex: 1; padding: 10px">
        <a href="https://wa.me/<?= $model->whatsApp ?>/?text=Здравствуйте%20мне%20необходимо%20консультация%20по%20Вашим%20услугам" target="_blank" class="socicolinkFromFooter" style="display: block; font-size: x-large">
            <img src="/public/img/watsapp.png" alt="insta.png">
        </a>
    </div>
    <div  style="flex: 1; padding: 10px">
        <a href="tg://resolve?domain=<?= $model->telegram ?>" target="_blank" class="socicolinkFromFooter" style="display: block; font-size: x-large">
            <img src="/public/img/telegramm.png" alt="telegramm.png">
        </a>
    </div>
</div>
