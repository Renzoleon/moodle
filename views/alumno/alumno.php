<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
$this->title = 'Mi primera pagina';
?>
<h1>Alumnos</h1>>
<ul>
    <?php foreach ($alumnos as $alumno):  ?>
        <li>
            <?= Html::encode("{$alumno->alu_iCodigo}({$alumno->alu_vcNombre})") ?>:
            <?= $alumno->escpla_iNotas  ?>
        </li>>
    <?php endforeach;  ?>
</ul>

<?= LinkPager::widget(['pagination'=>$pagination]) ?>
