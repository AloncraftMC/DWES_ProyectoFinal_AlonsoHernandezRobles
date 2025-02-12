<?php

    namespace repositories;

    use lib\BaseDatos;
    use models\Categoria;

    use PDO;
    use PDOException;

    class CategoriaRepository{

        private $baseDatos;

        public function __construct(){
            $this->baseDatos = new BaseDatos();
        }

        public function create($categoria){
            
            $this->baseDatos->ejecutar('INSERT INTO categorias (nombre) VALUES (:nombre)', [
                ':nombre' => $categoria->getNombre()
            ]);

        }

        public function update($categoria){

            $this->baseDatos->ejecutar('UPDATE categorias SET nombre = :nombre WHERE id = :id', [
                ':nombre' => $categoria->getNombre(),
                ':id' => $categoria->getId()
            ]);

        }

        public function delete($id){

            $this->baseDatos->ejecutar('DELETE FROM categorias WHERE id = :id', [
                ':id' => $id
            ]);

        }

        public function getCategoriaById($id){

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

        public function getCategorias(){

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