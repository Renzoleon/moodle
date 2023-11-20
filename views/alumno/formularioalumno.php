<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-vertical'],
])
?>
    <?= $form->field($model,'username')->textInput()->hint('Escribir nombre de usuario')->label('USER') ?>
    <?= $form->field($model,'password')->passwordInput()->hint('escribir contraseña')->label('PASSWORD') ?>
    <?= $form->field($model, 'items[]')->checkboxList(['a' => 'Item A', 'b' => 'Item B', 'c' => 'Item C']) ?>
    <?= $form->field($model, 'uploadFile[]')->fileInput(['archivo'=>'archivo']) ?>
    <?= $form->field($model,'category')->dropDownList([
            1 => 'item 1',
            2 => 'item 2',
], ['prompt'=>'Seleccionar categoria'] )   ?>
    <?= $form->field($model,'category')->radioList([
            1 => 'radio 1',
            2 => 'radio 2',
])    ?>
    <?= $form->field($model,'category')->checkboxList([
            1 => 'check 1',
            2 => 'check 2',
]) ?>
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Login',['class'=>'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>