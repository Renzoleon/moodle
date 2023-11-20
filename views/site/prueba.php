<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
Saldra ahora si? Stare

<?php
if ($mensajeRespuesta){
    echo Html::tag('div',Html::encode($mensajeRespuesta),['class'=>'alert alert-danger']);
}
?>

<?php $formulario =ActiveForm::begin(); ?>
<?= $formulario -> field($model,'texto1') ?>
<?= $formulario -> field($model,'texto2') ?>

<div class="form-group">
    <?= Html::submitButton('ENVIAR',['class'=>'btn btn-primary']) ?>
</div>

<?php   ActiveForm::end();   ?>


