<?php

    namespace models;

    use lib\BaseDatos;

    class Categoria{

        private int $id;
        private string $nombre;
        private BaseDatos $baseDatos;

        public function __construct(string $nombre){

            // Conexión a la base de datos

            $this->baseDatos = new BaseDatos();
            
            // Insertamos una nueva categoría en la base de datos

            $this->baseDatos->ejecutar('INSERT INTO categorias (nombre) VALUES (:nombre)', [
                ':nombre' => $nombre
            ]);
            
            // Establecemos la id que ha sido generada auto-incrementalmente en la BD

            $this->id = $this->baseDatos->getUltimoId();

            // Establecemos el nombre de la categoría

            $this->nombre = $nombre;

        }
        
        public function getId(): int{
            return $this->id;
        }

        public function getNombre(): string{
            return $this->nombre;
        }

        public function setId(int $id): void{
            
            // Primero actualizamos la id en la base de datos

            $this->baseDatos->ejecutar('UPDATE categorias SET id = :id WHERE id = :id', [
                ':id' => $id
            ]);

            // Y luego en el objeto

            $this->id = $id;

        }

        public function setNombre(string $nombre): void{
            
            // Actualizamos el nombre en la base de datos

            $this->baseDatos->ejecutar('UPDATE categorias SET nombre = :nombre WHERE id = :id', [
                ':id' => $this->id,
                ':nombre' => $nombre
            ]);

            // Y luego en el objeto

            $this->nombre = $nombre;

        }

    }

?>