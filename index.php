<?php
// ENRUTADOR
require_once "./Controllers/LoginController.php";
require_once "./Controllers/UserController.php";
require_once "./Controllers/MaestroController.php";
require_once "./Controllers/RolesController.php";
require_once "./Controllers/AlumnoController.php";
require_once "./Controllers/CursoController.php";
require_once "./Controllers/AdminController.php";


$loginController = new LoginController();
$userController = new UserController();
$adminController = new AdminController();
$maestroController = new MaestroController();
$cursoController = new CursoController();
$roleController = new RoleController();
$alumnoController = new AlumnoController();


// Dividimos la ruta por el signo "?" para no leer los query params. Ejem: /clientes?id=1
$route = explode("?", $_SERVER["REQUEST_URI"]);

$method = $_SERVER["REQUEST_METHOD"];


if ($method === "POST") {
    switch ($route[0]) {
        case '/login':
            $loginController->login($_POST["email"], $_POST["password"]);
            break;



        case '/permisos/update':
            $adminController->update($_POST);
            break;



        case '/maestros/update':
            $maestroController->update($_POST);
            break;

            case '/maestros/create':
                $maestroController->store($_POST);
                break;

            case '/maestros/delete':
                $maestroController->delete($_POST["id"]);
                break;



        case '/alumnos/update':
            $alumnoController->update($_POST);
            break;
        
            case '/alumnos/create':
                $alumnoController->store($_POST);
                break;
        
            case '/alumnos/delete':
                $alumnoController->delete($_POST["id"]);
                break;
        


        default:
            echo "NO ENCONTRAMOS LA RUTA.";
            break;
    }
}

if ($method === "GET") {
    switch ($route[0]) {
        case '/index.php':
            $loginController->index();
            break;

        case '/dashboard':
            $loginController->dashboard();
            break;



        case '/permisos':
            $adminController->index();
            break;

            case '/permisos/edit':
                $adminController->edit($_GET["id"]);
                break;




        case '/maestros':
            $maestroController->index();
            break;

            case '/maestros/edit':
                $maestroController->edit($_GET["id"]);
                break;

            case '/maestros/create':
                $maestroController->create();
                break;
                



        case '/alumnos':
            $alumnoController->index();
            break;



            
        case '/cursos':
            $cursoController->index();
            break;

                       
       

        default:
            echo "NO ENCONTRAMOS LA RUTA.";
            break;
    }
}