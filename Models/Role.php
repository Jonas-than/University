<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Models/Model.php";

class Role extends Model
{
    protected $table = "roles";

    public function find($id) {

        $sql = "SELECT u.*, r.name AS role_name  
                FROM users AS u
                INNER JOIN roles AS r  
                  ON r.id = u.role_id  
                WHERE u.id = $id";
                 
        $result = $this->db->query($sql);
        
        return $result->fetch_assoc();
      
      }

      public function getRoles() {
        $sql = "SELECT * FROM roles";
        
        $result = $this->db->query($sql);
        
        return $result;
      }
}