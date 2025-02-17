<?php

    namespace models;

    use lib\BaseDatos;

    class Usuario{

        private ?int $id;
        private ?string $nombre;
        private ?string $apellidos;
        private string $email;
        private string $password;
        private ?string $rol;
        private ?string $imagen;
        private BaseDatos $baseDatos;

        public function __construct(?int $id, ?string $nombre, ?string $apellidos, string $email, string $password, ?string $rol, ?string $imagen){

            $this->id = $id;
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->email = $email;
            $this->password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);
            $this->rol = $rol;
            $this->imagen = $imagen;
            $this->baseDatos = new BaseDatos();

        }
        
        public function getId(): ?int{
            return $this->id;
        }

        public function getNombre(): ?string{
            return $this->nombre;
        }

        public function getApellidos(): ?string{
            return $this->apellidos;
        }

        public function getEmail(): string{
            return $this->email;
        }

        public function getPassword(): string{
            return $this->password;
        }

        public function getRol(): ?string{
            return $this->rol;
        }

        public function getImagen(): ?string{
            return $this->imagen;
        }

        public function setId(int $id): void{
            $this->id = $id;
        }
        
        public function setNombre(string $nombre): void{
            $this->nombre = $nombre;
        }

        public function setApellidos(string $apellidos): void{
            $this->apellidos = $apellidos;
        }

        public function setEmail(string $email): void{
            $this->email = $email;
        }

        public function setPassword(string $password): void{
            $this->password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);
        }

        public function setRol(string $rol): void{
            $this->rol = $rol;
        }

        public function setImagen(string $imagen): void{
            $this->imagen = $imagen;
        }

        // Método para guardar un usuario en la base de datos y devolver true si se ha guardado correctamente

        public function guardar(): bool{
            
            $this->baseDatos->ejecutar("INSERT INTO usuarios (nombre, apellidos, email, password, rol, imagen) VALUES (:nombre, :apellidos, :email, :password, 'user', :imagen)", [
                ":nombre" => $this->nombre,
                ":apellidos" => $this->apellidos,
                ":email" => $this->email,
                ":password" => $this->password,
                ":imagen" => $this->imagen
            ]);

            return $this->baseDatos->getNumeroRegistros() > 0;

        }

        public function login(){

            $resultado = false;

            $email = $this->email;
            $password = $this->password;

            // Comprobar si existe el usuario

            $this->baseDatos->ejecutar("SELECT id, password FROM usuarios WHERE email = :email", [
                ":email" => $email
            ]);

            if($this->baseDatos->getNumeroRegistros() == 1){

                $usuario = $this->baseDatos->getSiguienteRegistro();

                // Comprobar si la contraseña es correcta

                if(password_verify($password, $usuario['password'])){

                    $resultado = true;

                }

            }

            return $resultado;

        }
        
    }

?>