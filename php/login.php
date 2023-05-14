<?php if(!session_id()) session_start();

    if($_SESSION['ARTESDB_SESSION'] == true) {
        header("Location: /index.html");
        exit();
    }

    $email = $_POST['email'];
    $senha = $_POST['senha'];
    include "conexao.php";
    $db = new Conexao();
    $usuario_resposta = $db->buscarUsuario($email);
    if(empty($usuario_resposta)) {
        echo "Nenhum usuário encontrado!";
    } else {
        echo "Usuário cadastrado! Checkando senha..." . "<br>";
        $senhadb = $usuario_resposta[0]["senha"];
        if($senhadb === $senha) {
            $_SESSION['ARTESDB_SESSION'] = Array(
                "logado" => true,
                "email" => $email
            );
            header("Location: /index.php");
            exit();
        } else {
            echo "Senha inválida!<br>";
        }
    }
    
?>