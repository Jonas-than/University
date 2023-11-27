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
        //$cliente = $this->model->find($id);

        include $_SERVER["DOCUMENT_ROOT"] . "/views/alumnos/edit.php";
    }

    /**
     * Actualiza los datos de un cliente y envía al usuario a /clientes.
     */
    public function update($request)
    {
        //$this->model->update($request);

        header("Location: /alumnos");
    }

    /**
     * Guarda el registro de un nuevo cliente y envía al usuario a /clientes.
     * 
     * @param array $request Datos del cliente nuevo
     */
    public function store($request)
    {
       // $response = $this->model->create($request);

        header("Location: /alumnos");
    }

    /**
     * Eliminar el registro de un cliente y envía al usuario a /clientes.
     */
    public function delete($id)
    {
        $this->model->destroy($id);

        header("Location: /alumnos");
    }
}