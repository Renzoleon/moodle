<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $decodedResponse app\controllers\RolController */
/* @var $model app\models\Rol */
/* @var $form yii\widgets\ActiveForm */

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
    <?php $form = ActiveForm::begin();  ?>
    <?= $form -> field($model,'role')->textInput(['autofocus' => true, 'maxlength' => true]) ?>
    <?= $form -> field($model,'user')?>
    <?= $form -> field($model,'context')->textInput(['maxlength' => true])?>

    <div class="form-group">
        <?= Html::submitButton('ENVIAR',['class'=>'btn btn-primary']) ?>
    </div>
    <?php   ActiveForm::end();   ?>
</div>