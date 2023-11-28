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
     * Muestra una vista con todos las clases.
     */
    public function index()
    {
        $cursos = $this->model->all();

        include $_SERVER["DOCUMENT_ROOT"] . "/views/cursos/read.php";
    }

    /**
     * Muestra un formulario para crear una nueva clase.
     */
    public function create()
    {
        $maestros = $this->maestro->getMaestros();
        include $_SERVER["DOCUMENT_ROOT"] . "/views/cursos/create.php";
    }

    /**
     * Muestra un formulario para editar una clase.
     */
    public function edit($id)
    {
        $maestros = $this->maestro->getMaestros();
        $curso = $this->model->find($id);

        include $_SERVER["DOCUMENT_ROOT"] . "/views/cursos/edit.php";
    }

    /**
     * Actualiza los datos de una clase y envía al usuario a /clases.
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
     * Guarda el registro de una nueva clase y envía al usuario a /clases.
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
     * Eliminar el registro de una clase y envía al usuario a /clases.
     */
    public function delete($id)
    {
        $this->model->destroy($id);

        header("Location: /clases");
    }
}