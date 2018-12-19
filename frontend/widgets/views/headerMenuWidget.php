<?

?>

    <?= \yii\widgets\Menu::widget([
        'items' => [
            ['label' => 'О нас', 'url' => [ '/site/about' ]],
            ['label' => 'Доставка', 'url' => [ '/site/delivery' ]],
            ['label' => 'Контакты', 'url' => [ '/site/contact' ]],
        ],
        'options' => [
            'class' => 'flex',
        ],
    ]) ?>
