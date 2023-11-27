<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Models/Curso.php";

class CursoController
{
    protected $model;

    public function __construct()
    {
        $this->model = new Curso();
    }

    /**
     * Muestra una vista con todos los clientes.
     */
    public function index()
    {
        $cursos = $this->model->all();

        include $_SERVER["DOCUMENT_ROOT"] . "/views/cursos/read.php";
    }

    /**
     * Muestra un formulario para crear un nuevo cliente.
     */
    public function create()
    {
        include $_SERVER["DOCUMENT_ROOT"] . "/views/cursos/create.php";
    }

    /**
     * Muestra un formulario para editar un cliente.
     */
    public function edit($id)
    {
        //$cliente = $this->model->find($id);

        include $_SERVER["DOCUMENT_ROOT"] . "/views/cursos/edit.php";
    }

    /**
     * Actualiza los datos de un cliente y envía al usuario a /clientes.
     */
    public function update($request)
    {
        //$this->model->update($request);

        header("Location: /cursos");
    }

    /**
     * Guarda el registro de un nuevo cliente y envía al usuario a /clientes.
     * 
     * @param array $request Datos del cliente nuevo
     */
    public function store($request)
    {
        //$response = $this->model->create($request);

        header("Location: /cursos");
    }

    /**
     * Eliminar el registro de un cliente y envía al usuario a /clientes.
     */
    public function delete($id)
    {
        $this->model->destroy($id);

        header("Location: /cursos");
    }
}