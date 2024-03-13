<?php
    require_once "config.php";

    /*$sql = new Sql();

    $usuarios = $sql->select("SELECT * FROM tb_usuarios");

    echo json_encode($usuarios);*/

    //Carrega só um usuário
    /*$usuario = new Usuario();

    $usuario->loadById(3);

    echo $usuario;*/

    //Carrega uma lista de usuários
    /*$lista = Usuario::getList();
    
    echo json_encode($lista);*/

    //Carrega uma lista de usuarios buscando pelo login
    /*$search = Usuario::search("root");

    echo json_encode($search);*/

    //Carregar usuario usando o login e a senha
    $usuario = new Usuario();
    $usuario->login("Pedro", "Ph*0763");

    echo $usuario;
?>