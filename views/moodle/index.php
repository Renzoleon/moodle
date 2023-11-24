<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $decodedResponse app\controllers\MoodleController */
/* @var $model app\models\Usuario */
/* @var $formaulario yii\widgets\ActiveForm */

// ... código de la vista ...
if (isset($mensaje)) {
    echo '<pre>';
    print_r($_POST);
    var_dump($mensaje);
    echo '</pre>';
}

?>
<?php  $formulario = ActiveForm::begin();  ?>
<?= $formulario -> field($model,'username')->textInput(['autofocus' => true]) ?>
<?= $formulario -> field($model,'password') ?>
<?= $formulario -> field($model,'firstname') ?>
<?= $formulario -> field($model,'lastname') ?>
<?= $formulario -> field($model,'email') ?>

    <div class="form-group">
        <?= Html::submitButton('ENVIAR',['class'=>'btn btn-primary']) ?>
    </div>
<?php   ActiveForm::end();   ?>
