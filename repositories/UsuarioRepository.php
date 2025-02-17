<?php

    namespace repositories;

    use lib\BaseDatos;
    use models\Usuario;

    use PDO;
    use PDOException;

    class UsuarioRepository{

        private static BaseDatos $baseDatos;

        public function __construct(){
            self::$baseDatos = new BaseDatos();
        }

        // Insertamos un nuevo usuario con nombre, apellidos, email, password, rol e imagen en la base de datos

        public static function insert(string $nombre, string $apellidos, string $email, string $password, string $rol, string $imagen): void{
            
            self::$baseDatos->ejecutar('INSERT INTO usuarios (nombre, apellidos, email, password, rol) VALUES (:nombre, :apellidos, :email, :password, :rol, :imagen)', [
                ':nombre' => $nombre,
                ':apellidos' => $apellidos,
                ':email' => $email,
                ':password' => $password,
                ':rol' => $rol,
                ':imagen' => $imagen
            ]);

        }

        // Modificamos los atributos de un usuario en base a un id

        public static function update(int $id, string $nombre, string $apellidos, string $email, string $password, string $rol): void{

            self::$baseDatos->ejecutar('UPDATE usuarios SET nombre = :nombre, apellidos = :apellidos, email = :email, password = :password, rol = :rol WHERE id = :id', [
                ':id' => $id,
                ':nombre' => $nombre,
                ':apellidos' => $apellidos,
                ':email' => $email,
                ':password' => $password,
                ':rol' => $rol
            ]);

        }

        // Eliminamos un usuario en base a un id

        public static function delete(int $id): void{

            self::$baseDatos->ejecutar('DELETE FROM usuarios WHERE id = :id', [
                ':id' => $id
            ]);

        }

        // Seleccionamos un usuario en base a un id

        public static function selectUsuarioById(int $id): ?Usuario{

            $usuario = null;

            self::$baseDatos->ejecutar('SELECT * FROM usuarios WHERE id = :id', [
                ':id' => $id
            ]);

            $registro = self::$baseDatos->getSiguienteRegistro();

            if($registro !== false){
                $usuario = new Usuario($registro['id'], $registro['nombre'], $registro['apellidos'], $registro['email'], $registro['password'], $registro['rol'], $registro['imagen']);
            }

            return $usuario;

        }
        
        // Seleccionamos todos los usuarios

        public static function selectUsuarios(): array{

            $usuarios = [];

            self::$baseDatos->ejecutar('SELECT * FROM usuarios');

            $registros = self::$baseDatos->getRegistros();

            foreach($registros as $registro){
                $usuarios[] = new Usuario($registro['id'], $registro['nombre'], $registro['apellidos'], $registro['email'], $registro['password'], $registro['rol'], $registro['imagen']);
            }

            return $usuarios;

        }

    }

?>