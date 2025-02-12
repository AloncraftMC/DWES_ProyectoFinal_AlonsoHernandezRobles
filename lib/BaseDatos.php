<?php

    namespace lib;

    use PDO;
    use PDOException;
    use PDOStatement;

    class BaseDatos{

        private string $servidor;
        private string $usuario;
        private string $contrasena;
        private string $baseDatos;

        private PDO $conexion;
        private PDOStatement $resultado;

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

        public function ejecutar(string $sql, array $parametros = []): void{

            try{

                $this->resultado = $this->conexion->prepare($sql);
                $this->resultado->execute($parametros);

            }catch(PDOException $e){

                echo $e->getMessage();

            }

        }

        public function getSiguienteRegistro(): ?array{
            return $this->resultado->fetch();
        }

        public function getRegistros(): array{
            return $this->resultado->fetchAll();
        }

        public function getNumeroRegistros(): int{
            return $this->resultado->rowCount();
        }

        public function getUltimoId(): string{
            return $this->conexion->lastInsertId();
        }

        public function iniciarCambios(): void{
            $this->conexion->beginTransaction();
        }

        public function guardarCambios(): void{
            $this->conexion->commit();
        }

        public function descartarCambios(): void{
            $this->conexion->rollBack();
        }

    }

?>