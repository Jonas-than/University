<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Models/Model.php";

class Curso extends Model
{
    protected $table = "courses";

    public function getCourses()
    {
    $result = $this->db->query("SELECT * FROM courses");
    $courses = $result->fetch_all(MYSQLI_ASSOC);
    return $courses;
    }

    public function all()
    {
        $res = $this->db->query("SELECT
        c.id AS curso_id,
        c.name AS nombre_curso,
        u_maestro.name AS nombre_maestro,
        COUNT(u_alumno.name) AS alumnos_inscritos
    FROM
        courses c
    LEFT JOIN
        cursos_maestros cm ON c.id = cm.course_id
    LEFT JOIN
        users u_maestro ON cm.maestro_id = u_maestro.id
    LEFT JOIN
        courses_alumnos ca ON c.id = ca.course_id
    LEFT JOIN
        users u_alumno ON ca.alumno_id = u_alumno.id
    GROUP BY
        c.id, u_maestro.id;");

    $courses = $res->fetch_all(MYSQLI_ASSOC);
    return $courses;

    }

    

    public function find($id)
    {
        $res = $this->db->query("SELECT c.id, c.name AS nombre_clase, u.name AS nombre_maestro
        FROM courses c
        LEFT JOIN cursos_maestros cm ON c.id = cm.course_id
        LEFT JOIN users u ON cm.maestro_id = u.id
        WHERE c.id = $id;");

        $classes = $res->fetch_assoc();
        return $classes;

    }


    public function update($data)
    {

        session_start();
        $curso_id = $_SESSION["curso_id_edit"];
        

        if (isset($data['maestro_asignado'])) {
            $maestro_id = $data['maestro_asignado'];

            $existingRelationQuery = "SELECT * FROM cursos_maestros WHERE course_id = $curso_id";
            $existingRelationResult = $this->db->query($existingRelationQuery);
            
            if ($existingRelationResult->num_rows > 0) {
                $queryMaestros = "UPDATE cursos_maestros SET maestro_id = $maestro_id WHERE course_id = $curso_id";
            } else {
                $queryMaestros = "INSERT INTO cursos_maestros (course_id, maestro_id) VALUES ($curso_id, $maestro_id)";
            }
    
            $this->db->query($queryMaestros);
        }
        
        if(isset($data['materia'])){
            $nombre = $data['materia'];
            $queryCourses = "UPDATE {$this->table} SET name = '$nombre' WHERE id = $curso_id";
            $this->db->query($queryCourses);
        }

        session_destroy();
    }


    public function destroy($id)
    {
        $this->db->query("DELETE FROM {$this->table} WHERE id = $id");
    }

    public function create($data)
    {
        try {
            $nombre = $data['materia'];
            $maestro_id = $data['maestro_id'];

            $queryCourses = "INSERT INTO {$this->table} (name) VALUES ('$nombre')";
            $resCourses = $this->db->query($queryCourses);

            if (!$resCourses) {
                throw new Exception("No se pudo crear el curso");
            }

            $curso_id = $this->db->insert_id;

            $queryMaestros = "INSERT INTO cursos_maestros (course_id, maestro_id) VALUES ($curso_id, $maestro_id)";
            $resMaestros = $this->db->query($queryMaestros);

            $data = $this->find($curso_id);
            
            return $data;
        
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}