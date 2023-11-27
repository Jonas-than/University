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
        CONCAT(u_maestro.name, ' ', u_maestro.lastname) AS nombre_maestro,
        GROUP_CONCAT(CONCAT(u_alumno.name, ' ', u_alumno.lastname) SEPARATOR ', ') AS alumnos_inscritos
    FROM
        courses c
    JOIN
        cursos_maestros cm ON c.id = cm.course_id
    JOIN
        users u_maestro ON cm.teacher_id = u_maestro.id
    LEFT JOIN
        courses_alumnos ca ON c.id = ca.course_id
    LEFT JOIN
        users u_alumno ON ca.student_id = u_alumno.id
    GROUP BY
        c.id, u_maestro.id;");

    $courses = $res->fetch_all(MYSQLI_ASSOC);
    return $courses;

    }
}