<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\MdlUserEnrolments;
use yii\web\HttpException;

class MatriculaController extends Controller
{
    public function actionCrear(MdlUserEnrolments $matriculaModel)
    {

        $url = 'http://172.16.243.43/moodle/webservice/rest/server.php';

        /* ***************************** *\
        ****  MATRICULAR A UN USUARIO  ****
        \* ***************************** */
        $data = [
            'wstoken' => 'ec8703acaa85108f03b2717f35282556',
            'wsfunction' => 'enrol_manual_enrol_users',
            'moodlewsrestformat' => 'json',
            'enrolments' => [
                [
                    'roleid' => 5, // ID del rol de estudiante
                    'userid' => $matriculaModel->user,
                    'courseid' => $matriculaModel->course,
                ]
            ]
        ];

        $urlCompleta = $url. '?' .http_build_query($data);
        $ch = curl_init();
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

        // Decodifica la respuesta JSON
        $decodedResponse = json_decode($response, true);

        return $decodedResponse;
    }

    public function actionIndex()
    {
        $matriculaModel = new MdlUserEnrolments(); // Inicializa el modelo de Matricula

        if ($matriculaModel->load(Yii::$app->request->post())&&$matriculaModel->validate())
        {
            $mensaje= $this ->actionCrear($matriculaModel);

            return $this->render('index',['mensaje'=>$mensaje,'matriculaModel'=>$matriculaModel]);
        }
        return $this -> render('index',['matriculaModel'=>$matriculaModel]);
    }
}
