<?php
if (!session_id())
    session_start();
ini_set("display_errors", true);
if ($_SESSION['ARTESDB_SESSION'] == true) {
    header("Location: /index.php");
    exit();
}

$email = $_POST['email'];
$senha = $_POST['senha'];
$senhaconfirmar = $_POST['senhaconf'];
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("digita esse email certo");
}
require_once("../vendor/autoload.php");

use App\Conexao;

$db = new Conexao();
$usuario_resposta = $db->buscarUsuarioNotGoogle($email);
if (!empty($usuario_resposta)) {
    echo "<h1 class='text-red-500 text-xl'>Já existe um usuário com este email!</h1>";
    echo "
        <script>
            setTimeout(function() {
                window.location.href = '../pages/registrar.php';
            }, 5000);
        </script>  
    ";
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