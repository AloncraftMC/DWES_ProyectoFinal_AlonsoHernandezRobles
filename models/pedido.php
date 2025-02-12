<?php

    namespace models;

    use lib\BaseDatos;

    class Pedido{

        private $id;
        private $usuarioId;
        private $provincia;
        private $localidad;
        private $direccion;
        private $coste;
        private $estado;
        private $fecha;
        private $hora;
        private $baseDatos;

        public function __construct($id, $usuarioId, $provincia, $localidad, $direccion, $coste, $estado, $fecha, $hora){

            $this->id = $id;
            $this->usuarioId = $usuarioId;
            $this->provincia = $provincia;
            $this->localidad = $localidad;
            $this->direccion = $direccion;
            $this->coste = $coste;
            $this->estado = $estado;
            $this->fecha = $fecha;
            $this->hora = $hora;
            $this->baseDatos = new BaseDatos();

        }

        public function getId(){
            return $this->id;
        }

        public function getUsuarioId(){
            return $this->usuarioId;
        }

        public function getProvincia(){
            return $this->provincia;
        }

        public function getLocalidad(){
            return $this->localidad;
        }

        public function getDireccion(){
            return $this->direccion;
        }

        public function getCoste(){
            return $this->coste;
        }

        public function getEstado(){
            return $this->estado;
        }

        public function getFecha(){
            return $this->fecha;
        }

        public function getHora(){
            return $this->hora;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setUsuarioId($usuarioId){
            $this->usuarioId = $usuarioId;
        }

        public function setProvincia($provincia){
            $this->provincia = $provincia;
        }

        public function setLocalidad($localidad){
            $this->localidad = $localidad;
        }

        public function setDireccion($direccion){
            $this->direccion = $direccion;
        }

        public function setCoste($coste){
            $this->coste = $coste;
        }

        public function setEstado($estado){
            $this->estado = $estado;
        }

        public function setFecha($fecha){
            $this->fecha = $fecha;
        }

        public function setHora($hora){
            $this->hora = $hora;
        }
        
    }

?>