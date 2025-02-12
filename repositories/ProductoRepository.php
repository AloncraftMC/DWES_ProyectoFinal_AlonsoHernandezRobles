<?php

    namespace repositories;

    use lib\BaseDatos;
    use models\Producto;

    use PDO;
    use PDOException;

    class ProductoRepository{

        private BaseDatos $baseDatos;

        public function __construct(){
            $this->baseDatos = new BaseDatos();
        }

        // Insertamos un nuevo producto con id de categoría, nombre, descripción, precio, stock, oferta, fecha e imagen en la base de datos

        public function insert(int $categoriaId, string $nombre, string $descripcion, float $precio, int $stock, string $oferta, string $fecha, string $imagen): void{
            
            $this->baseDatos->ejecutar('INSERT INTO productos (categoria_id, nombre, descripcion, precio, stock, oferta, fecha, imagen) VALUES (:categoria_id, :nombre, :descripcion, :precio, :stock, :oferta, :fecha, :imagen)', [
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

        public function update(int $id, int $categoriaId, string $nombre, string $descripcion, float $precio, int $stock, string $oferta, string $fecha, string $imagen): void{

            $this->baseDatos->ejecutar('UPDATE productos SET categoria_id = :categoria_id, nombre = :nombre, descripcion = :descripcion, precio = :precio, stock = :stock, oferta = :oferta, fecha = :fecha, imagen = :imagen WHERE id = :id', [
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

        public function delete(int $id): void{

            $this->baseDatos->ejecutar('DELETE FROM productos WHERE id = :id', [
                ':id' => $id
            ]);

        }

        // Seleccionamos un producto en base a un id

        public function selectProductoById(int $id): ?Producto{

            $producto = null;

            $this->baseDatos->ejecutar('SELECT * FROM productos WHERE id = :id', [
                ':id' => $id
            ]);

            $registro = $this->baseDatos->getSiguienteRegistro();

            if($registro){
                $producto = new Producto($registro['id'], $registro['categoria_id'], $registro['nombre'], $registro['descripcion'], $registro['precio'], $registro['stock'], $registro['oferta'], $registro['fecha'], $registro['imagen']);
            }

            return $producto;

        }

        // Seleccionamos todos los productos

        public function selectProductos(): array{

            $productos = [];

            $this->baseDatos->ejecutar('SELECT * FROM productos');

            $registros = $this->baseDatos->getRegistros();

            foreach($registros as $registro){
                array_push($productos, new Producto($registro['id'], $registro['categoria_id'], $registro['nombre'], $registro['descripcion'], $registro['precio'], $registro['stock'], $registro['oferta'], $registro['fecha'], $registro['imagen']));
            }

            return $productos;

        }

    }

?>