<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/models/Maestro.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Models/Role.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Models/Curso.php";


class MaestroController
{
    protected $model;
    protected $role;
    protected $curso;

    public function __construct()
    {
        $this->model = new Maestro();
        $this->role = new Role();
        $this->curso = new Curso();
    }

    /**
     * Muestra una vista con todos los maestros.
     */
    public function index()
    {
        $teachers = $this->model->getMaestros();
        

        include $_SERVER["DOCUMENT_ROOT"] . "/views/maestros/read.php";
    }

    /**
     * Muestra un formulario para crear un nuevo maestro.
     */
    public function create()
    {
        
        $cursos = $this->curso->getCourses();
        include $_SERVER["DOCUMENT_ROOT"] . "/views/maestros/create.php";
    }

    /**
     * Muestra un formulario para editar un maestro.
     */
    public function edit($id)
    {
        $teacher = $this->model->find($id);
        $cursos = $this->curso->getCourses();

        include $_SERVER["DOCUMENT_ROOT"] . "/views/maestros/edit.php";
    }

    /**
     * Actualiza los datos de un maestro y envía al usuario a /maestros.
     */
    public function update($data)
    {

            $data = [
                'id' => $_POST['id'],
                'name' => $_POST['name'],
                'address' => $_POST['address'],
                'birthday' => $_POST['birthday'],
                'course_id' => $_POST['course_id']
            ];
        
            
            $this->model->update($data);
        

        header("Location: /maestros");
        
    }

    /**
     * Guarda el registro de un nuevo maestro y envía al usuario a /maestros.
     * 
     * @param array $request Datos del cliente nuevo
     */
    public function store($request)
    {

        $request = [
            'email' => $_POST['email'],
            'name' => $_POST['name'],
            'address' => $_POST['address'],
            'birthday' => $_POST['birthday'],
            'course_id' => $_POST['course_id'],
        ];
        $response = $this->model->create($request);

        header("Location: /maestros");
    }

    /**
     * Eliminar el registro de un maestro y envía al usuario a /maestros.
     */
    public function delete($id)
    {
        $this->model->destroy($id);

        header("Location: /maestros");
    }
}