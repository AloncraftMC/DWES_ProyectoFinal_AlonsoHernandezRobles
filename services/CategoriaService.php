<?php

    namespace services;

    use models\Categoria;
    use repositories\CategoriaRepository;

    class CategoriaService{

        private static CategoriaRepository $categoriaRepository;

        public function __construct(){
            self::$categoriaRepository = new CategoriaRepository();
        }

        // Creamos una nueva categoría con nombre

        public static function create(string $nombre): void{
            self::$categoriaRepository->insert($nombre);
        }

        // Editamos el nombre de una categoría en base a un id

        public static function edit(int $id, string $nombre): void{
            self::$categoriaRepository->update($id, $nombre);
        }

        // Eliminamos una categoría en base a un id

        public static function delete(int $id): void{
            self::$categoriaRepository->delete($id);
        }

        // Obtenemos una categoría en base a un id

        public static function getCategoriaById(int $id): ?Categoria{
            return self::$categoriaRepository->selectCategoriaById($id);
        }

        // Obtenemos todas las categorías

        public static function getCategorias(): array{
            return self::$categoriaRepository->selectCategorias();
        }

    }

?>