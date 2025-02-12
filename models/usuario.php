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
        private BaseDatos $baseDatos;

        public function __construct(int $id, string $nombre, string $apellidos, string $email, string $password, string $rol){

            $this->id = $id;
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->email = $email;
            $this->password = $password;
            $this->rol = $rol;
            $this->baseDatos = new BaseDatos();

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
            $this->password = $password;
        }

        public function setRol(string $rol): void{
            $this->rol = $rol;
        }
        
    }

?>