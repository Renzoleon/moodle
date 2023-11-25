<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $decodedResponse app\controllers\RoleController */
/* @var $model app\models\Rol */
/* @var $formulario yii\widgets\ActiveForm */

$this->title = 'Crear un Rol';
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
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
<div class="rol-create">
    <?php $formulario = ActiveForm::begin();  ?>
    <?= $formulario -> field($model,'roleid')->textInput(['autofocus' => true, 'maxlength' => true]) ?>
    <?= $formulario -> field($model,'userid')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('ENVIAR',['class'=>'btn btn-primary']) ?>
    </div>
    <?php   ActiveForm::end();   ?>
</div>
