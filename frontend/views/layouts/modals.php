




<? if (Yii::$app->session->hasFlash('success')) {?>

<?
    $js = <<< JS
    $('#popUp').modal('show');
JS;

    $this->registerJs($js, $position = yii\web\View::POS_END, $key = null);
} ?>
