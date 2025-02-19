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
        private BaseDatos $baseDatos;

        public function __construct(int $usuarioId, string $provincia, string $localidad, string $direccion, float $coste, string $estado, string $fecha, string $hora){

            // Conexión a la base de datos

            $this->baseDatos = new BaseDatos();

            // Insertamos un nuevo pedido en la base de datos

            $this->baseDatos->ejecutar('INSERT INTO pedidos (usuario_id, provincia, localidad, direccion, coste, estado, fecha, hora) VALUES (:usuario_id, :provincia, :localidad, :direccion, :coste, :estado, :fecha, :hora)', [
                ':usuario_id' => $usuarioId,
                ':provincia' => $provincia,
                ':localidad' => $localidad,
                ':direccion' => $direccion,
                ':coste' => $coste,
                ':estado' => $estado,
                ':fecha' => $fecha,
                ':hora' => $hora
            ]);

            // Establecemos la id que ha sido generada auto-incrementalmente en la BD

            $this->id = $this->baseDatos->getUltimoId();

            // Establecemos el resto de atributos que no son problemáticos

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
            
            // Primero actualizamos la id en la base de datos

            $this->baseDatos->ejecutar('UPDATE pedidos SET id = :id WHERE id = :id', [
                ':id' => $id
            ]);

            // Y luego en el objeto

            $this->id = $id;

        }

        public function setUsuarioId(int $usuarioId): void{
            
            // Actualizamos el id del usuario en la base de datos

            $this->baseDatos->ejecutar('UPDATE pedidos SET usuario_id = :usuario_id WHERE id = :id', [
                ':id' => $this->id,
                ':usuario_id' => $usuarioId
            ]);

            // Y luego en el objeto

            $this->usuarioId = $usuarioId;

        }

        public function setProvincia(string $provincia): void{
            
            // Primero actualizamos la provincia en la base de datos

            $this->baseDatos->ejecutar('UPDATE pedidos SET provincia = :provincia WHERE id = :id', [
                ':id' => $this->id,
                ':provincia' => $provincia
            ]);

            // Y luego en el objeto

            $this->provincia = $provincia;

        }

        public function setLocalidad(string $localidad): void{
            
            // Actualizamos la localidad en la base de datos

            $this->baseDatos->ejecutar('UPDATE pedidos SET localidad = :localidad WHERE id = :id', [
                ':id' => $this->id,
                ':localidad' => $localidad
            ]);

            // Y luego en el objeto

            $this->localidad = $localidad;

        }

        public function setDireccion(string $direccion): void{
            
            // Actualizamos la dirección en la base de datos

            $this->baseDatos->ejecutar('UPDATE pedidos SET direccion = :direccion WHERE id = :id', [
                ':id' => $this->id,
                ':direccion' => $direccion
            ]);

            // Y luego en el objeto

            $this->direccion = $direccion;

        }

        public function setCoste(float $coste): void{
            
            // Actualizamos el coste en la base de datos

            $this->baseDatos->ejecutar('UPDATE pedidos SET coste = :coste WHERE id = :id', [
                ':id' => $this->id,
                ':coste' => $coste
            ]);

            // Y luego en el objeto

            $this->coste = $coste;

        }

        public function setEstado(string $estado): void{
            
            // Actualizamos el estado en la base de datos

            $this->baseDatos->ejecutar('UPDATE pedidos SET estado = :estado WHERE id = :id', [
                ':id' => $this->id,
                ':estado' => $estado
            ]);

            // Y luego en el objeto

            $this->estado = $estado;

        }

        public function setFecha(string $fecha): void{
            
            // Actualizamos la fecha en la base de datos

            $this->baseDatos->ejecutar('UPDATE pedidos SET fecha = :fecha WHERE id = :id', [
                ':id' => $this->id,
                ':fecha' => $fecha
            ]);

            // Y luego en el objeto

            $this->fecha = $fecha;

        }

        public function setHora(string $hora): void{
            
            // Actualizamos la hora en la base de datos

            $this->baseDatos->ejecutar('UPDATE pedidos SET hora = :hora WHERE id = :id', [
                ':id' => $this->id,
                ':hora' => $hora
            ]);

            // Y luego en el objeto

            $this->hora = $hora;

        }
        
    }

?>