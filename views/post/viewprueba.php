<?php
use yii\helpers\Html;
use app\widgets\HelloWidget;
use yii\jui\DatePicker;

?>
<?= DatePicker::widget(['name' => 'date']) ?>
<?php HelloWidget::begin();  ?>
    <?= Html::encode($request) ?>
<?php HelloWidget::end();   ?>

