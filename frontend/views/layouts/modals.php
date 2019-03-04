

<?php if (Yii::$app->session->hasFlash('success')) {?>

<?php
    $js = <<< JS
    $('#popUp').modal('show');
JS;

    $this->registerJs($js, $position = yii\web\View::POS_END, $key = null);
} ?>
