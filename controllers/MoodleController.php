<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Usuario;
use app\models\MdlCourse;
use app\models\Rol;
use app\models\Matricula;

// Esta clase controla las acciones relacionadas con Moodle
class MoodleController extends Controller
{
    public function actionCrearUsuarioCursoYAsignarRolYMatricular(Usuario $usuario, MdlCourse $curso, Rol $rol, Matricula $matricula)
    {
        $username = $usuario->username;
        $courseShortName = $curso->shortname;
        $url = 'localhost/moodle/webservice/rest/server.php';
        // Verificar si el usuario existe
        $data = [
            'wstoken' => 'de43ac95878f53463292936d2ed0edfa',
            'wsfunction' => 'core_user_get_users_by_field',
            'moodlewsrestformat' => 'json',
            'field' => 'username',
            'values' => [$username],
        ];
        // Configura las opciones de cURL
        $urlCompleta = $url. '?' .http_build_query($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlCompleta);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        $usuarios = json_decode($result);
        if (empty($usuarios)) {
            // Crear usuario
            $data = [
                'wstoken' => 'de43ac95878f53463292936d2ed0edfa',
                'wsfunction' => 'core_user_create_users',
                'moodlewsrestformat' => 'json',
                'users' => [
                    [
                        'username' => $usuario->username,
                        'password' => $usuario->password,
                        'firstname' => $usuario->firstname,
                        'lastname' => $usuario->lastname,
                        'email' => $usuario->email
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
        }
        // Verificar si el curso existe
        $data = [
            'wstoken' => 'de43ac95878f53463292936d2ed0edfa',
            'wsfunction' => 'core_course_get_courses_by_field',
            'moodlewsrestformat' => 'json',
            'field' => 'shortname',
            'value' => $courseShortName,
        ];
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
                'wstoken' => 'de43ac95878f53463292936d2ed0edfa',
                'wsfunction' => 'core_course_create_courses',
                'moodlewsrestformat' => 'json',
                'courses' => [
                    [
                        'fullname' => $curso->fullname,
                        'shortname' => $curso->shortname,
                        'categoryid' => $curso->categoryid,
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
        }
        // Asignar rol
        $data = [
            'wstoken' => 'de43ac95878f53463292936d2ed0edfa',
            'wsfunction' => 'core_role_assign_roles',
            'moodlewsrestformat' => 'json',
            'assignments' => [
                [
                    'roleid' => $rol->id, // ID del rol a asignar
                    'userid' => $username, // ID del usuario
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
        // Matricular usuario en el curso
        $data = [
            'wstoken' => 'de43ac95878f53463292936d2ed0edfa',
            'wsfunction' => 'enrol_manual_enrol_users',
            'moodlewsrestformat' => 'json',
            'enrolments' => [
                [
                    'roleid' => $matricula->roleid, // ID del rol a asignar
                    'userid' => $username, // ID del usuario
                    'courseid' => $courseShortName, // ID del curso
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
    }
}

?>
