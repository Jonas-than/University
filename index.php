<?php
// ENRUTADOR
require_once "./Controllers/LoginController.php";
require_once "./Controllers/UserController.php";


$loginController = new LoginController();
$userController = new UserController();


// Dividimos la ruta por el signo "?" para no leer los query params. Ejem: /clientes?id=1
$route = explode("?", $_SERVER["REQUEST_URI"]);

$method = $_SERVER["REQUEST_METHOD"];


if ($method === "POST") {
    switch ($route[0]) {
        case '/login':
            $loginController->login($_POST["email"], $_POST["password"]);
            break;

        case '/permisos/update':
            $userController->update($_POST);
            break;

        // case '/clientes/create':
        //     $clienteController->store($_POST);
        //     break;

        // case '/clientes/update':
        //     $clienteController->update($_POST);
        //     break;

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
            $userController->permiso();
            break;

            case '/permisos/edit':
                $userController->edit($_GET["id"]);
                break;

        case '/maestros':
            $userController->maestro();
            break;
                
        case '/alumnos':
            $userController->alumno();
            break;

        case '/clases':
            $userController->clase();
            break;

                       
       

        default:
            echo "NO ENCONTRAMOS LA RUTA.";
            break;
    }
}