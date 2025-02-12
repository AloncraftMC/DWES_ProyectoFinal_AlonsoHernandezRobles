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

        public function create(Categoria $categoria){
            
            

        }

    }

?>