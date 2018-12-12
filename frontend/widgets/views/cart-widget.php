<?

/* @var $items \frontend\widgets\HeaderMenuWidget */
/* @var $cartArr */


?>
<? \yii\widgets\Pjax::begin(['id' => 'cartWidget'])?>
<div id="cartWidget" class="head_cart flex">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36">
        <path class="fill_cart" fill-rule="evenodd" d="M34.332 5.76H8.943L7.481 2.328a1.204 1.204 0 0 0-.83-.698L1.94.524a1.2 1.2 0 1 0-.55 2.334l4.119.968L16.05 28.568a3.935 3.935 0 0 0-.513 1.947 3.972 3.972 0 0 0 7.943 0c0-.549-.113-1.072-.316-1.549h4.325c-.203.477-.315 1-.315 1.549a3.972 3.972 0 0 0 7.943 0 3.972 3.972 0 0 0-3.971-3.965l-13.337.018-1.645-3.86h18.169a1.2 1.2 0 0 0 1.201-1.199V6.96a1.201 1.201 0 0 0-1.202-1.2zm-3.185 23.189c.867 0 1.57.702 1.57 1.567a1.569 1.569 0 0 1-3.139 0c0-.865.703-1.567 1.569-1.567zm-11.633 0a1.568 1.568 0 1 1 0 3.134 1.569 1.569 0 0 1-1.569-1.567c0-.865.703-1.567 1.569-1.567zm13.618-15.914h-7.961a1.2 1.2 0 1 0 0 2.398h7.961v4.877h-17.99L9.965 8.158h23.167v4.877z"/>
    </svg>
    <div class="head_cart_2">
        <p>Корзина</p>
        <p class="head_cart_product"><?= $cartArr?$cartArr['item_count']:'0' ?> товаров</p>
    </div>
</div>
<? \yii\widgets\Pjax::end() ?>
<?
$js = <<<JS
$('#addToCart').click(function(event) {
    event.preventDefault();
    $.pjax.reload({
        container: '#cartWidget',
        type       : 'GET',
        url        : $(this).attr("href"),
        data       : {
            prod_id: $(this).attr('data-prod_id'),
            prod_price: $(this).attr('data-prod_price'),
            prod_count: $(this).attr('data-prod_count'),
            prod_attrValue: $(this).attr('data-prod_attrValue'),
            prodColor: $(this).attr('data-color')
        },
        push       : false,
        replace    : false,
        timeout    : 1000,
    });
});
$('#cartWidget').on('click', function() {
    window.location.href = '/cart';  
});
JS;
$this->registerJs($js, $position = yii\web\View::POS_END, $key = null);
?>
