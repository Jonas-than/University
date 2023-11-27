<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Models/User.php";

class UserController
{
    protected $model;
    protected $options;

    public function __construct()
    {
        $this->model = new User();
    }

    public function updateMaestros($request)
    {
        $teacherId = $request['id'];
    $name = $request['name'];
    $address = $request['address'];
    $birthday = $request['birthday'];
    $courseId = $request['course_id'];

        $success = $this->model->updateMaestro($teacherId, $name, $address, $birthday, $courseId);

    // Redirecciona según el resultado de la actualización
    if ($success) {
        header("Location: /maestros");
        exit;

    }
}

    /**
     * Guarda el registro de un nuevo cliente y envía al usuario a /clientes.
     * 
     * @param array $request Datos del cliente nuevo
     */
    public function store($request)
    {
        $response = $this->model->create($request);

        header("Location: /clientes");
    }

    /**
     * Eliminar el registro de un cliente y envía al usuario a /clientes.
     */
    public function delete($id)
    {
        $this->model->destroy($id);

        header("Location: /clientes");
    }

    public function editTeacher($id)
    {
        $teacher = $this->model->find($id);
        $classes = $this->model->getCourses();

        include $_SERVER["DOCUMENT_ROOT"] . "/views/maestros/edit.php";
    }
    
}