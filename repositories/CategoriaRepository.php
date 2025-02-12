<?php

    namespace repositories;

    use lib\BaseDatos;
    use models\Categoria;

    use PDO;
    use PDOException;

    class CategoriaRepository{

        private BaseDatos $baseDatos;

        public function __construct(){
            $this->baseDatos = new BaseDatos();
        }

        // Insertamos una nueva categoría con nombre en la base de datos

        public function insert(string $nombre): void{
            
            $this->baseDatos->ejecutar('INSERT INTO categorias (nombre) VALUES (:nombre)', [
                ':nombre' => $nombre
            ]);

        }

        // Modificamos el nombre de una categoría en base a un id

        public function update(int $id, string $nombre): void{

            $this->baseDatos->ejecutar('UPDATE categorias SET nombre = :nombre WHERE id = :id', [
                ':id' => $id,
                ':nombre' => $nombre
            ]);

        }

        // Eliminamos una categoría en base a un id

        public function delete(int $id): void{

            $this->baseDatos->ejecutar('DELETE FROM categorias WHERE id = :id', [
                ':id' => $id
            ]);

        }

        // Seleccionamos una categoría en base a un id

        public function selectCategoriaById(int $id): ?Categoria{

            $categoria = null;

            $this->baseDatos->ejecutar('SELECT * FROM categorias WHERE id = :id', [
                ':id' => $id
            ]);

            $registro = $this->baseDatos->getSiguienteRegistro();

            if($registro){
                $categoria = new Categoria($registro['id'], $registro['nombre']);
            }

            return $categoria;

        }

        // Seleccionamos todas las categorías

        public function selectCategorias(): array{

            $categorias = [];

            $this->baseDatos->ejecutar('SELECT * FROM categorias');

            $registros = $this->baseDatos->getRegistros();

            foreach($registros as $registro){
                array_push($categorias, new Categoria($registro['id'], $registro['nombre']));
            }

            return $categorias;

        }

    }

?>