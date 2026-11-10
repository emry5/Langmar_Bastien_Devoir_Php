<?php

class Database
{
    private $host = "127.0.0.1";
    private $dbname = "touche_pas_au_klaxon";
    private $username = "root";
    private $password = "";

    public function getConnection()
    {
        try {
            $pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4",
                $this->username,
                $this->password
            );

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $pdo;
        } catch (PDOException $e) {
            throw new RuntimeException(
                "Erreur de connexion à la base de données : " . $e->getMessage()
            );
        }
    }
}
