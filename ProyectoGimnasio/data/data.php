<?php

class Data{
    public $server;
    public $user;
    public $password;
    public $db;
    public $connection;
    public $isActive;
    public $hostname;
    public $charset;

    public function Data(){
        $hostName = gethostname();

        switch ($hostName) {
            case "office": //Office's PC
                $this->isActive = false;
                $this->server = "127.0.0.1";
                $this->user = "root";
                $this->password = "";
                $this->db = "bdproyectogym";
                break;
            case "admin": //laptop's PC
                $this->isActive = false;
                $this->server = "127.0.0.1";
                $this->user = "root";
                $this->password = "";
                $this->db = "bdproyectogym";
                break;
            default: //Hosting
                $this->isActive = false;
                $this->server = "127.0.0.1";
                $this->user = "root";
                $this->password = "";
                $this->db = "bdproyectogym";
                $this->hostname = "localhost";
                $this->charset = "utf8";

                try {
                    $conexion = "mysql:host=" . $this->hostname . ";dbname=" . $this->db . ";charset=" . $this->charset;
                    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false,];
                    $pdo = new PDO($conexion, $this->user, $this->password, $options);
                    return $pdo;
                } catch (PDOException $e) {
                    echo 'Error conexion: ' . $e->getMessage();
                    exit;
                }
                break;
        }
    }
}
