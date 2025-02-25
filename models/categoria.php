<?php

    namespace models;

    use lib\BaseDatos;

    class Categoria{

        private int $id;
        private string $nombre;
        private BaseDatos $baseDatos;

        public function __construct(){
            $this->baseDatos = new BaseDatos();
        }

        /* GETTERS Y SETTERS */
        
        public function getId(): int{
            return $this->id;
        }

        public function getNombre(): string{
            return $this->nombre;
        }

        public function setId(int $id): void{
            $this->id = $id;
        }

        public function setNombre(string $nombre): void{
            $this->nombre = $nombre;
        }

        /* MÉTODOS DINÁMICOS */

        public function save(): bool{

            $this->baseDatos->ejecutar("INSERT INTO categorias VALUES(null, :nombre)", [
                ':nombre' => $this->nombre
            ]);

            return $this->baseDatos->getNumeroRegistros() == 1;

        }

        public function update(): bool {

            $this->baseDatos->ejecutar("UPDATE categorias SET nombre = :nombre WHERE id = :id", [
                ':nombre' => $this->nombre,
                ':id' => $this->id
            ]);
            
            return $this->baseDatos->getNumeroRegistros() == 1;

        }

        public function delete(): bool{

            $this->baseDatos->ejecutar("DELETE FROM categorias WHERE id = :id", [
                ':id' => $this->id
            ]);

            return $this->baseDatos->getNumeroRegistros() == 1;

        }

        /* MÉTODOS ESTÁTICOS */

        public static function getById(int $id): ?Categoria {

            $baseDatos = new BaseDatos();
            $baseDatos->ejecutar("SELECT * FROM categorias WHERE id = :id", [
                ':id' => $id
            ]);

            if($baseDatos->getNumeroRegistros() == 1){

                $registro = $baseDatos->getSiguienteRegistro();

                $categoria = new Categoria();

                $categoria->setId($registro['id']);
                $categoria->setNombre($registro['nombre']);

                return $categoria;

            }

            return null;

        }

        public static function getAll(): array {

            $baseDatos = new BaseDatos();
            $baseDatos->ejecutar("SELECT * FROM categorias");
        
            $registros = $baseDatos->getRegistros();

            $categorias = [];
        
            foreach ($registros as $registro) {

                $categoria = new Categoria();

                $categoria->setId($registro['id']);
                $categoria->setNombre($registro['nombre']);
        
                array_push($categorias, $categoria);
                
            }
        
            return $categorias;
            
        }

    }

?>