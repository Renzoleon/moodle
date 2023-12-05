<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $decodedResponse app\controllers\RolController */
/* @var $assignRolModel app\models\MdlRoleAssignments */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Asignar un Rol';
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// ... código de la vista ...
if (isset($mensaje)) {
    echo '<pre>';
    print_r($assignRolModel);
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
    return $element['fullname']; // mapea el id de mdl_context a una cadena que combina instanceid y fullname
}
);
$dataUser = \yii\helpers\ArrayHelper::map(\app\models\MdlUser::find()->asArray()->all(),
    'id','username'
);


?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin();  ?>
<?= $form -> field($assignRolModel,'role')->dropDownList($dataRol, ['prompt'=> 'Seleccione un Rol', 'autofocus' => true])  ?>
<?= $form -> field($assignRolModel,'context')->dropDownList($dataContext, ['prompt'=> 'Seleccione un Curso'])  ?>
<?= $form -> field($assignRolModel,'user')->dropDownList($dataUser, ['prompt'=> 'Seleccione un Usuario'])  ?>


<div class="form-group">
    <?= Html::submitButton('ENVIAR',['class'=>'btn btn-primary']) ?>
</div>
<?php   ActiveForm::end();   ?>