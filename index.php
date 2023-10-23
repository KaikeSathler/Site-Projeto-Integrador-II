<!DOCTYPE html>
<html lang="pt">

<?php
if (!session_id())
{
				session_start();
}
require "vendor/autoload.php";
use App\Conexao;

$usuario = null;
$teste = "a";

$db = new Conexao();

if (!empty($_SESSION["ARTESDB_SESSION"]))
{
				$sessionDetails = unserialize($_SESSION["ARTESDB_SESSION"]);
				$usuario = $db->buscarUsuario($sessionDetails["email"]);
				$inicial = substr($usuario["nome"], 0, 1);

				$sobrenome_ = strrpos($usuario["sobrenome"], " ");
				$sobrenome = substr($usuario["sobrenome"], $sobrenome_);

				if ($sobrenome[0] == " ")
				{
								$inicial .= substr($sobrenome, 1, 1);
				}
				else
				{
								$inicial .= substr($sobrenome, 0, 1);
				}

				$inicial = strtoupper($inicial);
}
?>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="title" content="" />
  <meta name="description" content="" />
  <title>Visuais I - O melhor apoio Artistico</title>
  <link rel="shortcut icon" href="./img/icon/icob.png" type="image/x-icon" />
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
  <header id="header">
    <?php require "./components/navbar.php"; ?>
  </header>
  <main>
    <div
      class=" z-10 offcanvas-body fixed offCanvas_fechado transition-all overflow-x-auto right-0 h-screen top-0 bg-gray-900  text-white">
      <div class="p-4 border-b ">
        <a href="#!" onclick="javascript:fecharOffCanvas();"><i
            class="fa-regular fa-circle-xmark fa-xl font-bold left-3 hover:!text-red-500"></i></a>
      </div>
      <div class=" off-canvas-container flex flex-col  justify-start text-white">
        <a href="#header" class=""><i class="fa-solid fa-house mr-2">&nbsp;</i>Página Inicial</a>
        <a href="#title_container" class=""><i class="fa-solid fa-house mr-2">&nbsp;</i>Conteúdos</a>
      </div>
      <?php if (!empty($_SESSION["ARTESDB_SESSION"]) || !empty($_SESSION["google_id"]))
{
				echo '<button class=" m-auto table mt-4 text-white hover:opacity-80"><a href="./php/deslogar.php" class="bg-red-500 p-2 rounded"><i class="fa-regular fa-user" style="color: #ffffff;"></i>&nbsp;&nbsp;Desconectar</a></button>' . PHP_EOL;
}
else
{
				echo '<button class=" m-auto table mt-4 text-white hover:opacity-80"><a href="pages/login.php" class="bg-sky-500 p-2 rounded"><i class="fa-regular fa-user" style="color: #ffffff;"></i>&nbsp;&nbsp;Acesse sua conta</a></button>' . PHP_EOL;
} ?>
    </div>
    <div class="home w-full">
      <div id="home-image" />
      <div class="home-container sm:ml-10 m-auto sm:p-0 w-1/2 sm:pt-12 sm:flex table sm:flex-col sm:gap-2">
        <h1 class="titulo text-6xl font-extrabold leading-[0.9] tracking-tight text-center sm:text-start mt-11 sm:mt-0
         dark:text-slate-300 md:text-8xl p-1 py-9 transition-all ease-in duration-150
        ">
          Arte que transborda<h1>
            <h2
              class="frase text-3xl first-letter:font-bold drop-shadow-lg bg-gradient-to-r from-sky-300 to-sky-500  dark:from-gray-300 dark:to-gray-400 bg-clip-text text-transparent text-center sm:text-start p-4 sm:p-0 transition-all ease-in duration-150">
              Explore um mundo de imagens surpreendentes, onde cores e formas se misturam para contar
              histórias cheias
              de emoção.</h2><span id="cursor"></span>
            <button
              class=" button-headerc dark:bg-gray-300 dark:text-gray-800 hover:dark:bg-slate-200 bg-sky-500 flex text-center items-center justify-center sm:w-36 m-auto sm:m-0 px-4 py-3 rounded-md mt-4  hover:bg-sky-300 hover:text-sky-900 text-lg transition-all ease-in duration-150 sm:mt-7">Saiba
              mais</button>
      </div>
    </div>
    <div class="image-line xl:block hidden">
      <img src="./img/Image_line.jpg" alt="">
    </div>
    <ol class="relative border-l m-10 sm:ml-16 sm:mt-16 border-sky-200 dark:border-gray-700">
      <h1 id="title_container"
        class="sm:text-5xl text-4
