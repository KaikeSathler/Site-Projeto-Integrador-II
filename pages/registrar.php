<?php

session_start();

use App\GoogleClientConnection as GoogleClientConnection;

require_once '../vendor/autoload.php';

$google_client = (new GoogleClientConnection())->getConnection();
$google_client->setRedirectUri("http://localhost/php/login.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../img/icon/icob.png" type="image/x-icon">
  <title>Tela de Registro</title>
  <link rel="stylesheet" href="../css/input.css">
  <link
      href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css"
      rel="stylesheet"
    />
  <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body style="background: linear-gradient(90deg, #e3ffe7 0%, #d9e7ff 100%);">
  <section class="min-h-screen flex items-center justify-center flex-col">
    <button class="mb-4 hover:scale-125 duration-300"><a href="../"><i class="fa-solid fa-right-from-bracket fa-rotate-180 fa-lg text-[#002D74] hover:text-[#0947ac] duration-300" fa-xl"></i></a></button>
    <div class=" bg-white/80 backdrop-blur flex rounded-2xl  max-w-3xl p-5 shadow-xl items-center">
      <div class="px-8 md:px-auto">
        <h2 class="text-center font-medium3 text-2xl text-[#002D74]">Registro</h2>
        <p class="text-xs mt-4 text-[#002D74]"></p>
        <form action="/php/registrar.php" method="post" class="flex flex-col gap-4">
          <div class="flex gap-1 md:flex-row flex-col mt-8">
            <input class="p-2 rounded-md focus:ring-2 focus:outline-none border w-full" type="text" name="nome" placeholder="Nome">
            <input class="p-2 rounded-md focus:ring-2 focus:outline-none border w-full" type="text" name="sobrenome" placeholder="Sobrenome">
          </div>
          <input class="p-2 rounded-md focus:ring-2 border focus:outline-none " type="email" name="email" placeholder="Email">
          <div class="relative">
            <input class="p-2 rounded-md focus:ring-2 focus:outline-none border w-full" type="password" name="senha" placeholder="Senha">
          </div>
          <div class="relative">
            <input class="p-2 rounded-md focus:ring-2 focus:outline-none border w-full" type="password" name="senhaconf" placeholder="Confirmar Senha">
          </div> 
          <input class="bg-[#002D74] rounded-lg hover:bg-[#0947ac] text-white py-2 hover:scale-105 duration-300 cursor-pointer" type="submit" value="Registrar"></input>
          <div class="mt-5 text-center text-xs  text-[#002D74]">
            <a class="text-sm">Já possui uma conta?<a href="./login.php" class=" text-sm font-bold px-2  hover:underline">Clique aqui!</a></a>
          </div>
        </form>
        <div class="mt-6 grid grid-cols-3 items-center text-gray-400">
          <hr class="border-gray-400">
          <p class="text-center text-sm">OU</p>
          <hr class="border-gray-400">
        </div>
        <?php echo "<button
        class='m-auto py-2 px-4 bg-white border hover:ring-2 rounded-xl mt-5 flex gap-2 justify-center items-center text-sm hover:scale-105 duration-300 text-[#002D74]' onclick='mudarPagina()'
      ><img class='w-9' src='../img/icon/logo_google_icon.png' /><a class='w-full' href='" . $google_client->createAuthUrl() . "'>Login com Google</a></button>" . 
       PHP_EOL ;
      ?>
      </div>
    </div>
  </section>
  <script>
    let formulario = document.querySelector("form");
    let regex = new RegExp(/^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z]+$/gi);
    let campoEmail = formulario.elements['email'];

    campoEmail.addEventListener("input", function (e) {
        if (!regex.test(e.target.value)) {
          e.target.classList.add("border-red-500");
        } else {
          e.target.classList.remove("border-red-500");
        }
      });
      </script>
</body>
</html>