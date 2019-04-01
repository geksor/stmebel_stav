<?

?>

    <?= \yii\widgets\Menu::widget([
        'items' => [
            ['label' => 'О нас', 'url' => [ '/site/about' ]],
            ['label' => 'Доставка и оплата', 'url' => [ '/site/delivery' ]],
            ['label' => 'Контакты', 'url' => [ '/site/contact' ]],
        ],
        'options' => [
            'class' => 'flex',
        ],
    ]) ?>
