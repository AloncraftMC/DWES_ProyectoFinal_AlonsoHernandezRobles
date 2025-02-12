<?php

    namespace repositories;

    use lib\BaseDatos;
    use models\Pedido;

    use PDO;
    use PDOException;

    class PedidoRepository{

        private static BaseDatos $baseDatos;

        public function __construct(){
            self::$baseDatos = new BaseDatos();
        }

        // Insertamos un nuevo pedido con id de usuario, provincia, localidad, dirección, coste, estado, fecha y hora en la base de datos

        public static function insert(int $usuarioId, string $provincia, string $localidad, string $direccion, float $coste, string $estado, string $fecha, string $hora): void{
            
            self::$baseDatos->ejecutar('INSERT INTO pedidos (usuario_id, provincia, localidad, direccion, coste, estado, fecha, hora) VALUES (:usuario_id, :provincia, :localidad, :direccion, :coste, :estado, :fecha, :hora)', [
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

        public static function update(int $id, int $usuarioId, string $provincia, string $localidad, string $direccion, float $coste, string $estado, string $fecha, string $hora): void{

            self::$baseDatos->ejecutar('UPDATE pedidos SET usuario_id = :usuario_id, provincia = :provincia, localidad = :localidad, direccion = :direccion, coste = :coste, estado = :estado, fecha = :fecha, hora = :hora WHERE id = :id', [
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

        public static function delete(int $id): void{

            self::$baseDatos->ejecutar('DELETE FROM pedidos WHERE id = :id', [
                ':id' => $id
            ]);

        }

        // Seleccionamos un pedido en base a un id

        public static function selectPedidoById(int $id): ?Pedido{

            $pedido = null;

            self::$baseDatos->ejecutar('SELECT * FROM pedidos WHERE id = :id', [
                ':id' => $id
            ]);

            $registro = self::$baseDatos->getSiguienteRegistro();

            if($registro){
                $pedido = new Pedido($registro['id'], $registro['usuario_id'], $registro['provincia'], $registro['localidad'], $registro['direccion'], $registro['coste'], $registro['estado'], $registro['fecha'], $registro['hora']);
            }

            return $pedido;

        }

        // Seleccionamos todos los pedidos

        public  function selectPedidos(): array{

            $pedidos = [];

            self::$baseDatos->ejecutar('SELECT * FROM pedidos');

            $registros = self::$baseDatos->getRegistros();

            foreach($registros as $registro){
                array_push($pedidos, new Pedido($registro['id'], $registro['usuario_id'], $registro['provincia'], $registro['localidad'], $registro['direccion'], $registro['coste'], $registro['estado'], $registro['fecha'], $registro['hora']));
            }

            return $pedidos;

        }

    }

?>