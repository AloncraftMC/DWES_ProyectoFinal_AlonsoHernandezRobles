<?php

    namespace models;

    use lib\BaseDatos;

    class Producto{

        private $id;
        private $categoriaId;
        private $nombre;
        private $descripcion;
        private $precio;
        private $stock;
        private $oferta;
        private $fecha;
        private $imagen;
        private $baseDatos;

        public function __construct($id, $categoriaId, $nombre, $descripcion, $precio, $stock, $oferta, $fecha, $imagen){

            $this->id = $id;
            $this->categoriaId = $categoriaId;
            $this->nombre = $nombre;
            $this->descripcion = $descripcion;
            $this->precio = $precio;
            $this->stock = $stock;
            $this->oferta = $oferta;
            $this->fecha = $fecha;
            $this->imagen = $imagen;
            $this->baseDatos = new BaseDatos();

        }

        public function getId(){
            return $this->id;
        }

        public function getCategoriaId(){
            return $this->categoriaId;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getDescripcion(){
            return $this->descripcion;
        }

        public function getPrecio(){
            return $this->precio;
        }

        public function getStock(){
            return $this->stock;
        }

        public function getOferta(){
            return $this->oferta;
        }

        public function getFecha(){
            return $this->fecha;
        }

        public function getImagen(){
            return $this->imagen;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setCategoriaId($categoriaId){
            $this->categoriaId = $categoriaId;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        public function setDescripcion($descripcion){
            $this->descripcion = $descripcion;
        }

        public function setPrecio($precio){
            $this->precio = $precio;
        }

        public function setStock($stock){
            $this->stock = $stock;
        }

        public function setOferta($oferta){
            $this->oferta = $oferta;
        }

        public function setFecha($fecha){
            $this->fecha = $fecha;
        }

        public function setImagen($imagen){
            $this->imagen = $imagen;
        }
        
    }

?>