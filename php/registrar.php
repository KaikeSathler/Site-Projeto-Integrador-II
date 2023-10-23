<?php
if (!session_id())
    session_start();
if ($_SESSION['ARTESDB_SESSION'] == true) {
    header("Location: /index.php");
    exit();
}

$email = $_POST['email'];
$senha = $_POST['senha'];
$senhaconfirmar = $_POST['senhaconf'];
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];

require_once("../vendor/autoload.php");

use App\Conexao;

$db = new Conexao();
$usuario_resposta = $db->buscarUsuarioNotGoogle($email);
if (!empty($usuario_resposta)) {
    die("Já existe um usuário com este email!");
} else {
    echo "Usuário não encontrado! Registrando..." . "<br>";
    if ($senha === $senhaconfirmar) {
        $senha = password_hash($senha, PASSWORD_BCRYPT);
        $db->inserirUsuario($email, $senha, $nome, $sobrenome);
        sleep(2);
        $usuario = $db->buscarUsuarioNotGoogle($email);
        $_SESSION['ARTESDB_SESSION'] = serialize($usuario);
        header("Location: /index.php");
        exit();
    } else {
        echo "Senha inválida!<br>";
    }
}

?>