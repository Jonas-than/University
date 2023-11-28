<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Models/Model.php";

class Maestro extends Model
{
    protected $table = "users";

    public function getMaestros()
    {
        $res = $this->db->query("SELECT u.*, COALESCE(c.name, 'Sin asignación') AS assigned_class  
        FROM users u  
        INNER JOIN roles r ON r.id = u.role_id
        LEFT JOIN cursos_maestros cm ON cm.maestro_id = u.id 
        LEFT JOIN courses c ON c.id = cm.course_id
        WHERE r.name = 'maestro'") ;
        $data = $res->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    public function find($id)
    {
        $id = $this->db->real_escape_string($id);
        $res = $this->db->query("SELECT
        u.id,
        u.name,
        u.email,
        u.address,
        u.birthday,
        c.name AS assigned_class
    FROM
        users u
    LEFT JOIN
        cursos_maestros cm ON cm.maestro_id = u.id
    LEFT JOIN
        courses c ON c.id = cm.course_id
    WHERE
        u.id = '$id';");

        if ($res) {
        $data = $res->fetch_all(MYSQLI_ASSOC);

        if (!empty($data)) {
            // Devuelve un array con un solo elemento si hay un resultado
            return $data[0];
        } else {
            // Devuelve un array vacío si no hay resultados
            return $data;
        }
        }
    }


     public function update($data)
    {
        session_start();
        
        $curso_id = $data["course_id"];
    
        
        if (isset($data['id'])) {
            $maestro_id = $data['id'];
    
            
            $existingRelationQuery = "SELECT * FROM cursos_maestros WHERE course_id = $curso_id";
            $existingRelationResult = $this->db->query($existingRelationQuery);
    
            if ($existingRelationResult->num_rows > 0) {
                $queryMaestros = "UPDATE cursos_maestros SET maestro_id = $maestro_id WHERE course_id = $curso_id";
            } else {
                $queryMaestros = "INSERT INTO cursos_maestros (course_id, maestro_id) VALUES ($curso_id, $maestro_id)";
            }
    
            $this->db->query($queryMaestros);
        }
    
        if (isset($data['name']) && isset($data['address']) && isset($data['birthday'])) {
            $nombre = $data['name'];
            $direccion = $data['address'];
            $fechaNacimiento = $data['birthday'];
    
            $queryMaestro = "UPDATE users SET name = '$nombre', address = '$direccion', birthday = '$fechaNacimiento' WHERE id = $maestro_id";
            $this->db->query($queryMaestro);
        }
    
        session_destroy();
    
    }

    //modificar esta funcion
    public function create($data)
    {
        // try {
            
        //     $nombreMaestro = $data['name'];
        //     $emailMaestro = $data['email'];
        //     $direccionMaestro = $data['address'];
        //     $fechaNacimientoMaestro = $data['birthday'];
    
            
        //     $queryMaestro = "INSERT INTO users (name, email, address, birthday) VALUES ('$nombreMaestro', '$emailMaestro', '$direccionMaestro', '$fechaNacimientoMaestro')";
        //     $resMaestro = $this->db->query($queryMaestro);
    
        //     if (!$resMaestro) {
        //         throw new Exception("No se pudo crear el maestro");
        //     }
    
        //     $maestro_id = $this->db->insert_id;
    
    
        //     $queryAsignarRol = "INSERT INTO users (id, role_id) VALUES ($maestro_id, 2)";
        //     $resAsignarRol = $this->db->query($queryAsignarRol);
    
        //     if (!$resAsignarRol) {
        //         throw new Exception("No se pudo asignar el rol de maestro al usuario");
        //     }
    
        //     $curso_id = $data['course_id'];  
    
            
        //     $queryAsignacion = "INSERT INTO cursos_maestros (course_id, maestro_id) VALUES ($curso_id, $maestro_id)";
        //     $resAsignacion = $this->db->query($queryAsignacion);
    
        //     if (!$resAsignacion) {
        //         throw new Exception("No se pudo asignar el maestro a la clase");
        //     }
    
        //     $data = $this->find($curso_id);
    
        //     return $data;
    
        // } catch (mysqli_sql_exception $e) {
        //     echo "Error: " . $e->getMessage();
        // } catch (Exception $e) {
        //     echo "Error: " . $e->getMessage();
        // }
        try {
            
            $data['role_id'] = 2;
    
            // Esto hace que sin importar los pares de clave y valor de la variable $data, el $query sea reutilizable.
            $keys = array_keys($data);
            $keysString = implode(", ", $keys);
    
            $values = array_values($data);
    
            
            $escapedValues = array_map(function($value) {
                return $this->db->real_escape_string($value);
            }, $values);
    
            $valuesString = implode("', '", $escapedValues);
    
            
            $query = "INSERT INTO {$this->table}($keysString) VALUES ('$valuesString')";
            $res = $this->db->query($query);
    
            if ($res) {
                
                $ultimoIdMaestro = $this->db->insert_id;
    
               
                $claseId = $data['course_id']; 
    
                $queryAsignacion = "INSERT INTO cursos_maestros (course_id, maestro_id) VALUES ('$claseId', '$ultimoIdMaestro')";
                $resAsignacion = $this->db->query($queryAsignacion);
    
                if ($resAsignacion) {
                    $data = $this->find($ultimoIdMaestro);
                    return $data;
                } else {
                    return "Error al asignar la clase al maestro";
                }
            } else {
                return "No se pudo crear el maestro";
            }
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function destroy($id)
    {
        $this->db->query("DELETE FROM {$this->table} WHERE id = $id");
    }
}