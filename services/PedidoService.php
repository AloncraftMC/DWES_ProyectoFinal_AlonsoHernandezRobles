<?php

    namespace services;

    use models\Pedido;
    use repositories\PedidoRepository;

    class PedidoService{

        private static PedidoRepository $pedidoRepository;

        public function __construct(){
            self::$pedidoRepository = new PedidoRepository();
        }

        // Creamos un nuevo pedido con usuarioId, provincia, localidad, direccion, coste, estado, fecha y hora

        public static function create(int $usuarioId, string $provincia, string $localidad, string $direccion, float $coste, string $estado, string $fecha, string $hora): void{
            self::$pedidoRepository->insert($usuarioId, $provincia, $localidad, $direccion, $coste, $estado, $fecha, $hora);
        }

        // Editamos los atributos de un pedido en base a un id

        public static function edit(int $id, int $usuarioId, string $provincia, string $localidad, string $direccion, float $coste, string $estado, string $fecha, string $hora): void{
            self::$pedidoRepository->update($id, $usuarioId, $provincia, $localidad, $direccion, $coste, $estado, $fecha, $hora);
        }

        // Eliminamos un pedido en base a un id

        public static function delete(int $id): void{
            self::$pedidoRepository->delete($id);
        }

        // Obtenemos un pedido en base a un id

        public static function getPedidoById(int $id): ?Pedido{
            return self::$pedidoRepository->selectPedidoById($id);
        }

        // Obtenemos todos los pedidos

        public static function getPedidos(): array{
            return self::$pedidoRepository->selectPedidos();
        }

    }

?>