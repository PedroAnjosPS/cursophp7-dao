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
                $this->setData($resultado[0]);
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
                $this->setData($resultado[0]);
            } else {
                throw new Exception("Login e/ou senha inválidos.");
            }
        }

        public function setData($data){
            $this->setId($data['idusuario']);
            $this->setLogin($data['deslogin']);
            $this->setSenha($data['dessenha']);
            $this-> setCad(new DateTime($data['dtcadastro']));
        }

        public function __construct($login = "", $senha = ""){
             $this->setLogin($login);
             $this->setSenha($senha);
        }

        public function insert(){
            $sql = new Sql();

            $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
                ':LOGIN' => $this->getLogin(),
                ':PASSWORD' => $this->getSenha()
            ));

            if(count($results) > 0){
                $this->setData($results[0]);            
            }
        }

        public function update($login, $senha){
            $this->setLogin($login);
            $this->setSenha($senha);
            
            $sql = new Sql();

            $sql->queri("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :SENHA
            WHERE idusuario = :ID", array(
                ":LOGIN" => $this->getLogin(),
                ":SENHA" => $this->getSenha(),
                ":ID" => $this->getId()
            ));
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