<?php

    namespace repositories;

    use lib\BaseDatos;
    use models\Pedido;

    use PDO;
    use PDOException;

    class PedidoRepository{

        private BaseDatos $baseDatos;

        public function __construct(){
            $this->baseDatos = new BaseDatos();
        }

        // Insertamos un nuevo pedido con id de usuario, provincia, localidad, dirección, coste, estado, fecha y hora en la base de datos

        public function insert(int $usuarioId, string $provincia, string $localidad, string $direccion, float $coste, string $estado, string $fecha, string $hora): void{
            
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

        }

        // Modificamos los atributos de un pedido en base a un id

        public function update(int $id, int $usuarioId, string $provincia, string $localidad, string $direccion, float $coste, string $estado, string $fecha, string $hora): void{

            $this->baseDatos->ejecutar('UPDATE pedidos SET usuario_id = :usuario_id, provincia = :provincia, localidad = :localidad, direccion = :direccion, coste = :coste, estado = :estado, fecha = :fecha, hora = :hora WHERE id = :id', [
                ':id' => $id,
                ':usuario_id' => $usuarioId,
                ':provincia' => $provincia,
                ':localidad' => $localidad,
                ':direccion' => $direccion,
                ':coste' => $coste,
                ':estado' => $estado,
                ':fecha' => $fecha,
                ':hora' => $hora
            ]);

        }

        // Eliminamos un pedido en base a un id

        public function delete(int $id): void{

            $this->baseDatos->ejecutar('DELETE FROM pedidos WHERE id = :id', [
                ':id' => $id
            ]);

        }

        // Seleccionamos un pedido en base a un id

        public function selectPedidoById(int $id): ?Pedido{

            $pedido = null;

            $this->baseDatos->ejecutar('SELECT * FROM pedidos WHERE id = :id', [
                ':id' => $id
            ]);

            $registro = $this->baseDatos->getSiguienteRegistro();

            if($registro){
                $pedido = new Pedido($registro['id'], $registro['usuario_id'], $registro['provincia'], $registro['localidad'], $registro['direccion'], $registro['coste'], $registro['estado'], $registro['fecha'], $registro['hora']);
            }

            return $pedido;

        }

        // Seleccionamos todos los pedidos

        public function selectPedidosByUsuarioId(int $usuarioId): array{

            $pedidos = [];

            $this->baseDatos->ejecutar('SELECT * FROM pedidos WHERE usuario_id = :usuario_id', [
                ':usuario_id' => $usuarioId
            ]);

            while($registro = $this->baseDatos->getSiguienteRegistro()){
                $pedidos[] = new Pedido($registro['id'], $registro['usuario_id'], $registro['provincia'], $registro['localidad'], $registro['direccion'], $registro['coste'], $registro['estado'], $registro['fecha'], $registro['hora']);
            }

            return $pedidos;

        }

    }

?>