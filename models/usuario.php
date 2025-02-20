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
        private ?string $imagen;
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
            $this->password = $password;
        }

        public function setRol(string $rol): void{
            $this->rol = $rol;
        }

        public function setImagen(?string $imagen): void{
            $this->imagen = $imagen;
        }

        /* MÉTODOS */

        public function save(): bool{
            
            $this->baseDatos->ejecutar("INSERT INTO usuarios VALUES(null, :nombre, :apellidos, :email, :password, 'user', null)", [
                ':nombre' => $this->nombre,
                ':apellidos' => $this->apellidos,
                ':email' => $this->email,
                ':password' => password_hash($this->password, PASSWORD_BCRYPT, ['cost' => 4]),
            ]);

            return $this->baseDatos->getNumeroRegistros() == 1;

        }

        public function login(): ?Usuario{
            
            $this->baseDatos->ejecutar("SELECT * FROM usuarios WHERE email = :email", [
                ':email' => $this->email,
            ]);

            if($this->baseDatos->getNumeroRegistros() == 1){
                
                $usuario = $this->baseDatos->getSiguienteRegistro();
                
                if(password_verify($this->password, $usuario['password'])){

                    $this->setId($usuario['id']);
                    $this->setNombre($usuario['nombre']);
                    $this->setApellidos($usuario['apellidos']);
                    $this->setEmail($usuario['email']);
                    $this->setRol($usuario['rol']);
                    $this->setImagen($usuario['imagen']);
                    return $this;

                }

            }

            return null;

        }
        
    }

?>