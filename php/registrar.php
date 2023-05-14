<?php if(!session_id()) session_start();

    if($_SESSION['ARTESDB_SESSION'] == true) {
        header("Location: /index.php");
        exit();
    }

    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senhaconfirmar = $_POST['senhaconf'];
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];

    include "conexao.php";
    $db = new Conexao();
    $usuario_resposta = $db->buscarUsuario($email);
    if(!empty($usuario_resposta)) {
        echo "Já existe um usuário com este email!";
        exit();
    } else {
        echo "Usuário não encontrado! Registrando..." . "<br>";
        if($senha === $senhaconfirmar) {
            $db->inserirUsuario($email, $senha, $nome, $sobrenome);
            header("Location: /pages/login.html");
            exit();
        } else {
            echo "Senha inválida!<br>";
        }
    }
    
?>