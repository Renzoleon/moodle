<?php

use app\models\MdlCourseCategories;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $decodedResponse app\controllers\CursoController */
/* @var $model app\models\MdlCourseCategories */
/* @var $formulario yii\widgets\ActiveForm  */

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
<?php $formulario = ActiveForm::begin();  ?>
<?= $formulario -> field($model,'fullname')->textInput(['autofocus' => true, 'maxlength' => true, 'style' => 'text-transform: uppercase']) ?>
<?= $formulario -> field($model,'shortname')->textInput(['maxlength' => true, 'style' => 'text-transform: uppercase']) ?>
<?= $formulario -> field($model,'category')->dropDownList($dataCurso, ['prompt'=> 'Seleccione la Categoria'] ) ?>

<div class="form-group">
    <?= Html::submitButton('ENVIAR',['class'=>'btn btn-primary']) ?>
</div>
<?php   ActiveForm::end();   ?>
