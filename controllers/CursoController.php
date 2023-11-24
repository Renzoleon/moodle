<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\MdlCourse;
use yii\web\HttpException;
class CursoController extends Controller
{
    public function actionCrear($var1,$var2,$var3)
    {
        $url = 'localhost/moodle/webservice/rest/server.php';
        $data = [
            'wstoken' => 'de43ac95878f53463292936d2ed0edfa',
            'wsfunction' => 'core_course_create_courses',
            'moodlewsrestformat' => 'json',

            'courses[0][fullname]' => $var1,
            'courses[0][shortname]' => $var2,
            'courses[0][categoryid]' => $var3,
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
        $model = new MdlCourse();
        if ($model->load(Yii::$app->request->post())&&$model->validate())
        {
            $mensaje= $this ->actionCrear($model ->fullname,$model ->shortname,$model ->category);

            return $this->render('index',['mensaje'=>$mensaje,'model'=>$model]);
        }
        return $this -> render('index',['model'=>$model]);
    }
}
