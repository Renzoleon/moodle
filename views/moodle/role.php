<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $decodedResponse app\controllers\MoodleController */
/* @var $modelr \app\models\Rol */
/* @var $formaulario yii\widgets\ActiveForm */


// ... código de la vista ...
if (isset($mensaje)) {
    echo '<pre>';
    print_r($_POST);
    var_dump($mensaje);
    echo '</pre>';
}

?>

<div class="usuario-create">
    <?php  $formulario = ActiveForm::begin();  ?>
    <div class="usuario-row">
        <?= $formulario -> field($modelr,'roleid')->textInput(['autofocus' => true, 'maxlength' => true]) ?>
        <?= $formulario -> field($modelr,'userid') ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('ENVIAR',['class'=>'btn btn-primary']) ?>
    </div>
    <?php   ActiveForm::end();   ?>
</div>