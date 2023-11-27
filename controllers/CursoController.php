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
        $nombreCorto = $var2;
        $url = 'http://172.16.243.43/moodle/webservice/rest/server.php';
        // Verificar si el curso existe
        $data = [
            'wstoken' => 'ec8703acaa85108f03b2717f35282556',
            'wsfunction' => 'core_course_get_courses_by_field',
            'moodlewsrestformat' => 'json',
            'field' => 'shortname',
            'values' => [$nombreCorto],
        ];
        // Configura las opciones de cURL
        $urlCompleta = $url. '?' .http_build_query($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlCompleta);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        $cursos = json_decode($result);
        if (empty($cursos->courses)) {
            // Crear curso
            $data = [
                'wstoken' => 'ec8703acaa85108f03b2717f35282556',
                'wsfunction' => 'core_course_create_courses',
                'moodlewsrestformat' => 'json',
                'courses' => [
                    [
                        'fullname' => $var1,
                        'shortname' => $nombreCorto,
                        'categoryid' => $var3,
                    ]
                ]
            ];
        }
        // Configura las opciones de cURL
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
    // Crear curso
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
