<?php

    namespace models;

    use lib\BaseDatos;

    class Producto{

        private int $id;
        private int $categoriaId;
        private string $nombre;
        private string $descripcion;
        private float $precio;
        private int $stock;
        private string $oferta;
        private string $fecha;
        private string $imagen;
        private BaseDatos $baseDatos;

        public function __construct(int $categoriaId, string $nombre, string $descripcion, float $precio, int $stock, string $oferta, string $fecha, string $imagen){

            // Conexión a la base de datos

            $this->baseDatos = new BaseDatos();

            // Insertamos un nuevo producto en la base de datos

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

            // Establecemos la id que ha sido generada auto-incrementalmente en la BD

            $this->id = $this->baseDatos->getUltimoId();

            // Establecemos el resto de atributos que no son problemáticos

            $this->categoriaId = $categoriaId;
            $this->nombre = $nombre;
            $this->descripcion = $descripcion;
            $this->precio = $precio;
            $this->stock = $stock;
            $this->oferta = $oferta;
            $this->fecha = $fecha;
            $this->imagen = $imagen;

        }

        public function getId(): int{
            return $this->id;
        }

        public function getCategoriaId(): int{
            return $this->categoriaId;
        }

        public function getNombre(): string{
            return $this->nombre;
        }

        public function getDescripcion(): string{
            return $this->descripcion;
        }

        public function getPrecio(): float{
            return $this->precio;
        }

        public function getStock(): int{
            return $this->stock;
        }

        public function getOferta(): string{
            return $this->oferta;
        }

        public function getFecha(): string{
            return $this->fecha;
        }

        public function getImagen(): string{
            return $this->imagen;
        }

        public function setId(int $id): void{
            
            // Primero actualizamos la id en la base de datos

            $this->baseDatos->ejecutar('UPDATE productos SET id = :id WHERE id = :id', [
                ':id' => $id
            ]);

            // Y luego en el objeto

            $this->id = $id;

        }

        public function setCategoriaId(int $categoriaId): void{
            
            // Actualizamos la categoría en la base de datos

            $this->baseDatos->ejecutar('UPDATE productos SET categoria_id = :categoria_id WHERE id = :id', [
                ':id' => $this->id,
                ':categoria_id' => $categoriaId
            ]);

            // Y luego en el objeto

            $this->categoriaId = $categoriaId;

        }

        public function setNombre(string $nombre): void{
            
            // Actualizamos el nombre en la base de datos

            $this->baseDatos->ejecutar('UPDATE productos SET nombre = :nombre WHERE id = :id', [
                ':id' => $this->id,
                ':nombre' => $nombre
            ]);

            // Y luego en el objeto

            $this->nombre = $nombre;

        }

        public function setDescripcion(string $descripcion): void{
            
            // Actualizamos la descripción en la base de datos

            $this->baseDatos->ejecutar('UPDATE productos SET descripcion = :descripcion WHERE id = :id', [
                ':id' => $this->id,
                ':descripcion' => $descripcion
            ]);

            // Y luego en el objeto

            $this->descripcion = $descripcion;

        }

        public function setPrecio(float $precio): void{
            
            // Actualizamos el precio en la base de datos

            $this->baseDatos->ejecutar('UPDATE productos SET precio = :precio WHERE id = :id', [
                ':id' => $this->id,
                ':precio' => $precio
            ]);

            // Y luego en el objeto

            $this->precio = $precio;

        }

        public function setStock(int $stock): void{
            
            // Actualizamos el stock en la base de datos

            $this->baseDatos->ejecutar('UPDATE productos SET stock = :stock WHERE id = :id', [
                ':id' => $this->id,
                ':stock' => $stock
            ]);

            // Y luego en el objeto

            $this->stock = $stock;

        }

        public function setOferta(string $oferta): void{
            
            // Actualizamos la oferta en la base de datos

            $this->baseDatos->ejecutar('UPDATE productos SET oferta = :oferta WHERE id = :id', [
                ':id' => $this->id,
                ':oferta' => $oferta
            ]);

            // Y luego en el objeto

            $this->oferta = $oferta;

        }

        public function setFecha(string $fecha): void{
            
            // Actualizamos la fecha en la base de datos

            $this->baseDatos->ejecutar('UPDATE productos SET fecha = :fecha WHERE id = :id', [
                ':id' => $this->id,
                ':fecha' => $fecha
            ]);

            // Y luego en el objeto

            $this->fecha = $fecha;

        }

        public function setImagen(string $imagen): void{
            
            // Actualizamos la imagen en la base de datos

            $this->baseDatos->ejecutar('UPDATE productos SET imagen = :imagen WHERE id = :id', [
                ':id' => $this->id,
                ':imagen' => $imagen
            ]);

            // Y luego en el objeto

            $this->imagen = $imagen;

        }
        
    }

?>