<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Models/Alumno.php";

class Alumno extends Model
{
    protected $table = "users";

    public function getAlumnos()
    {
        $res = $this->db->query("SELECT id, dni, name, email, address, birthday
        FROM users
        WHERE role_id = (SELECT id FROM roles WHERE name = 'alumno');");

        $data = $res->fetch_all(MYSQLI_ASSOC);
        return $data;
    }
}