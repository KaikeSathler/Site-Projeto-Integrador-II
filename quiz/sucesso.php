<?php
    if(!session_id()) session_start();

    if($_SERVER['REQUEST_METHOD'] != "POST") {
        die("<h1>Você não tem permissão para acessar este arquivo</h1>");
    }

    require_once("../vendor/autoload.php");

    use App\Conexao;

    $db = new Conexao();
    $acertos = $_POST['acertos'];
    $erros = $_POST['erros'];
    $quizId = $_POST['quizid'];
    $quizzes = null;
    $resultados = null;
    $email = null;
    $provider = null;

    if(isset($_SESSION['google_email'])) {
        $email = $_SESSION['google_email'];
        $provider = "google";
    } else {
        $dados = unserialize($_SESSION['ARTESDB_SESSION']);
        $email = $dados['email'];
        $provider = $dados['oauth_provider'];
    }

    $quizzes = json_decode($db->buscarUsuariosQuizzes($email, $provider)[0]['quizzes_json']);
    if(!in_array($quizId, $quizzes)) {
        $quizzesTmp = [...$quizzes, intval($quizId)];
        var_dump($quizzesTmp);
        $db->atualizarUsuariosQuizzes($quizzesTmp, $email, $provider);
        $db->AtualizarEstatisticas($email, $acertos, $erros, $provider);
    }
    $resultados = $db->bucarQuizzesFeitos($email, $provider);

    if($resultados[0]['quizzes_feitos']>=10) {
        echo "Você antigiu o limite quizzes";
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="" />
    <meta name="description" content="" />
    <title>Visuais I - O melhor apoio Artistico</title>
    <link rel="shortcut icon" href="../img/icon/icob.png" type="image/x-icon" />
    <link rel="stylesheet" href="./css/input.css">
    </link>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            content: ["./*.html"],
            darkMode: "class"
        };
    </script>
</head>

<body class="bg-white dark:bg-gray-900">
    <main class="h-full">
       <h1>Parabéns!!! Você acertou <?php echo $acertos; ?> de <?php echo ($erros + $acertos); ?> perguntas! Seus acertos e erros foram computados com sucesso :)</h1>
    </main>
</body>
</html>