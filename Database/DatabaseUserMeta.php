<?php

namespace SEVEN_TECH\Gateway\Database;

use SEVEN_TECH\Gateway\Database\Database;

class DatabaseUserMeta
{
    private $connection;
    private $db_name;
    private $table_name;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->getConnection();
        $this->db_name = $database->getDBName();
        $this->table_name = "orb_usermeta";
    }

    public function update_usermeta($user_id, $meta_key, $meta_value)
    {
        $sql = "UPDATE {$this->table_name} SET meta_value = :meta_value WHERE meta_key = :meta_key AND user_id = :user_id";

        try {
            $this->connection->exec("USE {$this->db_name}");

            $checkIfExists = $this->connection->prepare("SELECT COUNT(*) FROM {$this->table_name} WHERE meta_key = :meta_key AND user_id = :user_id");
            $checkIfExists->bindParam(':meta_key', $meta_key);
            $checkIfExists->bindParam(':user_id', $user_id);
            $checkIfExists->execute();
            $exists = $checkIfExists->fetchColumn();

            if ($exists) {
                $stmt = $this->connection->prepare($sql);
                $stmt->bindParam(':meta_value', $meta_value);
                $stmt->bindParam(':meta_key', $meta_key);
                $stmt->bindParam(':user_id', $user_id);
                $stmt->execute();
                return $stmt->rowCount();
            } else {
                $insertSql = "INSERT INTO {$this->table_name} (user_id, meta_key, meta_value) VALUES (:user_id, :meta_key, :meta_value)";
                $stmt = $this->connection->prepare($insertSql);
                $stmt->bindParam(':meta_value', $meta_value);
                $stmt->bindParam(':meta_key', $meta_key);
                $stmt->bindParam(':user_id', $user_id);
                $stmt->execute();
                return $stmt->rowCount();
            }
        } catch (\PDOException $e) {
            error_log("Error updating options: " . $e->getMessage());
            return false;
        }
    }
}
