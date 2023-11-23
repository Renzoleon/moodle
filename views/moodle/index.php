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
Esto es una pruebah
?>

<?php  $formulario = ActiveForm::begin();  ?>
<?= $formulario -> field($model,'username')->textInput(['autofocus' => true]) ?>
<?= $formulario -> field($model,'password')->passwordInput() ?>
<?= $formulario -> field($model,'firstname') ?>
<?= $formulario -> field($model,'lastname') ?>
<?= $formulario -> field($model,'email') ?>

    <div class="form-group">
        <?= Html::submitButton('ENVIAR',['class'=>'btn btn-primary']) ?>
    </div>
<?php   ActiveForm::end();   ?>



