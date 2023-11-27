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

    // public function update($data)
    // {
    //     $updatePairs = [];

    //     foreach ($data as $key => $value) {
    //         $updatePairs[] = "$key = '$value'";
    //     }

    //     session_start();
        
    // // Actualizar la tabla 'users'
    // $queryUsers = "UPDATE {$this->table}
    // SET " . implode(', ', $updatePairs) . "
    // WHERE id = {$_SESSION["teacher_id_edit"]}";

    // // Actualizar la tabla 'course_teachers'
    // $queryCourseTeachers = "UPDATE course_teachers
    // SET course_id = {$_SESSION["teacher_id_edit"]}
    // WHERE teacher_id = {$_SESSION["teacher_id_edit"]}";
        
    //     $this->db->begin_transaction();

    //     try {
    //         $this->db->query($queryUsers);
    //         $this->db->query($queryCourseTeachers);
    
    //         // Confirmar la transacción si todo está bien
    //         $this->db->commit();
    //     } catch (Exception $e) {
    //         // Revertir la transacción en caso de error
    //         $this->db->rollback();
    //         echo "Error: " . $e->getMessage();
    //     }
    // }

     public function update($data)
    {
        // $updatePairs = [];

        // foreach ($data as $key => $value) {
        //     $updatePairs[] = "$key = '$value'";
        // }

        // $query = "UPDATE cursos_maestros SET " . implode(", ", $updatePairs) . " WHERE id = {$data['id']}";
        // $this->db->query($query);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recuperar datos del formulario
            $nombre = $_POST["name"];
            $direccion = $_POST["address"];
            $fecha_nacimiento = $_POST["birthday"];
            $course_id = $_POST["course_id"];
        
            // Realizar la conexión a la base de datos (asegúrate de tener las credenciales correctas)
            $mysqli = new mysqli("localhost", "root", "", "university");
        
            // Verificar la conexión
            if ($mysqli->connect_error) {
                die("Conexión fallida: " . $mysqli->connect_error);
            }
        
            // Iniciar una transacción
            $mysqli->begin_transaction();
        
            try {
                // ID del maestro que deseas actualizar (reemplaza con la lógica adecuada)
                session_start();

                $maestro_id = $_SESSION["teacher_id_edit"];
        
                // Escapar y sanear los datos (ten en cuenta que esta no es la mejor práctica, pero es una forma de mitigar la inyección de SQL)
                $nombre = $mysqli->real_escape_string($nombre);
                $direccion = $mysqli->real_escape_string($direccion);
                $fecha_nacimiento = $mysqli->real_escape_string($fecha_nacimiento);
        
                // Consulta de actualización para la tabla users
                $query_users = "UPDATE users SET
                                name = '$nombre',
                                address = '$direccion',
                                birthday = '$fecha_nacimiento'
                                WHERE id = $maestro_id";
        
                // Consulta de actualización para la tabla cursos_maestros
                $query_cursos_maestros = "UPDATE cursos_maestros SET
                                          clase_id = $course_id
                                          WHERE maestro_id = $maestro_id";
        
                // Ejecutar las consultas
                $mysqli->query($query_users);
                $mysqli->query($query_cursos_maestros);
        
                // Confirmar la transacción
                $mysqli->commit();
        
                echo "Maestro actualizado con éxito.";
            } catch (Exception $e) {
                // Revertir la transacción en caso de error
                $mysqli->rollback();
        
                echo "Error al actualizar el maestro: " . $e->getMessage();
            }
        
            // Cerrar la conexión
            $mysqli->close();
    }
    
    }

    public function create($data)
    {
        try {
            // Iniciar la transacción
            $this->db->begin_transaction();
    
            // Escapar y sanear los datos (esto no es la mejor práctica, pero es una forma de mitigar la inyección de SQL)
            $escapedData = [];
            foreach ($data as $key => $value) {
                $escapedData[$key] = $this->db->real_escape_string($value);
            }
    
            // Crear el maestro en la tabla users
            $keysString = implode(", ", array_keys($escapedData));
            $valuesString = implode("', '", array_values($escapedData));
    
            $queryUser = "INSERT INTO users ($keysString) VALUES ('$valuesString')";
            $resUser = $this->db->query($queryUser);
    
            if (!$resUser) {
                throw new Exception("No se pudo crear el maestro en la tabla users");
            }
    
            // Obtener el ID del maestro recién insertado
            $maestroId = $this->db->insert_id;
    
            // Crear la asignación de clase en la tabla cursos_maestros
            $claseId = $escapedData['course_id']; // Asegúrate de que el formulario proporcione el ID de la clase
            $queryCursosMaestros = "INSERT INTO cursos_maestros (maestro_id, course_id) VALUES ('$maestroId', '$claseId')";
            $resCursosMaestros = $this->db->query($queryCursosMaestros);
    
            if (!$resCursosMaestros) {
                throw new Exception("No se pudo asignar la clase al maestro en la tabla cursos_maestros");
            }
    
            // Confirmar la transacción
            $this->db->commit();
    
            // Devolver el maestro creado
            $data = $this->find($maestroId);
            return $data;
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            $this->db->rollback();
    
            // Devolver el mensaje de error
            return "Error: " . $e->getMessage();
        }
    }
}