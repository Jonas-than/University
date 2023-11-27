<?php
class Model
{
    protected $db;
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