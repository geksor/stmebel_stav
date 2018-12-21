<?

?>

    <?= \yii\widgets\Menu::widget([
        'items' => [
            ['label' => 'О нас', 'url' => [ '/site/about' ]],
            ['label' => 'Доставка', 'url' => [ '/site/delivery' ]],
            ['label' => 'Контакты', 'url' => [ '/site/contact' ]],
            ['label' => 'Отзывы', 'url' => [ '/reviews' ]],
        ],
        'options' => [
            'class' => 'flex',
        ],
    ]) ?>
