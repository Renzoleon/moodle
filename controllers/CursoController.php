<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\MdlCourse;
use yii\web\HttpException;

class CursoController extends Controller
{
    public function actionCrear(MdlCourse $cursoModel)
    {

        $url = 'http://172.16.243.43/moodle/webservice/rest/server.php';


        /* **************************** *\
        ****  CREAR UN CURSO NUEVO  ****
        \* **************************** */
        $data = [
            'wstoken' => 'ec8703acaa85108f03b2717f35282556',
            'wsfunction' => 'core_course_create_courses',
            'moodlewsrestformat' => 'json',
            'courses' => [
                [
                    'fullname' => $cursoModel->fullname,
                    'shortname' => $cursoModel->shortname,
                    'categoryid' => $cursoModel->category,
                ]
            ]
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
        $cursoModel = new MdlCourse();
        if ($cursoModel->load(Yii::$app->request->post())&&$cursoModel->validate())
        {
            $mensaje= $this ->actionCrear($cursoModel);

            return $this->render('index',['mensaje'=>$mensaje,'cursoModel'=>$cursoModel]);
        }
        return $this -> render('index',['cursoModel'=>$cursoModel]);
    }
}