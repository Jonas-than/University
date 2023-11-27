<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Models/Admin.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Models/Role.php";

class AdminController
{
    protected $model;
    protected $role;

    public function __construct()
    {
        $this->model = new Admin();
        $this->role = new Role();
    }

    /**
     * Muestra una vista con todos los usuarios.
     */
    public function index()
    {
        $admin = $this->model->permisos();
        $roles = $this->role->getRoles();

        include $_SERVER["DOCUMENT_ROOT"] . "/views/admin/read.php";
    }


    /**
     * Muestra un formulario para editar un usuario.
     */
    public function edit($id)
    {
        $admin = $this->model->find($id);
        $roles = $this->role->getRoles(); 

        
        include $_SERVER["DOCUMENT_ROOT"] . "/views/admin/edit.php";
    }

    /**
     * Actualiza los datos de un cliente y envía al usuario a /clientes.
     */
    public function update($request)
    {
        $this->model->update($request);

        header("Location: /permisos");

    }

    
}