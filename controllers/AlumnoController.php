<?php

namespace app\controllers;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use app\models\Alumno;
use app\models\AlumnoForm;
class AlumnoController extends Controller
{
    public function actionIndex ()
    {
        $query = Alumno::find();
        $pagination =new Pagination([
           'defaultPageSize'=>5,
            'totalCount'=>$query->count(),
        ]);
        $alumnos = $query->orderBy('alu_iCodigo')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('alumno',['alumnos'=>$alumnos,'pagination'=>$pagination,]);

//        $consulta = $query->where(['alu_iCodigo'=>500])->exists();
//        $arreglo = $query->where(['>','alu_iCodigo',100])->exists();
//        $consulta2 = $query->limit(10)->offset(10)->asArray()->all();
//        return $this->render('alumnoprueba',['consulta'=>$consulta]);
//        echo '<pre>';
//        var_dump($arreglo);
//        echo '</pre>';

    }
    public function actionForm()
    {
        $model = new AlumnoForm;

        if ($model->load(Yii::$app->request->post())&& $model->validate()){
            Yii::$app->response->content='Se ingreso con exito';

        }else{
            return $this->render('formularioalumno',['model'=>$model]);
        }
    }

}