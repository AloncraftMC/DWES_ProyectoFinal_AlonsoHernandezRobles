<?php

    namespace repositories;

    use lib\BaseDatos;
    use models\Usuario;

    use PDO;
    use PDOException;

    class UsuarioRepository{

        private BaseDatos $baseDatos;

        public function __construct(){
            $this->baseDatos = new BaseDatos();
        }

        // Insertamos un nuevo usuario con nombre, apellidos, email, password y rol en la base de datos

        public function insert(string $nombre, string $apellidos, string $email, string $password, string $rol): void{
            
            $this->baseDatos->ejecutar('INSERT INTO usuarios (nombre, apellidos, email, password, rol) VALUES (:nombre, :apellidos, :email, :password, :rol)', [
                ':nombre' => $nombre,
                ':apellidos' => $apellidos,
                ':email' => $email,
                ':password' => $password,
                ':rol' => $rol
            ]);

        }

        // Modificamos los atributos de un usuario en base a un id

        public function update(int $id, string $nombre, string $apellidos, string $email, string $password, string $rol): void{

            $this->baseDatos->ejecutar('UPDATE usuarios SET nombre = :nombre, apellidos = :apellidos, email = :email, password = :password, rol = :rol WHERE id = :id', [
                ':id' => $id,
                ':nombre' => $nombre,
                ':apellidos' => $apellidos,
                ':email' => $email,
                ':password' => $password,
                ':rol' => $rol
            ]);

        }

        // Eliminamos un usuario en base a un id

        public function delete(int $id): void{

            $this->baseDatos->ejecutar('DELETE FROM usuarios WHERE id = :id', [
                ':id' => $id
            ]);

        }

        // Seleccionamos un usuario en base a un id

        public function selectUsuarioById(int $id): ?Usuario{

            $usuario = null;

            $this->baseDatos->ejecutar('SELECT * FROM usuarios WHERE id = :id', [
                ':id' => $id
            ]);

            $registro = $this->baseDatos->getSiguienteRegistro();

            if($registro !== false){
                $usuario = new Usuario($registro['id'], $registro['nombre'], $registro['apellidos'], $registro['email'], $registro['password'], $registro['rol']);
            }

            return $usuario;

        }
        
        // Seleccionamos todos los usuarios

        public function selectUsuarios(): array{

            $usuarios = [];

            $this->baseDatos->ejecutar('SELECT * FROM usuarios');

            $registros = $this->baseDatos->getRegistros();

            foreach($registros as $registro){
                $usuarios[] = new Usuario($registro['id'], $registro['nombre'], $registro['apellidos'], $registro['email'], $registro['password'], $registro['rol']);
            }

            return $usuarios;

        }

    }

?>