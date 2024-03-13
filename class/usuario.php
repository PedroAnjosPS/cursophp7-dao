<?php
    class Usuario{
        private $idusuario, $deslogin, $dessenha, $dtcadastro;

        public function getId(){
            return $this->idusuario;
        }

        public function getLogin(){
            return $this->deslogin;
        }

        public function getSenha(){
            return $this->dessenha;
        }

        public function getCad(){
            return $this->dtcadastro;
        }

        public function setId($id){
            $this->idusuario = $id;
        }

        public function setLogin($login){
            $this->deslogin = $login;
        }

        public function setSenha($senha){
            $this->dessenha = $senha;
        }

        public function setCad($cad){
            $this->dtcadastro = $cad;
        }

        public function loadById($id){
            $sql = new Sql();
            $resultado = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
                ":ID" => $id
            ));

            if(count($resultado[0]) > 0){
                $row = $resultado[0];

                $this->setId($row['idusuario']);
                $this->setLogin($row['deslogin']);
                $this->setSenha($row['dessenha']);
                $this-> setCad(new DateTime($row['dtcadastro']));
            }
        }

        public static function getList(){
            $sql = new Sql();

            return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
        }

        public static function search($login){
            $sql = new Sql();

            return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
                ':SEARCH' => "%" . $login . "%"
            ));
        }

        public function login($login, $senha){
            $sql = new Sql();
            $resultado = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :SENHA", array(
                ":LOGIN" => $login,
                ":SENHA" => $senha
            ));

            if(count($resultado[0]) > 0){
                $row = $resultado[0];

                $this->setId($row['idusuario']);
                $this->setLogin($row['deslogin']);
                $this->setSenha($row['dessenha']);
                $this-> setCad(new DateTime($row['dtcadastro']));
            } else {
                throw new Exception("Login e/ou senha inválidos.");
            }
        }

        public function __toString(){
            return json_encode(array(
                "idusuario" => $this->getId(),
                "deslogin" => $this->getLogin(),
                "dessenha" => $this->getSenha(),
                "dtcadastro" => $this->getCad()->format("d/m/Y H:i:s")
            ));
        }
    }
?>