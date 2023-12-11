<?php

use app\models\MdlCourse;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $decodedResponse app\controllers\GrupoController */
/* @var $grupoModel app\models\MdlGroups */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Crear un Grupo';
$this->params['breadcrumbs'][] = ['label' => 'Grupos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// ... código de la vista ...
if (isset($mensaje)) {
    echo '<pre>';
    print_r($_POST);
    var_dump($mensaje);
    echo '</pre>';
}

?>

<?php
$dataCurso = ArrayHelper::map(MdlCourse::find()->asArray()->all(),
    'id','fullname'
);
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="usuario-create">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form -> field($grupoModel, 'course')->dropDownList($dataCurso, ['prompt'=> 'Selecciona un curso', 'autofocus' => true, 'maxlength' => true]) ?>
    <?= $form -> field($grupoModel, 'name') ?>
    <?= $form -> field($grupoModel, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton('ENVIAR',['class'=>'btn btn-primary']) ?>
    </div>
    <?php   ActiveForm::end();   ?>
</div>
