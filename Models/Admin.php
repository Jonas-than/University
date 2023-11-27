<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Models/Model.php";

class Admin extends Model
{
    protected $table = "users";

    public function update($data)
    {
        $allowed = ['email', 'role_id']; 
        // Esto hace que sin importar los pares de clave y valor de la variable $data, el $query sea reutilizable.

        session_start();
        $userId = $_SESSION['admin_id_edit'];

        $updatePairs = [];
        foreach ($data as $key => $value) {
            if (in_array($key, $allowed)) {
                $updatePairs[] = "$key = '$value'";
            }
        }
  
        $query = "UPDATE {$this->table} SET " . implode(", ", $updatePairs) . " WHERE id = $userId";
        $result = $this->db->query($query);
    }

    public function permisos()
    {
        $res = $this->db->query("SELECT 
        u.id,
        u.email,
        r.name as rol
        from 
        users u
        inner join roles r
        on r.id = u.role_id");
        $data = $res->fetch_all(MYSQLI_ASSOC);

        return $data;
    }


    public function find($id)
    {
        $sql = "SELECT u.*, r.name AS role_name  
                FROM users AS u
                INNER JOIN roles AS r  
                  ON r.id = u.role_id  
                WHERE u.id = $id";
                 
        $result = $this->db->query($sql);
        
        return $result->fetch_assoc();
    }
}