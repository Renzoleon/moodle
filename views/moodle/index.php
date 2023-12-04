<?php

// se importan algunas clases necesarias para la vista.
use yii\helpers\Html;
use yii\widgets\ActiveForm;

// Luego, se definen algunas variables que se utilizarán en la vista. Estas variables son proporcionadas por el controlador.

/* @var $decodedResponse app\controllers\MoodleController */
/* @var $usuarioModel app\models\Usuario */
/* @var $rolModel app\models\Rol */
///* @var $matriculaModel app\models\Matricula */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Crear Usuario & Asignar Rol';
$this->params['breadcrumbs'][] = ['label' => 'Usuario & Rol', 'url' => ['index']];
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
$dataRol = \yii\helpers\ArrayHelper::map(\app\models\MdlRole::find()->asArray()->all(),
    'id','shortname'
);

$dataContext = \yii\helpers\ArrayHelper::map(
    \app\models\MdlContext::find()
        ->select(['mdl_context.id', 'mdl_context.instanceid', 'mdl_course.fullname']) // selecciona el id de mdl_context, instanceid y fullname
        ->joinWith('course')
        ->where(['contextlevel' => '50'])
        ->asArray()
        ->all(),
    'id', function($element) {
        return $element['instanceid'] . ' - ' . $element['fullname']; // mapea el id de mdl_context a una cadena que combina instanceid y fullname
    }
);

?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>

<h3><?= Html::a('Crear nuevo Usuario') ?></h3>
<?= $form -> field($usuarioModel, 'username')->textInput(['autofocus' => true, 'maxlength' => true]) ?>
<?= $form -> field($usuarioModel, 'password') ?>
<?= $form -> field($usuarioModel, 'firstname') ?>
<?= $form -> field($usuarioModel, 'lastname') ?>
<?= $form -> field($usuarioModel, 'email') ?>

<h2><?= Html::a('Asignar un Rol al Usuario') ?></h2>
<?= $form -> field($rolModel,'role')->dropDownList($dataRol, ['prompt'=> 'Seleccione un Rol', 'autofocus' => true])  ?>
<?= $form -> field($rolModel,'context')->dropDownList($dataContext, ['prompt'=> 'Seleccione un Curso'])  ?>

<h2><?= Html::a('Asignar un Rol al Usuario') ?></h2>
<?php //= $form -> field($matriculaModel, 'role')->dropDownList($dataRol, ['prompt'=> 'Seleccione un Rol','autofocus' => true])  ?>

    <div class="form-group">
        <?= Html::submitButton('CREAR',['class'=>'btn btn-primary']) ?>
    </div>

<?php   ActiveForm::end();   ?>