xl mb-10 table text-4xl m-auto sm:m-2 sm:mb-10 font-semibold text-transparent bg-clip-text bg-gradient-to-r from-sky-300 to-sky-500">
        Conteúdos
      </h1>
      <li class="mb-10 ml-4">
        <div
          class="absolute w-3 h-3 bg-sky-200 rounded-full mt-5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700">
        </div>
        <h3
          class="text-3xl font-semibold text-gray-900 dark:text-white py-3 hover:scale-110 hover:translate-x-[5%] hover:text-transparent hover:bg-clip-text hover:bg-gradient-to-r from-red-400 to-green-500 bg-[length:200%_150%] cursor-pointer transition animation-gradient">
          Arte</h3>
        <p class="font-medium text-lg text-gray-500 dark:text-gray-400">O que é Arte;
          <br>
          Como são identificados;
          <br>
          Arte Cronológica
          <br>
          <div class="pl-4 font-medium text-lg text-gray-500 dark:text-gray-400">
          <span class="material-symbols-outlined">
            subdirectory_arrow_right
          </span>Clássica
          <br>
          <span class="material-symbols-outlined">
            subdirectory_arrow_right
          </span>Moderna.
          <br>
          <span class="material-symbols-outlined">
            subdirectory_arrow_right
          </span>Contemporânea.
          </div>
        </p>
      </li>
      <li class=" mb-10 ml-4">
        <div
          class="absolute w-3 h-3 bg-sky-200 rounded-full mt-5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700">
        </div>
        <h3 class="text-3xl title_line font-semibold text-gray-900 dark:text-white py-3 hover:scale-110 hover:translate-x-[5%] hover:text-transparent hover:bg-clip-text hover:bg-gradient-to-r from-red-400 to-green-500 bg-[length:200%_150%] cursor-pointer transition animation-gradient">Linhas</h3>
        <p class="mb-4 text-lg font-medium text-gray-500 dark:text-gray-400">O que são linhas e quais são elas.
        </p>
      </li>
      <li class="mb-10 ml-4">
        <div
          class="absolute w-3 h-3 bg-sky-200 rounded-full mt-5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700">
        </div>
        <h3 class="title_texture text-3xl text-gray-900 dark:text-white py-3">Texturas</h3>
        <p class="font-medium text-lg text-gray-500 dark:text-gray-400">O que são;<br>Como são
          identificados.<br></p>
      </li>
      <li class="mb-10 ml-4">
        <div
          class="absolute w-3 h-3 bg-sky-200 rounded-full mt-5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700">
        </div>
        <h3 class="text-3xl font-semibold text-gray-900 dark:text-white py-3">Releitura de Obras de Arte</h3>
        <p class="font-medium text-lg text-gray-500 dark:text-gray-400">Leitura racional;<br>leitura
          sensorial;<br>Leitura Emocional</p>
        <p class="font-medium text-lg text-gray-500 dark:text-gray-400 pl-4"><span
            class="material-symbols-outlined">
            subdirectory_arrow_right
          </span>Recriação de obras de arte.</p>
    </ol>
  </main>
  <footer class="bg-slate-100 dark:bg-gray-950 dark:text-gray-400 text-slate-800 text-center p-3">Desenvolvido por
    <span class="hover:underline hover:cursor-pointer"><a
        href="https://github.com/KaikeSathler?tab=overview&from=2023-09-01&to=2023-09-22">Kaike
        Sathler</a></span><br>Escrito por Kauã Rossanezi
  </footer>
  <script src="./js/main.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"
    integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
  <script type="module">
    import UIAvatarSvg from "./node_modules/ui-avatar-svg/src/main.js";
    <?php if (!empty($inicial))
{ ?>
      const svg = (new UIAvatarSvg())
        .text('<?php echo $inicial; ?>')
        .size(48)
        .bgColor('#0ea5e9')
        .textColor('#ffffff')
        .generate();

      document.getElementById("p-login").insertAdjacentHTML("beforebegin", svg);
    <?php
} ?>
  </script>
</body>

</html>
