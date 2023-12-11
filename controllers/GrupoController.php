<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\MdlGroups;
use yii\web\HttpException;

class GrupoController extends Controller
{
    public function actionCrear(MdlGroups $grupoModel)
    {

        $url = 'http://172.16.243.43/moodle/webservice/rest/server.php';

        /* **************************** *\
        ****  CREAR UN GRUPO NUEVO  ****
        \* **************************** */
        $data = [
            'wstoken' => 'ec8703acaa85108f03b2717f35282556',
            'wsfunction' => 'core_group_create_groups',
            'moodlewsrestformat' => 'json',
            'groups' => [
                [
                    'courseid' => $grupoModel->course,
                    'name' => $grupoModel->name,
                    'description' => $grupoModel->description,
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
        $grupoModel = new MdlGroups();
        if ($grupoModel->load(Yii::$app->request->post())&&$grupoModel->validate())
        {
            $mensaje= $this ->actionCrear($grupoModel);

            return $this->render('index',['mensaje'=>$mensaje,'grupoModel'=>$grupoModel]);
        }
        return $this -> render('index',['grupoModel'=>$grupoModel]);
    }
}