<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\FormularioForm;

class SitioController extends Controller
{
    public function actionInicio()
    {
        $model = new FormularioForm;

        if ($model -> load(Yii::$app->request->post())&& $model -> validate())
        {
            $valorRespuesta = ("El resultado es: ".$model ->valorA + $model ->valorB);
            return $this->render('inicio',['mensaje'=>$valorRespuesta,'model'=>$model]);
        }

        return $this -> render('inicio',['mensaje'=>"",'model'=>$model]);
    }
}