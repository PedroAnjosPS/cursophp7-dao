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
                $this->setCad(new DateTime($row['dtcadastro']));
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