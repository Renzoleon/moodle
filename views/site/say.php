<?php
use yii\helpers\Html;

$this->title = 'Ejemplo de Vista';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-ejemplo">
    <h1><?= Html::encode($message) ?></h1>

    <p>
        Esta es una vista de ejemplo en Yii.
    </p>

    <div class="alert alert-info">
        <strong>Importante:</strong> ¡Yii es genial!
    </div>

    <div class="alert alert-success">
        <strong>Éxito:</strong> ¡Tu vista se ve genial!
    </div>

    <p>
        <?= Html::a('Volver a la página principal', ['site/index'], ['class' => 'btn btn-primary']) ?>
    </p>
</div>

<style>
    .site-ejemplo {
        margin: 20px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    h1 {
        color: #333;
        font-size: 24px;
    }

    .alert {
        margin-top: 15px;
        padding: 15px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-info {
        background-color: #d9edf7;
        border-color: #bce8f1;
        color: #31708f;
    }

    .alert-success {
        background-color: #dff0d8;
        border-color: #d6e9c6;
        color: #3c763d;
    }
</style>
