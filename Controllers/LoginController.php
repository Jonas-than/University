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

    public function login($email, $password, $isHashed = false)
    {

        $usuario = $this->model->where("email", "=", $email);

    if (count($usuario) === 1) {
        $storedPassword = $usuario[0]["password"];

        
        if ($isHashed) {
            
            if (password_verify($password, $storedPassword)) {
                session_start();
                $_SESSION["user"] = $usuario[0];
                header("Location: /dashboard");
            } else {
                echo "Credenciales incorrectas";
            }
        } else {
            
            if ($password === $storedPassword) {
                session_start();
                $_SESSION["user"] = $usuario[0];
                header("Location: /dashboard");
            } else {
                echo "Credenciales incorrectas";
            }
        }
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
        
        header("Location: /index.php");
        exit();
    }
}