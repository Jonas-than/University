<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Models/Model.php";

class User extends Model
{
    protected $table = "users";

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
    }
}