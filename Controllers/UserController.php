<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Models/User.php";

class UserController
{
    protected $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function permiso()
    {
        $users = $this->model->permisos();

        include $_SERVER["DOCUMENT_ROOT"] . "/views/permisos/permisos.php";
    }

    public function maestro()
    {
        $users = $this->model->all();

        include $_SERVER["DOCUMENT_ROOT"] . "/views/maestros.php";
    }

    public function alumno()
    {
        $users = $this->model->all();

        include $_SERVER["DOCUMENT_ROOT"] . "/views/alumnos.php";
    }

    public function clase()
    {
        $users = $this->model->all();

        include $_SERVER["DOCUMENT_ROOT"] . "/views/clases.php";
    }

    /**
     * Muestra una vista con todos los clientes.
     */
    // public function index()
    // {
    //     $users = $this->model->all();

    //     include $_SERVER["DOCUMENT_ROOT"] . "/views/permisos.php";
    // }

    /**
     * Muestra un formulario para crear un nuevo cliente.
     */
    public function create()
    {
        include $_SERVER["DOCUMENT_ROOT"] . "/views/clientes/create.php";
    }

    /**
     * Muestra un formulario para editar un cliente.
     */
    public function edit($id)
    {
        $user = $this->model->find($id);

        include $_SERVER["DOCUMENT_ROOT"] . "/views/permisos/edit.php";
    }

    /**
     * Actualiza los datos de un cliente y envía al usuario a /clientes.
     */
    public function update($request)
    {
        $this->model->update($request);

        header("Location: /permisos");
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
}