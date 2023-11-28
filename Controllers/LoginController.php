<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Models/User.php";

class LoginController
{
    protected $model;

    public function __construct()
    {
        $this->model = new User();
    }

    /**
     * Muestra una vista con el login.
     */
    public function index()
    {
        include $_SERVER["DOCUMENT_ROOT"] . "/views/login.php";
    }

    public function login($email, $password)
    {
        
        $usuario = $this->model->where("email", "=", $email);
        

        if (count($usuario) === 1) {
            // if(password_verify($password, $usuario[0]["password"])){
            session_start();
            $_SESSION["user"] = $usuario[0];

            header("Location: /dashboard");

        } else {
            echo "Credenciales incorrectas";
        }
    }

    public function storePassword($password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    }

    public function dashboard()
    {
        include $_SERVER["DOCUMENT_ROOT"] . "/views/dashboard.php";
    }

    public function logout() {
        
        session_start();
        session_destroy();
        

        // Redirigir a la página de inicio o a una página de login, según tu lógica
        header("Location: /index.php");
        exit();
    }
}