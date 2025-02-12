<?php

    namespace models;
    use lib\BaseDatos;

    class Categoria{

        private int $id;
        private string $nombre;
        private BaseDatos $baseDatos;

        public function __construct(int $id, string $nombre){

            $this->id = $id;
            $this->nombre = $nombre;
            $this->baseDatos = new BaseDatos();

        }
        
        public function getId(): int{
            return $this->id;
        }

        public function getNombre(): string{
            return $this->nombre;
        }

        public function setId(int $id): void{
            $this->id = $id;
        }

        public function setNombre(string $nombre): void{
            $this->nombre = $nombre;
        }

    }

?>