<?php

    namespace models;

    use lib\BaseDatos;

    class Usuario{

        private int $id;
        private string $nombre;
        private string $apellidos;
        private string $email;
        private string $password;
        private string $rol;
        private string $imagen;
        private BaseDatos $baseDatos;
        
        public function __construct(string $nombre, string $apellidos, string $email, string $password, string $rol, ?string $imagen){
            
            // Conexión a la base de datos

            $this->baseDatos = new BaseDatos();

            // Primero hasheamos la contraseña

            $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);

            // Insertamos un nuevo usuario en la base de datos

            $this->baseDatos->ejecutar('INSERT INTO usuarios (nombre, apellidos, email, password, rol, imagen) VALUES (:nombre, :apellidos, :email, :password, :rol, :imagen)', [
                ':nombre' => $nombre,
                ':apellidos' => $apellidos,
                ':email' => $email,
                ':password' => $password,
                ':rol' => $rol,
                ':imagen' => $imagen
            ]);

            // Establecemos la id que ha sido generada auto-incrementalmente en la BD

            $this->id = $this->baseDatos->getUltimoId();

            // Establecemos el resto de atributos que no son problemáticos

            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->email = $email;
            $this->rol = $rol;
            $this->imagen = $imagen;
            
        }
        
        public function getId(): int{
            return $this->id;
        }

        public function getNombre(): string{
            return $this->nombre;
        }

        public function getApellidos(): string{
            return $this->apellidos;
        }

        public function getEmail(): string{
            return $this->email;
        }

        public function getPassword(): string{
            return $this->password;
        }

        public function getRol(): string{
            return $this->rol;
        }

        public function getImagen(): string{
            return $this->imagen;
        }

        public function setId(int $id): void{
            
            // Primero actualizamos la id en la base de datos

            $this->baseDatos->ejecutar('UPDATE usuarios SET id = :id WHERE id = :id', [
                ':id' => $id
            ]);

            // Y luego en el objeto

            $this->id = $id;

        }
        
        public function setNombre(string $nombre): void{
            
            // Actualizamos el nombre en la base de datos

            $this->baseDatos->ejecutar('UPDATE usuarios SET nombre = :nombre WHERE id = :id', [
                ':id' => $this->id,
                ':nombre' => $nombre
            ]);

            // Y luego en el objeto

            $this->nombre = $nombre;

        }

        public function setApellidos(string $apellidos): void{
            
            // Actualizamos los apellidos en la base de datos

            $this->baseDatos->ejecutar('UPDATE usuarios SET apellidos = :apellidos WHERE id = :id', [
                ':id' => $this->id,
                ':apellidos' => $apellidos
            ]);

            // Y luego en el objeto

            $this->apellidos = $apellidos;

        }

        public function setEmail(string $email): void{
            
            // Actualizamos el email en la base de datos

            $this->baseDatos->ejecutar('UPDATE usuarios SET email = :email WHERE id = :id', [
                ':id' => $this->id,
                ':email' => $email
            ]);

            // Y luego en el objeto

            $this->email = $email;

        }

        public function setPassword(string $password): void{

            // Primero hasheamos la contraseña

            $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);
            
            // Actualizamos la contraseña en la base de datos

            $this->baseDatos->ejecutar('UPDATE usuarios SET password = :password WHERE id = :id', [
                ':id' => $this->id,
                ':password' => $password
            ]);

            // Y luego en el objeto

            $this->password = $password;

        }

        public function setRol(string $rol): void{
            
            // Actualizamos el rol en la base de datos

            $this->baseDatos->ejecutar('UPDATE usuarios SET rol = :rol WHERE id = :id', [
                ':id' => $this->id,
                ':rol' => $rol
            ]);

            // Y luego en el objeto

            $this->rol = $rol;

        }

        public function setImagen(string $imagen): void{
            
            // Actualizamos la imagen en la base de datos

            $this->baseDatos->ejecutar('UPDATE usuarios SET imagen = :imagen WHERE id = :id', [
                ':id' => $this->id,
                ':imagen' => $imagen
            ]);

            // Y luego en el objeto

            $this->imagen = $imagen;

        }   
        
    }

?>