<?

/* @var $selectBox */

use yii\widgets\ActiveForm;

?>
<div class="head_search flex">
    <div id=selectBox>
        <!-- стрелка по правому краю для анимации, показывающая, что div-блок можно развернуть -->
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="14.665" class="arrow">
            <path fill="#00D17D" fill-rule="evenodd" d="M17.485 2l-7.071 7.071-1.415 1.414-1.414-1.414L.514 2 1.929.586l7.07 7.071L16.07.586 17.485 2z"/>
        </svg>
        <!-- текст, который будет виден в боксе -->
        <p class=valueTag name=select>Все категории</p>
        <!-- тот самый выпадающий список -->
        <ul id=selectMenuBox>
            <? if ($selectBox) {?>
                <? foreach ($selectBox as $key => $option) {?>
                    <li class='option searchOption' data-id="<?= $key ?>"><?= $option ?></li>
                <?}?>
            <?}?>
        </ul>
    </div> <!-- конец бокса -->
    <? $form = ActiveForm::begin([
            'action' => '/search/index',
            'method' => 'get',
            'options' => [
                'class' => 'form_search'
            ]
    ]); ?>

        <?= $form->field($model, 'title', ['options' => ['class' => 'text_input']])->textInput(['class' => 'text_input', 'style' => 'width:100%', 'placeholder' => 'Поиск мебели на сайте', 'maxlength' => true])->label(false) ?>

        <?= $form->field($model, 'filterCat', ['options' => ['style' => 'display:none']])->hiddenInput(['class' => 'filterCat'])->label(false) ?>

        <button class="button_search">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height=".6cm">
            <path fill="#00D17D" fill-rule="evenodd" d="M17.654 15.468l-2.11-2.101-1.682-1.673a7.333 7.333 0 0 0 1.379-4.282c0-4.09-3.342-7.416-7.448-7.416-4.109 0-7.45 3.326-7.45 7.416s3.341 7.417 7.45 7.417a7.432 7.432 0 0 0 4.553-1.56l2.888 2.875a.9.9 0 0 0 .114.092l.767.764 1.539-1.532zm-9.861-2.384c-3.142 0-5.698-2.544-5.698-5.672 0-3.127 2.556-5.671 5.698-5.671 3.14 0 5.696 2.544 5.696 5.671a5.63 5.63 0 0 1-1.19 3.457 5.7 5.7 0 0 1-4.506 2.215z"/>
        </svg>
    </button>

    <? ActiveForm::end() ?>
</div>

<?

$js = <<< JS
    $('.searchOption').on('click', function() {
        $('.filterCat').val($(this).attr('data-id'));
    });
JS;

$this->registerJs($js, $position = yii\web\View::POS_END, $key = null);
?>