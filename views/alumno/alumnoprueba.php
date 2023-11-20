<?php
use yii\helpers\Html;
?>
<h1> prueba 2 </h1>

<ul>
    <?php foreach ($consulta as $alumno): ?>
        <li><?= Html::encode($alumno->nombre) ?></li>
    <?php endforeach; ?>
</ul>
