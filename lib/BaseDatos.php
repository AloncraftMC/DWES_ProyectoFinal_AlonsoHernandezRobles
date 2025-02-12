<?php

    namespace lib;

    use PDO;
    use PDOException;

    class BaseDatos{

        private $servidor;
        private $usuario;
        private $contrasena;
        private $baseDatos;

        private $conexion;
        private $resultado;

        public function __construct(){
        
            try{

                $this->servidor = $_ENV['DB_HOST'];
                $this->usuario = $_ENV['DB_USER'];
                $this->contrasena = $_ENV['DB_PASSWORD'];
                $this->baseDatos = $_ENV['DB_NAME'];

                $this->conexion = new PDO("mysql:host=$this->servidor;dbname=$this->baseDatos", $this->usuario, $this->contrasena);

                $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            }catch(PDOException $e){

                echo $e->getMessage();

            }
        
        }

        public function consulta($sql){
            $this->resultado = $this->conexion->query($sql);
        }

        public function siguienteRegistro(){
            return $this->resultado->fetch();
        }

        public function todosRegistros(){
            return $this->resultado->fetchAll();
        }

        public function numeroRegistros(){
            return $this->resultado->rowCount();
        }

        public function ultimoId(){
            return $this->conexion->lastInsertId();
        }

    }

?>