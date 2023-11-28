<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Models/Alumno.php";

class Alumno extends Model
{
    protected $table = "users";

    public function getAlumnos()
    {
        $res = $this->db->query("SELECT id, dni, name, email, address, birthday
        FROM users
        WHERE role_id = (SELECT id FROM roles WHERE name = 'alumno');");

        $data = $res->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    public function find($id)
    {
        $res = $this->db->query("SELECT * FROM {$this->table} WHERE id = $id");
        $data = $res->fetch_assoc();

        return $data;
    }

    public function update($data)
    {
        $updatePairs = [];

        foreach ($data as $key => $value) {
            $updatePairs[] = "$key = '$value'";
        }

        session_start();
        $query = "UPDATE {$this->table} SET " . implode(", ", $updatePairs) . " WHERE id = {$_SESSION["alumno_id_edit"]}";
        $this->db->query($query);
    }

    public function destroy($id)
    {
        $this->db->query("DELETE FROM {$this->table} WHERE id = $id");
    }

    public function create($data)
    {
        try {
            $data['role_id'] = 3;
            // Esto hace que sin importar los pares de clave y valor de la variable $data, el $query sea reutilizable.
            $keys = array_keys($data);
            $keysString = implode(", ", $keys);

            $values = array_values($data);
            $valuesString = implode("', '", $values);
            $query = "INSERT INTO {$this->table}($keysString) VALUES ('$valuesString')";

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
}