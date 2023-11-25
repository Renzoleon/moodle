<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $decodedResponse app\controllers\MoodleController */
/* @var $model app\models\Usuario */
/* @var $formaulario yii\widgets\ActiveForm */

$this->title = 'Crear un Usuario';
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// ... código de la vista ...
if (isset($mensaje)) {
    echo '<pre>';
    print_r($_POST);
    var_dump($mensaje);
    echo '</pre>';
}

?>

<h1><?= Html::encode($this->title) ?></h1>
<div class="usuario-create">
    <?php  $formulario = ActiveForm::begin();  ?>
    <div class="usuario-row">
        <?= $formulario -> field($model,'username')->textInput(['autofocus' => true, 'maxlength' => true, 'style' => '
        text-transform: uppercase;    flex-shrink: 0;    flex: 0 0 auto;    width: 83.33333333%;']) ?>
    </div>
    <?= $formulario -> field($model,'password') ?>
    <?= $formulario -> field($model,'firstname') ?>
    <?= $formulario -> field($model,'lastname') ?>
    <?= $formulario -> field($model,'email') ?>

        <div class="form-group">
            <?= Html::submitButton('ENVIAR',['class'=>'btn btn-primary']) ?>
        </div>
    <?php   ActiveForm::end();   ?>
</div>

