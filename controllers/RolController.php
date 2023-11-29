<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\MdlRoleAssignments;
use yii\web\HttpException;
class RolController extends Controller
{
    public function actionCrear(MdlRoleAssignments $assignRolModel)
    {
        $url = 'localhost/moodle/webservice/rest/server.php';

        /* ********************************* *\
        ****  ASIGNAR UN ROL A UN USUARIO  ****
        \* ********************************* */
        $data = [
            'wstoken' => 'ec8703acaa85108f03b2717f35282556',
            'wsfunction' => 'core_role_assign_roles',
            'moodlewsrestformat' => 'json',
            'assignments' => [
                [
                    'roleid' => $assignRolModel->role, // ID del rol a asignar
                    'userid' => $assignRolModel->user, // ID del usuario
                    'contextid' => $assignRolModel->context, // ID del usuario
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
        $assignRolModel = new MdlRoleAssignments();
        if ($assignRolModel->load(Yii::$app->request->post())&&$assignRolModel->validate())
        {
            $mensaje= $this ->actionCrear($assignRolModel);

            return $this->render('index',['mensaje'=>$mensaje,'assignRolModel'=>$assignRolModel]);
        }
        return $this -> render('index',['assignRolModel'=>$assignRolModel]);
    }
}