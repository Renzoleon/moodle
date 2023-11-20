<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\Post;
use yii\web\View;
use yii\helpers\Url;
use yii\web\Request;
use yii\web\CookieCollection;

class PostController extends Controller
{

    public function actionView(array $id, $version=null)
    {
        $model = Post::findOne($id);
        if ($model === null)
        {
            throw new NotFoundHttpException;
        }
        return $this -> render('view',[
            'model'=> $model,
        ]);
    }
    public function actionCreate()
    {
        $model = new Post;
        if ($model -> load(Yii::$app->request->post())&& $model->save())
        {
            return $this -> redirect(['view','id'=>$model -> id]);
        }else{
            return $this -> render('create',[
                'model'=> $model,
            ]);
        }
    }
    public function actionPrueba()
    {
        $request = Yii::$app->response->content="Hello Word";
//        $session = Yii::$app->session;
        $cookies = Yii::$app->request->cookies;
        $language = $cookies->getValue('language','en');


            return $this->render('viewprueba',['request'=>$language]);


    }
    public function actionDownload()
    {
        return \Yii::$app->response->sendFile('/home/lsborstorio-fisi/Escritorio/conexion.php');
    }




}