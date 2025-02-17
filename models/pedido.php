<?php

    namespace models;

    use lib\BaseDatos;

    class Pedido{

        private int $id;
        private int $usuarioId;
        private string $provincia;
        private string $localidad;
        private string $direccion;
        private float $coste;
        private string $estado;
        private string $fecha;
        private string $hora;

        public function __construct(int $id, int $usuarioId, string $provincia, string $localidad, string $direccion, float $coste, string $estado, string $fecha, string $hora){

            $this->id = $id;
            $this->usuarioId = $usuarioId;
            $this->provincia = $provincia;
            $this->localidad = $localidad;
            $this->direccion = $direccion;
            $this->coste = $coste;
            $this->estado = $estado;
            $this->fecha = $fecha;
            $this->hora = $hora;

        }

        public function getId(): int{
            return $this->id;
        }

        public function getUsuarioId(): int{
            return $this->usuarioId;
        }

        public function getProvincia(): string{
            return $this->provincia;
        }

        public function getLocalidad(): string{
            return $this->localidad;
        }

        public function getDireccion(): string{
            return $this->direccion;
        }

        public function getCoste(): float{
            return $this->coste;
        }

        public function getEstado(): string{
            return $this->estado;
        }

        public function getFecha(): string{
            return $this->fecha;
        }

        public function getHora(): string{
            return $this->hora;
        }

        public function setId(int $id): void{
            $this->id = $id;
        }

        public function setUsuarioId(int $usuarioId): void{
            $this->usuarioId = $usuarioId;
        }

        public function setProvincia(string $provincia): void{
            $this->provincia = $provincia;
        }

        public function setLocalidad(string $localidad): void{
            $this->localidad = $localidad;
        }

        public function setDireccion(string $direccion): void{
            $this->direccion = $direccion;
        }

        public function setCoste(float $coste): void{
            $this->coste = $coste;
        }

        public function setEstado(string $estado): void{
            $this->estado = $estado;
        }

        public function setFecha(string $fecha): void{
            $this->fecha = $fecha;
        }

        public function setHora(string $hora): void{
            $this->hora = $hora;
        }
        
    }

?>