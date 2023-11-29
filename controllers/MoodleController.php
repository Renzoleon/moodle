<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Usuario;
use app\models\Rol;
use yii\web\HttpException;

class MoodleController extends Controller
{
    public function actionCrear(Usuario $usuarioModel, Rol $rolModel)
    {
        $url = 'http://172.16.243.43/moodle/webservice/rest/server.php';

        /* **************************** *\
        ****  CREAR UN USUARIO NUEVO  ****
        \* **************************** */
        $data = [
            'wstoken' => 'ec8703acaa85108f03b2717f35282556',
            'wsfunction' => 'core_user_create_users',
            'moodlewsrestformat' => 'json',
            'users' => [
                [
                    'username' => $usuarioModel->username,
                    'password' => $usuarioModel->password,
                    'firstname' => $usuarioModel->firstname,
                    'lastname' => $usuarioModel->lastname,
                    'email' => $usuarioModel->email
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

        // Cierra la conexión cURL
        curl_close($ch);

        // Decodifica la respuesta JSON
        $decodedResponse = json_decode($response, true);

        // Guarda el ID del usuario creado
        $userId = $decodedResponse[0]['id'];

        /* ***************************** *\
        ****  VALIDAR UN USUARIO  ****
        \* ***************************** */
        $data = [
            'wstoken' => 'ec8703acaa85108f03b2717f35282556',
            'wsfunction' => 'core_user_get_users',
            'moodlewsrestformat' => 'json',
            'criteria' => [
                [
                    'key' => 'username',
                    'value' => $usuarioModel->username,
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

        // Cierra la conexión cURL
        curl_close($ch);

        // Decodifica la respuesta JSON
        $decodedResponse = json_decode($response, true);

        // Verifica si el usuario existe
        if (empty($decodedResponse['users'])) {
            throw new HttpException(404, 'Usuario no encontrado: ' . $usuarioModel->username);
        }

        // El usuario existe, puedes continuar con la asignación del rol

        /* ********************************* *\
        ****  ASIGNAR UN ROL A UN USUARIO  ****
        \* ********************************* */
        $data = [
            'wstoken' => 'ec8703acaa85108f03b2717f35282556',
            'wsfunction' => 'core_role_assign_roles',
            'moodlewsrestformat' => 'json',
            'assignments' => [
                [
                    'roleid' => $rolModel->role, // ID del rol a asignar
                    'userid' => $userId, // ID del usuario
                    'contextid' => $rolModel->context, // ID del usuario
                ]
            ]
        ];
        $urlCompleta = $url. '?' .http_build_query($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlCompleta);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_exec($ch);
        curl_close($ch);
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
        $usuarioModel = new Usuario(); // Inicializa el modelo de Usuario
        $usuarioModel->load(Yii::$app->request->post());
        $usuarioModel->validate();

        $rolModel = new Rol(); // Inicializa el modelo de Rol
        $rolModel->load(Yii::$app->request->post());
        $rolModel->validate();

        if ($usuarioModel->validate() && $rolModel->validate()) {

            $mensaje= $this ->actionCrear($usuarioModel, $rolModel);

            return $this->render('index', ['mensaje'=>$mensaje,'usuarioModel' => $usuarioModel, 'rolModel' => $rolModel]);
        }

        return $this->render('index', ['usuarioModel' => $usuarioModel, 'rolModel' => $rolModel]);
    }


}

?>