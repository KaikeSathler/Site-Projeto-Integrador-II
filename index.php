<?php if(!session_id()) session_start(); ?>

<?php

require ("php/conexao.php");

$usuario = null;

if(!empty($_SESSION['ARTESDB_SESSION'])) {

  if($_SESSION['ARTESDB_SESSION']["logado"]) {
  $db = new Conexao();
  $usuario = $db->buscarUsuario($_SESSION['ARTESDB_SESSION']['email']);
}



$inicial = substr($usuario[0]['nome'], 0, 1);

$sobrenome_ = strrpos($usuario[0]['sobrenome'], ' ');
$sobrenome = substr($usuario[0]['sobrenome'], $sobrenome_);

if($sobrenome[0] == " ") {
  $inicial .= substr($sobrenome, 1, 1);
} else {  
  $inicial .= substr($sobrenome, 0, 1);
}

$inicial = strtoupper($inicial);

}


?>
<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="" />
    <meta name="description" content="" />
    <link
      rel="shortcut icon" href="./img/icon/obra-de-arte.png" type="image/x-icon" />
    <link rel="stylesheet" href="./css/style.css"></link>
    <link rel="stylesheet" href="./css/input.css"></link>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title></title>
    <style>
      * {
        transition: all 250ms ease-in-out;
      }
      </style>
  </head>
  <body class="bg-white dark:bg-gray-950">
    <header>
      <div class = "sm:justify-center flex">
      <img src="./img/icon/arte.png" class="select-none m-auto w-12 items-center">
      </div>
      <nav class="bg-sky-300 p-4 w-100 dark:bg-slate-800">
        <ul class="flex gap-4 justify-between items-center">
          <div class="flex gap-4 items-center">
            <li><img src="./img/icon/arte.png" width="48" class="select-none"></li>
            <li><a class="!font-mono text-2xl text-sky-950 dark:text-white">Visuais I</a></li>
          </div>
          <div class="flex gap-1 items-center">
            <?php

            if(!empty($_SESSION['ARTESDB_SESSION'])) {

              if($_SESSION['ARTESDB_SESSION']['logado']) {
                echo "
                <div id='p-login'></div>
                <button class='bg-gray-200 dark:bg-gray-900 dark:text-white p-2 rounded flex flex-row gap-2 items-center'>Olá, " . $usuario[0]['nome'] . "<br/><a href='./php/deslogar.php' class=' px-2 py-1 text-white bg-red-600 rounded-md hover:underline'>Deslogar</a></button>" . PHP_EOL;
              }
            }
            ?>
            <i class=" trocartema !flex items-center fa-solid fa-sun fa-xl px-5 text-sky-900 align-middle rounded cursor-pointer dark:text-white" onclick="javascript:trocarTema();"></i>
            <i class=" flex p-3 fa fa-bars fa-xl cursor-pointer dark:text-white" onclick="javascript:abrirOffCanvas();"></i>
          </div>
        </ul>
      </nav>
    </header>
    <main>
      <div class="offcanvas-body fixed offCanvas_fechado transition-all overflow-x-auto right-0 h-screen top-0 bg-gray-800 text-white pr-48 pl-6 pt-6 flex flex-col gap-2">
        <h1 class="text-3xl">Título</h1>
        <span>Texto</span>
        <button class="text-white hover:opacity-80"><a href="pages/login.html" class="bg-sky-500 p-2 rounded">Acesse sua conta</a></button>
        <a href="#!" onclick = "javascript:fecharOffCanvas();" class="!text-red-800 text-2xl font-bold absolute right-3 top-3">X</a>
      </div>
    </main>
    <footer></footer>
    <script src="node_modules/@glidejs/glide/dist/glide.min.js"></script>
    <script src="./js/main.js"></script>
    <script type="module">

import UIAvatarSvg from "./node_modules/ui-avatar-svg/src/main.js";

const svg = (new UIAvatarSvg())
    .text('<?php echo $inicial; ?>')
    .size(55)
    .bgColor('#0ea5e9')
    .textColor('#ffffff')
    .generate();

    document.getElementById("p-login").insertAdjacentHTML("beforebegin", svg);

    </script>
  </body>
</html>