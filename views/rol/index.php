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
    print_r($_POST);
    var_dump($mensaje);
    echo '</pre>';
}

?>

<?php
$dataRol = \yii\helpers\ArrayHelper::map(\app\models\MdlRole::find()->asArray()->all(),
    'id','shortname'
);
$dataUser = \yii\helpers\ArrayHelper::map(\app\models\MdlUser::find()->asArray()->all(),
    'id','username'
);
$dataCurso = \yii\helpers\ArrayHelper::map(\app\models\MdlCourse::find()->asArray()->all(),
    'id','fullname'
);
?>

<h1><?= Html::encode($this->title) ?></h1>
<div class="rol-create">
    <?php $form = ActiveForm::begin();  ?>
    <?= $form -> field($assignRolModel,'role')->dropDownList($dataRol, ['prompt'=> 'Seleccione un Rol', 'autofocus' => true])  ?>
    <?= $form -> field($assignRolModel,'user')->dropDownList($dataUser, ['prompt'=> 'Seleccione un Usuario'])  ?>
    <?= $form -> field($assignRolModel,'context')->dropDownList($dataCurso, ['prompt'=> 'Seleccione un Curso'])  ?>

    <div class="form-group">
        <?= Html::submitButton('ENVIAR',['class'=>'btn btn-primary']) ?>
    </div>
    <?php   ActiveForm::end();   ?>
</div>