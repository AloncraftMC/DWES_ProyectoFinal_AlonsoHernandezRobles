<?php

    namespace services;

    use models\Usuario;
    use repositories\UsuarioRepository;

    class UsuarioService{

        private static UsuarioRepository $usuarioRepository;

        public function __construct(){
            self::$usuarioRepository = new UsuarioRepository();
        }

        // Creamos un nuevo usuario con nombre, apellidos, email, password y rol

        public static function create(string $nombre, string $apellidos, string $email, string $password, string $rol): void{
            self::$usuarioRepository->insert($nombre, $apellidos, $email, $password, $rol);
        }

        // Actualizamos un usuario en base a un id con nombre, apellidos, email, password y rol

        public static function edit(int $id, string $nombre, string $apellidos, string $email, string $password, string $rol): void{
            self::$usuarioRepository->update($id, $nombre, $apellidos, $email, $password, $rol);
        }

        // Eliminamos un usuario en base a un id

        public static function delete(int $id): void{
            self::$usuarioRepository->delete($id);
        }

        // Obtenemos un usuario en base a un id

        public static function getUsuarioById(int $id): ?Usuario{
            return self::$usuarioRepository->selectUsuarioById($id);
        }

        // Obtenemos todos los usuarios

        public static function getUsuarios(): array{
            return self::$usuarioRepository->selectUsuarios();
        }

    }

?>