<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $decodedResponse app\controllers\MoodleController */
/* @var $model app\models\Usuario */

// ... código de la vista ...


if (isset($mensaje)) {
    echo '<pre>';
    var_dump($mensaje);
    echo '</pre>';
}

?>

<?php  $formulario = ActiveForm::begin();  ?>
<?= $formulario -> field($model,'username') ?>
<?= $formulario -> field($model,'password') ?>
<?= $formulario -> field($model,'firstname') ?>
<?= $formulario -> field($model,'lastname') ?>
<?= $formulario -> field($model,'email') ?>

    <div class="form-group">
        <?= Html::submitButton('ENVIAR',['class'=>'btn btn-primary']) ?>
    </div>
<?php   ActiveForm::end();   ?>



