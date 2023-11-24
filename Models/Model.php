<?php
class Model
{
    private $db;
    protected $table;

    public function __construct()
    {
        $config = include($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");

        try {
            $this->db = new mysqli(
                $config["host"],
                $config["username"],
                $config["password"],
                $config["dbname"]
            );
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    /**
     * Método para todos los registros de la tabla.
     *
     * @return array Arreglo con todos los registro de la tabla.
     */
    public function all()
    {
        $res = $this->db->query("SELECT * FROM {$this->table}");
        $data = $res->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

    public function permisos()
    {
        $res = $this->db->query("select 
        u.id,
        u.email,
        r.name as rol
        from 
        users u
        inner join roles r
        on r.id = u.role_id");
        $data = $res->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

    /**
     * Método para obtener un registro por su id.
     *
     * @param integer $id Id de la fila (recurso) a buscar.
     * @return array Arreglo con los datos de la fila o recurso encontrado.
     */
    public function find($id)
    {
        $res = $this->db->query("SELECT * FROM {$this->table} WHERE id = $id");
        $data = $res->fetch_assoc();

        return $data;
    }

    /**
     * Método para crear un nuevo registro en la tabla.
     *
     * @param array $data Arreglo asociativo con los datos a ingresar.
     * @return array Arreglo con los datos de la fila ingresada.
     */
    public function create($data)
    {
        try {
            // Esto hace que sin importar los pares de clave y valor de la variable $data, el $query sea reutilizable.
            $keys = array_keys($data);
            $keysString = implode(", ", $keys);

            $values = array_values($data);
            $valuesString = implode("', '", $values);
            $query = "insert into {$this->table}($keysString) values ('$valuesString')";

            $res = $this->db->query($query);

            if ($res) {
                $ultimoId = $this->db->insert_id;
                $data = $this->find($ultimoId);

                return $data;
            } else {
                return "No se pudo crear el cliente";
            }
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    /**
     * Método para actualizar un registro en la tabla.
     *
     * @param array $data Arreglo asociatvo con los datos a actualizar.
     */
    public function update($data)
    {
        // Esto hace que sin importar los pares de clave y valor de la variable $data, el $query sea reutilizable.
        $updatePairs = [];

        foreach ($data as $key => $value) {
            $updatePairs[] = "$key = '$value'";
        }

        session_start();
        $query = "update {$this->table} set " . implode(", ", $updatePairs) . "where id = {$_SESSION["clienteid_edit"]}";
        $this->db->query($query);
    }

    /**
     * Método para eliminar un registro en la tabla.
     *
     * @param integer $id
     */
    public function destroy($id)
    {
        $this->db->query("DELETE FROM {$this->table} WHERE id = $id");
    }

    /**
     * Método para encontrar un dato utilizando la columna, operador y valor.
     *
     * @param string $column Columna de la tabla en la que se quiere buscar.
     * @param string $operator Operador para hacer la comparación. Ej: =, !=, <, >, etc.
     * @param string $value Valor a encontrar en la columna.
     * 
     * @return array Data encontrada.
     */
    public function where($column, $operator, $value)
    {
        $res = $this->db->query("SELECT * FROM {$this->table} WHERE $column $operator '$value'");
        $data = $res->fetch_all(MYSQLI_ASSOC);

        return $data;
    }
}