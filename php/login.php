<?php

if (!session_id())
    session_start();

// Inicia a conexão com o banco de dados e o Google
use App\Conexao;
use App\GoogleClientConnection as GoogleClientConnection;

// Carrega as classes

require_once '../vendor/autoload.php';

// Se existir um código de autenticação do Google na URL...

if (isset($_GET['code'])) {
    // Instancia o cliente do Google
    $google_client = (new GoogleClientConnection())->getConnection();
    // Configura o redirecionamento da URI (dá erro se não tiver)
    $google_client->setRedirectUri("http://localhost/php/login.php");
    // Tenta conseguir o token de acesso pelo código na URL
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    // Se der certo...
    if (!isset($token['error'])) {
        // Configura o cliente do Google, instanciando esse token na classe
        $google_client->setAccessToken($token['access_token']);
        // Cria o serviço de autenticação do Google com base no cliente do Google
        $google_service = new Google_Service_Oauth2($google_client);
        // Obtem as informações do usuário
        $data = $google_service->userinfo->get();
        // Instancia o banco de dados
        $db = new Conexao();
        // Busca um usuário no banco de dados com base no email da conta do Google
        $usuario = $db->buscarUsuario($data['email']);
        if (empty($usuario)) {
            $db->inserirUsuario($data['email'], "", $data['given_name'], $data['family_name'], "google", $data['id']);
        }
        // Guarda o ID da conta do Google e o nome do usuário em uma sessão.
        $_SESSION['google_name'] = $data['name'];
        $_SESSION['google_id'] = $data['id'];
        $_SESSION['google_picture'] = $data['picture'];
        // Redireciona para o index
        header("Location: ../index.php");
        // die();
    } else {
        header("Location: ../pages/login.php");
        die();
    }
}

// Se o usuário não estiver se conectando com o Google e/ou GitHub, então, verifica se foi passado o e-mail via POST

if (isset($_POST['email'])) {
    // Instancia o banco de dados
    $conexao = new Conexao();
    // Obtem o email e a senha via método POST =D
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    // Busca o usuário no banco de dados com base no e-mail
    $usuario = $conexao->buscarUsuario($email);
    // Verifica se o usuário existe ou não
    if (!empty($usuario)) {
        // Se o cara for burro e errar a senha, o sistema vai reclamar
        if (!password_verify($senha, $usuario['senha'])) {
            header("Location: ../pages/login.php?senhaIncorreta=true");
        } else {
            $_SESSION['ARTESDB_SESSION'] = serialize($usuario);
            header("Location: ../index.php");
            exit();
        }
    } else {
        header("Location: ../pages/login.php?emailIncorreto=true");
        exit();
    }
}


?>