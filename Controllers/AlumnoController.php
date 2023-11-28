<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Models/Alumno.php";

class AlumnoController
{
    protected $model;

    public function __construct()
    {
        $this->model = new Alumno();
    }

    /**
     * Muestra una vista con todos los clientes.
     */
    public function index()
    {
        $alumnos = $this->model->getAlumnos();

        include $_SERVER["DOCUMENT_ROOT"] . "/views/alumnos/read.php";
    }

    /**
     * Muestra un formulario para crear un nuevo cliente.
     */
    public function create()
    {
        include $_SERVER["DOCUMENT_ROOT"] . "/views/alumnos/create.php";
    }

    /**
     * Muestra un formulario para editar un cliente.
     */
    public function edit($id)
    {
        $alumno = $this->model->find($id);

        include $_SERVER["DOCUMENT_ROOT"] . "/views/alumnos/edit.php";
    }

    /**
     * Actualiza los datos de un alumno y envía al usuario a /alumnos.
     */
    public function update($request)
    {
        $request = [
            'dni' => $_POST['dni'],
            'name' => $_POST['name'],
            'address' => $_POST['address'],
            'birthday' => $_POST['birthday'],
        ];
        $this->model->update($request);

        header("Location: /alumnos");
    }

    /**
     * Guarda el registro de un nuevo alumno y envía al usuario a /alumnos.
     * 
     * @param array $request Datos del cliente nuevo
     */
    public function store($request)
    {
       $response = $this->model->create($request);

        header("Location: /alumnos");
    }

    /**
     * Eliminar el registro de un alumno y envía al usuario a /alumnos.
     */
    public function delete($id)
    {
        $this->model->destroy($id);

        header("Location: /alumnos");
    }
}