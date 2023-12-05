<?php
session_start();

use App\GoogleClientConnection as GoogleClientConnection;
use App\Conexao as Conexao;

require_once '../vendor/autoload.php';

$google_client = (new GoogleClientConnection())->getConnection();
$google_client->setRedirectUri("http://localhost/php/login.php");

$erroEmail = false;
$erroSenha = false;

if(isset($_POST['email'])) {
  $conexao = new Conexao();
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $usuario = $conexao->buscarUsuario($email);
  if(!empty($usuario)) {
    if($usuario['senha'] !== $senha) {
      $erroSenha = true;
    }
  } else {
    $erroEmail = true;
  }
}

if (isset($_GET['emailIncorreto'])) {
  $erroEmail = true;
}


if(!$erroEmail && !$erroSenha && !empty($usuario)) {
  $_SESSION['ARTESDB_SESSION'] = serialize($usuario);
  header("Location: ../");
  exit();
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Artes Visuais I - Login</title>
    <link rel="stylesheet" href="../css/input.css" />
    <link rel="shortcut icon" href="../img/icon/icob.png" type="image/x-icon">
    <link
      href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body style="background: linear-gradient(90deg, #e3ffe7 0%, #d9e7ff 100%)">
  
    <section class="min-h-screen flex items-center justify-center flex-col">
    <button class="mb-4 hover:scale-125 duration-300"><a href="../"><i class="fa-solid fa-right-from-bracket fa-rotate-180 fa-lg text-[#002D74] hover:text-[#0947ac] duration-300" fa-xl"></i></a></button>
      <div
        class="bg-white/80 backdrop-blur flex rounded-2xl max-w-3xl p-5 shadow-xl items-center"
      >
        <div class="px-8 md:px-auto">
          <h2 class="text-center font-medium3 text-2xl text-[#002D74]">
            Login
          </h2>
          <p class="text-xs mt-4 text-[#002D74]"></p>
          <form
            action="../php/login.php"
            class="flex flex-col gap-4"
            aria-required="false"
            method="POST"
          >
            <div class="relative">
              <input
                class="p-2 mt-8 rounded-md focus:ring-2 border focus:outline-none w-full"
                type="email"
                name="email"
                placeholder="Email"
                required
              />
              <?php if($erroEmail) { ?>
              <div
                class="text-red-900 bg-red-300 p-2 rounded mt-2"
                id="erroEmail"
              >
                * Este e-mail não existe.
              </div>
              <?php } ?>
            </div>
            <div class="relative">
              <input
                class="p-2 rounded-md focus:ring-2 focus:outline-none border w-full"
                type="password"
                name="senha"
                placeholder="Senha"
                required
              />
              <?php if(isset($_GET['senhaIncorreta'])) { ?>
              <div
                class="text-red-900 bg-red-300 p-2 rounded mt-2"
                id="erroSenha"
              >
                * Senha inválida.
              </div>
              <?php } ?>
              <div
                class="w-full text-xs border-b border-gray-400 py-4 text-[#002D74] hover:underline"
              >
                <a class="text-sm text-right block" href="#"
                  >Esqueceu sua senha?</a
                >
              </div>
            </div>
            <input type="submit" value="logar"
              class=" cursor-pointer bg-[#002D74] rounded-lg hover:bg-[#0947ac]  text-white py-2 hover:scale-105 duration-300"
            >
              
            </input>
            <div class="mt-5 text-center text-xs text-[#002D74]">
              <a class="text-sm"
                >Não possui uma conta?<a href="./registrar.php" class="text-sm font-bold px-2 hover:underline"
                  >Registre-se</a
                ></a
              >
            </div>
          </form>
          <div class="mt-6 grid grid-cols-3 items-center text-gray-400">
            <hr class="border-gray-400" />
            <p class="text-center text-sm">OU</p>
            <hr class="border-gray-400" />
          </div>
          <?php echo "<button
            class='m-auto py-2 px-4 bg-white border hover:ring-2 rounded-xl mt-5 flex gap-2 justify-center items-center text-sm hover:scale-105 duration-300 text-[#002D74]' onclick='mudarPagina()'
          ><img class='w-9' src='../img/icon/logo_google_icon.png' /><a class='w-full' href='" . $google_client->createAuthUrl() . "'>Login com Google</a></button>" . 
           PHP_EOL ;
          ?>
        </div>
      </div>
    </section>
  </body>

  <script>
    function mudarPagina() {
      window.location.href = "<?php echo $google_client->createAuthUrl(); ?>"
    }
    let formulario = document.querySelector("form");

    let regex = new RegExp(/^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z]+$/gi);
    let regex2 = new RegExp(/[$&+,:;=?@#|'<>.^*()%!-]/);

    let campoEmail = formulario.elements[0];
    let campoSenha = formulario.elements[1];

    document
      .getElementsByName("email")[0]
      .addEventListener("input", function (e) {
        if (!regex.test(e.target.value)) {
          e.target.classList.add("border-red-500");
        } else {
          e.target.classList.remove("border-red-500");
        }
      });

    document
      .getElementsByName("senha")[0]
      .addEventListener("input", function (e) {
        console.log(e.target.value);
        if (regex2.test(e.target.value)) {
          e.target.classList.add("border-red-500");
        } else {
          e.target.classList.remove("border-red-500");
        }
      });

    formulario.addEventListener("submit", function (e) {
      if (campoSenha.value.length < 3) {
        document.getElementById("erroSenha").classList.remove("hidden");
        document.getElementById("erroSenha").classList.add("block");
        e.preventDefault();
      } else {
        document.getElementById("erroSenha").classList.add("hidden");
        document.getElementById("erroSenha").classList.remove("block");
      }

      if (!regex.test(campoEmail.value)) {
        document.getElementById("erroEmail").classList.remove("hidden");
        document.getElementById("erroEmail").classList.add("block");
        e.preventDefault();
      } else {
        document.getElementById("erroEmail").classList.add("hidden");
        document.getElementById("erroEmail").classList.remove("block");
      }
    });
  </script>
</html>
