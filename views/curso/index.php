<?php

use app\models\MdlCourseCategories;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $decodedResponse app\controllers\CursoController */
/* @var $model app\models\MdlCourseCategories */
/* @var $formulario yii\widgets\ActiveForm */

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
    <?php $formulario = ActiveForm::begin();  ?>
    <?= $formulario -> field($model,'fullname')->textInput(['autofocus' => true, 'maxlength' => true, 'style' => 'text-transform: uppercase']) ?>
    <?= $formulario -> field($model,'shortname')->textInput(['maxlength' => true, 'style' => 'text-transform: uppercase']) ?>
    <?= $formulario -> field($model,'category')->dropDownList($dataCurso, ['prompt'=> 'Seleccione la Categoria'] ) ?>

    <div class="form-group">
        <?= Html::submitButton('ENVIAR',['class'=>'btn btn-primary']) ?>
    </div>
    <?php   ActiveForm::end();   ?>
</div>
