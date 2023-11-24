<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Usuario;
use yii\web\HttpException;
class MoodleController extends Controller
{
    public function actionCrear($var1,$var2,$var3,$var4,$var5)
    {
        // $url = 'http://172.16.243.43/moodle/webservice/rest/server.php';
        $url = 'localhost/moodle/webservice/rest/server.php';
        $data = [
            // 'wstoken' => 'ec8703acaa85108f03b2717f35282556',
            'wstoken' => 'de43ac95878f53463292936d2ed0edfa',
            'wsfunction' => 'core_user_create_users',
            'moodlewsrestformat' => 'json',

            'users[0][username]' => $var1,
            'users[0][password]' => $var2,
            'users[0][firstname]' => $var3,
            'users[0][lastname]' => $var4,
            'users[0][email]' => $var5,
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
        $model = new Usuario();
        if ($model->load(Yii::$app->request->post())&&$model->validate())
        {
            $mensaje= $this ->actionCrear($model ->username,$model ->password,$model ->firstname,$model ->lastname,$model ->email);

            return $this->render('index',['mensaje'=>$mensaje,'model'=>$model]);
        }
        return $this -> render('index',['model'=>$model]);
    }
}
