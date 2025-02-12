<?php

    namespace repositories;

    use lib\BaseDatos;
    use models\Producto;

    use PDO;
    use PDOException;

    class ProductoRepository{

        private static BaseDatos $baseDatos;

        public function __construct(){
            self::$baseDatos = new BaseDatos();
        }

        // Insertamos un nuevo producto con id de categoría, nombre, descripción, precio, stock, oferta, fecha e imagen en la base de datos

        public static function insert(int $categoriaId, string $nombre, string $descripcion, float $precio, int $stock, string $oferta, string $fecha, string $imagen): void{
            
            self::$baseDatos->ejecutar('INSERT INTO productos (categoria_id, nombre, descripcion, precio, stock, oferta, fecha, imagen) VALUES (:categoria_id, :nombre, :descripcion, :precio, :stock, :oferta, :fecha, :imagen)', [
                ':categoria_id' => $categoriaId,
                ':nombre' => $nombre,
                ':descripcion' => $descripcion,
                ':precio' => $precio,
                ':stock' => $stock,
                ':oferta' => $oferta,
                ':fecha' => $fecha,
                ':imagen' => $imagen
            ]);

        }

        // Modificamos los atributos de un producto en base a un id

        public static function update(int $id, int $categoriaId, string $nombre, string $descripcion, float $precio, int $stock, string $oferta, string $fecha, string $imagen): void{

            self::$baseDatos->ejecutar('UPDATE productos SET categoria_id = :categoria_id, nombre = :nombre, descripcion = :descripcion, precio = :precio, stock = :stock, oferta = :oferta, fecha = :fecha, imagen = :imagen WHERE id = :id', [
                ':id' => $id,
                ':categoria_id' => $categoriaId,
                ':nombre' => $nombre,
                ':descripcion' => $descripcion,
                ':precio' => $precio,
                ':stock' => $stock,
                ':oferta' => $oferta,
                ':fecha' => $fecha,
                ':imagen' => $imagen
            ]);

        }

        // Eliminamos un producto en base a un id

        public static function delete(int $id): void{

            self::$baseDatos->ejecutar('DELETE FROM productos WHERE id = :id', [
                ':id' => $id
            ]);

        }

        // Seleccionamos un producto en base a un id

        public static function selectProductoById(int $id): ?Producto{

            $producto = null;

            self::$baseDatos->ejecutar('SELECT * FROM productos WHERE id = :id', [
                ':id' => $id
            ]);

            $registro = self::$baseDatos->getSiguienteRegistro();

            if($registro){
                $producto = new Producto($registro['id'], $registro['categoria_id'], $registro['nombre'], $registro['descripcion'], $registro['precio'], $registro['stock'], $registro['oferta'], $registro['fecha'], $registro['imagen']);
            }

            return $producto;

        }

        // Seleccionamos todos los productos

        public static function selectProductos(): array{

            $productos = [];

            self::$baseDatos->ejecutar('SELECT * FROM productos');

            $registros = self::$baseDatos->getRegistros();

            foreach($registros as $registro){
                array_push($productos, new Producto($registro['id'], $registro['categoria_id'], $registro['nombre'], $registro['descripcion'], $registro['precio'], $registro['stock'], $registro['oferta'], $registro['fecha'], $registro['imagen']));
            }

            return $productos;

        }

    }

?>