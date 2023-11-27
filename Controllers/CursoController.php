<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Models/Curso.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Models/Maestro.php";

class CursoController
{
    protected $model;
    protected $maestro;

    public function __construct()
    {
        $this->model = new Curso();
        $this->maestro = new Maestro();
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
        $maestros = $this->maestro->getMaestros();
        include $_SERVER["DOCUMENT_ROOT"] . "/views/cursos/create.php";
    }

    /**
     * Muestra un formulario para editar un cliente.
     */
    public function edit($id)
    {
        $maestros = $this->maestro->getMaestros();
        $curso = $this->model->find($id);

        include $_SERVER["DOCUMENT_ROOT"] . "/views/cursos/edit.php";
    }

    /**
     * Actualiza los datos de un cliente y envía al usuario a /clientes.
     */
    public function update($request)
    {
        $request = [
            'materia' => $_POST['materia'],
            'maestro_asignado' => $_POST['maestro_asignado']
        ];
        var_dump($request);
        $this->model->update($request);

        header("Location: /clases");
    }

    /**
     * Guarda el registro de un nuevo cliente y envía al usuario a /clientes.
     * 
     * @param array $request Datos del cliente nuevo
     */
    public function store($request)
    {
        $request = [
            'materia' => $_POST['materia'],
            'maestro_id' => $_POST['maestro']
        ];
        $response = $this->model->create($request);

        header("Location: /clases");
    }

    /**
     * Eliminar el registro de un cliente y envía al usuario a /clientes.
     */
    public function delete($id)
    {
        $this->model->destroy($id);

        header("Location: /clases");
    }
}