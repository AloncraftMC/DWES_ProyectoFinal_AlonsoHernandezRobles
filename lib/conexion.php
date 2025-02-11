<?php

    namespace lib;

    use PDO;
    use PDOException;

    class Conexion{

        private const HOST = DB_HOST;
        private const NOMBRE = DB_NAME;
        private const USUARIO = DB_USER;
        private const CONTRASENA = DB_PASSWORD;

        private $conexion;

        public function __construct(){
        
            try{

                $this->conexion = new PDO("mysql:host=" . self::HOST . ";dbname=" . self::NOMBRE, self::USUARIO, self::CONTRASENA);

                $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            }catch(PDOException $e){

                echo $e->getMessage();

            }
        
        }

    }

?>