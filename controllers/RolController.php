<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Rol;
use yii\web\HttpException;
class RolController extends Controller
{
    public function actionCrear($var1,$var2,$var3)
    {
        $url = 'localhost/moodle/webservice/rest/server.php';
        $data = [
            'wstoken' => 'ec8703acaa85108f03b2717f35282556',
            'wsfunction' => 'core_role_assign_roles',
            'moodlewsrestformat' => 'json',

            'assignments[0][roleid]' => $var1,
            'assignments[0][userid]' => $var2,
            'assignments[0][contextid]' => $var3,
        ];
        $urlCompleta = $url. '?' .http_build_query($data);
        $ch = curl_init();

        // Configura las opciones de cURL
        curl_setopt($ch, CURLOPT_URL, $urlCompleta);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);

        // Ejecuta la solicitud y obtén la respuesta
        $response = curl_exec($ch);

        // Verifica si hay errores cURL
        if ($response === false) {
            $error = curl_error($ch);
            $errorNo = curl_errno($ch);

            Yii::error('Error en la solicitud cURL (' . $errorNo . '): ' . $error);
            throw new HttpException(500, 'Error en la conexión con Moodle: ' . $error);
        }

        // Cierra la conexión cURL
        curl_close($ch);

        // Decodifica la respuesta JSON
        $decodedResponse = json_decode($response, true);
        return $decodedResponse;
    }
    public function actionIndex()
    {
        $model = new Rol();
        if ($model->load(Yii::$app->request->post())&&$model->validate())
        {
            $mensaje= $this ->actionCrear($model ->role,$model ->user, $model ->context);

            return $this->render('index',['mensaje'=>$mensaje,'model'=>$model]);
        }
        return $this -> render('index',['model'=>$model]);
    }
}