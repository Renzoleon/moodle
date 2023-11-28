<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $decodedResponse app\controllers\MoodleController */
/* @var $model app\models\Usuario */
/* @var $usuario app\models\Usuario */
/* @var $curso app\models\Curso */
/* @var $rol app\models\Rol */
/* @var $matricula app\models\Matricula */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Crear un Usuario, Curso, Rol y Matricula';
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

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($usuario, 'username') ?>
<?= $form->field($usuario, 'password') ?>
<?= $form->field($usuario, 'firstname') ?>
<?= $form->field($usuario, 'lastname') ?>
<?= $form->field($usuario, 'email') ?>

<?= $form->field($curso, 'fullname') ?>
<?= $form->field($curso, 'shortname') ?>
<?= $form->field($curso, 'categoryid') ?>

<?= $form->field($rol, 'id') ?>

<?= $form->field($matricula, 'roleid') ?>



<div class="form-group">
    <?= Html::submitButton('CREAR',['class'=>'btn btn-primary']) ?>
</div>
<?php   ActiveForm::end();   ?>
