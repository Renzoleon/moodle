<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception$exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
<!--        The above error occurred while the Web server was processing your request.-->
        Ha ocurrido un error mientras el Servidor Web estuvo procesando su solicitud.
    </p>
    <p>
<!--        Please contact us if you think this is a server error. Thank you.-->
        Comuníquese con nosotros si cree que se trata de un error del servidor. Gracias.
    </p>

</div>
