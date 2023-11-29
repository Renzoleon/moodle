<?php

use app\models\MdlCourseCategories;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $decodedResponse app\controllers\CursoController */
/* @var $cursoModel app\models\MdlCourse */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Crear un Curso';
$this->params['breadcrumbs'][] = ['label' => 'Cursos', 'url' => ['index']];
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
$dataCurso = ArrayHelper::map(MdlCourseCategories::find()->asArray()->all(),
    'id','name'
);
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="usuario-create">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form -> field($cursoModel, 'fullname')->textInput(['autofocus' => true, 'maxlength' => true]) ?>
    <?= $form -> field($cursoModel, 'shortname')->textInput(['maxlength' => true])  ?>
    <?= $form -> field($cursoModel, 'category')->dropDownList($dataCurso, ['prompt'=> 'Seleccione la Categoria'])  ?>

    <div class="form-group">
        <?= Html::submitButton('ENVIAR',['class'=>'btn btn-primary']) ?>
    </div>
    <?php   ActiveForm::end();   ?>
</div>
