<?php

namespace SEVEN_TECH\Database;

use SEVEN_TECH\Database\Database;

class DatabaseOptions
{
    private $connection;
    private $db_name;
    private $table_name;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->getConnection();
        $this->db_name = $database->getDBName();
        $this->table_name = "orb_options";
    }

    public function update_options($option_name, $option_value)
    {
        $sql = "UPDATE {$this->table_name} SET option_value = :option_value WHERE option_name = :option_name";
        $encoded = json_encode($option_value);

        try {
            $this->connection->exec("USE {$this->db_name}");

            $checkIfExists = $this->connection->prepare("SELECT COUNT(*) FROM {$this->table_name} WHERE option_name = :option_name");
            $checkIfExists->bindParam(':option_name', $option_name);
            $checkIfExists->execute();
            $exists = $checkIfExists->fetchColumn();

            if ($exists) {
                $stmt = $this->connection->prepare($sql);
                $stmt->bindParam(':option_value', $encoded);
                $stmt->bindParam(':option_name', $option_name);
                $stmt->execute();
                return $stmt->rowCount();
            } else {
                $insertSql = "INSERT INTO {$this->table_name} (option_name, option_value) VALUES (:option_name, :option_value)";
                $stmt = $this->connection->prepare($insertSql);
                $stmt->bindParam(':option_name', $option_name);
                $stmt->bindParam(':option_value', $encoded);
                $stmt->execute();
                return $stmt->rowCount();
            }
        } catch (\PDOException $e) {
            error_log("Error updating options: " . $e->getMessage());
            return false;
        }
    }
}
