<?php

    namespace services;

    use models\Producto;
    use repositories\ProductoRepository;

    class ProductoService{

        private static ProductoRepository $productoRepository;

        public function __construct(){
            self::$productoRepository = new ProductoRepository();
        }

        // Creamos un nuevo producto con id de categoría, nombre, descripción, precio, stock, oferta, fecha e imagen

        public static function create(int $categoriaId, string $nombre, string $descripcion, float $precio, int $stock, bool $oferta, string $fecha, string $imagen): void{
            self::$productoRepository->insert($categoriaId, $nombre, $descripcion, $precio, $stock, $oferta, $fecha, $imagen);
        }

        // Actualizamos un producto en base a un id con id de categoría, nombre, descripción, precio, stock, oferta, fecha e imagen

        public static function edit(int $id, int $categoriaId, string $nombre, string $descripcion, float $precio, int $stock, bool $oferta, string $fecha, string $imagen): void{
            self::$productoRepository->update($id, $categoriaId, $nombre, $descripcion, $precio, $stock, $oferta, $fecha, $imagen);
        }

        // Eliminamos un producto en base a un id

        public static function delete(int $id): void{
            self::$productoRepository->delete($id);
        }

        // Obtenemos un producto en base a un id

        public static function getProductoById(int $id): ?Producto{
            return self::$productoRepository->selectProductoById($id);
        }

        // Obtenemos todos los productos

        public static function getProductos(): array{
            return self::$productoRepository->selectProductos();
        }

    }

?>