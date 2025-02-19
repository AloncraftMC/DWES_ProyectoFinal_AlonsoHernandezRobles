<?php

    namespace repositories;

    use lib\BaseDatos;
    use models\Categoria;

    class CategoriaRepository{

        private static BaseDatos $baseDatos;

        public function __construct(){
            self::$baseDatos = new BaseDatos();
        }

        // Insertamos una nueva categoría en la base de datos

        public static function insert(Categoria $categoria): void{
            
            self::$baseDatos->ejecutar('INSERT INTO categorias (nombre) VALUES (:nombre)', [
                ':nombre' => $categoria->getNombre()
            ]);

        }

        // Modificamos el nombre de una categoría en base a un id

        public static function update(int $id, string $nombre): void{

            self::$baseDatos->ejecutar('UPDATE categorias SET nombre = :nombre WHERE id = :id', [
                ':id' => $id,
                ':nombre' => $nombre
            ]);

        }

        // Eliminamos una categoría en base a un id

        public static function delete(int $id): void{

            self::$baseDatos->ejecutar('DELETE FROM categorias WHERE id = :id', [
                ':id' => $id
            ]);

        }

        // Seleccionamos una categoría en base a un id

        public static function selectCategoriaById(int $id): ?Categoria{

            $categoria = null;

            self::$baseDatos->ejecutar('SELECT * FROM categorias WHERE id = :id', [
                ':id' => $id
            ]);

            $registro = self::$baseDatos->getSiguienteRegistro();

            if($registro){
                $categoria = new Categoria($registro['id'], $registro['nombre']);
            }

            return $categoria;

        }

        // Seleccionamos todas las categorías

        public static function selectCategorias(): array{

            $categorias = [];

            self::$baseDatos->ejecutar('SELECT * FROM categorias');

            $registros = self::$baseDatos->getRegistros();

            foreach($registros as $registro){
                array_push($categorias, new Categoria($registro['id'], $registro['nombre']));
            }

            return $categorias;

        }

    }

?>