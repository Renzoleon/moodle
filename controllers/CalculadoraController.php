<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\CalculadoraForm;
use app\models\Post;

class CalculadoraController extends Controller
{

    public function actionCalcular()
    {
        $model = new CalculadoraForm;
        if ($model->load(Yii::$app->request->post())&&$model->validate())
        {
            $cadena1 = $model -> texto1;
            $cadena2 = $model -> texto2;
            $valorRespuesta = "$cadena1$cadena2";
            return $this -> renderFile('@app/views/site/prueba.php',['mensajeRespuesta'=>$valorRespuesta,'model'=>$model]);
        }
        return $this -> renderFile('@app/views/site/prueba.php',['mensajeRespuesta'=>'','model'=>$model]);
    }

}