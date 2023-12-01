<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $decodedResponse app\controllers\MatriculaController */
/* @var $matriculaModel app\models\MdlUserEnrolments */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Matricular a un Usuario';
$this->params['breadcrumbs'][] = ['label' => 'Matricula', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// ... código de la vista ...
if (isset($mensaje)) {
    echo '<pre>';
    print_r($_POST);
    var_dump($mensaje);
    echo '</pre>';
}

// AHORA TOCA HACER LA MATRICULA


// MDL_USER_ENROLMENTS
// USERID -> ES EL ID DEL USUARIO

// ENROLID -> ES EL CURSO DONDE ESTA MATRICULADO EL USER



// DEBO TRABAJAR CON LAS TABLAS DE MDL_ENROL Y MDL_USER_ENROLMENTS

// EXTRAER EL ID DEL CURSO
// LLEVAR EL ID DEL CURSO A MDL_ENROL->courseid
// FILTRAR EL COURSEID CON MDLENROL->ENROL->manual
// EXTRAER EL ID DE ENROL

?>

<?php
$dataUser = \yii\helpers\ArrayHelper::map(\app\models\MdlUser::find()->asArray()->all(),
    'id','username'
);
$dataEnrol = \yii\helpers\ArrayHelper::map(
    \app\models\MdlEnrol::find()
        ->select(['mdl_enrol.id', 'mdl_enrol.courseid', 'mdl_course.fullname']) // selecciona el id de mdl_enrol, courseid y fullname
        ->joinWith('course')
        ->where(['enrol' => 'manual'])
        ->asArray()
        ->all(),
    'id', function($element) {
        return $element['courseid'] . ' - ' . $element['fullname']; // mapea el id de mdl_context a una cadena que combina courseid y fullname
    }
);

?>


<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin();  ?>

<?= $form -> field($matriculaModel, 'user')->dropDownList($dataUser, ['prompt'=> 'Seleccione un Usuario','autofocus' => true])  ?>
<?= $form -> field($matriculaModel, 'course')->dropDownList($dataEnrol, ['prompt'=> 'Seleccione un Curso'])  ?>

<div class="form-group">
    <?= Html::submitButton('ENVIAR',['class'=>'btn btn-primary']) ?>
</div>
<?php   ActiveForm::end();   ?>
