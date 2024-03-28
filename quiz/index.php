<?php

if (!session_id()) {
   session_start();
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Quiz de Arte</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="main.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body style="background: linear-gradient(90deg, #e3ffe7 0%, #d9e7ff 100%)">
    <main>
        <?php if (isset($_SESSION["ARTESDB_SESSION"]) || isset($_SESSION['google_id'])) { ?>
        <section>
            <h1>Quiz de Arte</h1>
            <h1 id="pergunta" class="text-2xl">Pergunta</h1>
            <div class="quiz">
                <div id="quiz-container" class="flex flex-col gap-4 ">
                    <div class="flex items-center ps-4 px-4 border border-gray-200 rounded dark:border-gray-700">
                        <input id="opcao-1" type="radio" value="" name="opcao"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300">
                        <label for="opcao-1"
                            class="py-4 w-full text-left ms-2 text-sm font-medium text-gray-900">teste</label>
                    </div>
                    <div class="flex items-center ps-4 px-4 border border-gray-200 rounded dark:border-gray-700">
                        <input id="opcao-2" type="radio" value="" name="opcao"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300">
                        <label for="opcao-2"
                            class="py-4 w-full text-left ms-2 text-sm font-medium text-gray-900">teste</label>
                    </div>
                    <div class="flex items-center ps-4 px-4 border border-gray-200 rounded dark:border-gray-700">
                        <input id="opcao-3" type="radio" value="" name="opcao"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300">
                        <label for="opcao-3"
                            class="py-4 w-full text-left ms-2 text-sm font-medium text-gray-900">teste</label>
                    </div>
                    <div class="flex items-center ps-4 px-4 border border-gray-200 rounded dark:border-gray-700">
                        <input id="opcao-4" type="radio" value="" name="opcao"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300">
                        <label for="opcao-4"
                            class="py-4 w-full text-left ms-2 text-sm font-medium text-gray-900">teste</label>
                    </div>
                </div>
            </div>
            <button type="button" id="next-btn"
                class="m-auto text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 mt-6">Próxima
                pergunta</button>
            <div id="score"></div>
            </div>
        </section>
        <script async src="./script.js"></script>
        <?php } else { ?>
        <h1 class="border-2 bg-red-700 p-2 text-red-100 rounded-md w-1/2 m-auto mt-5"> * Erro! Você prescisa estar
            cadastrado para responder o Quiz</h1>
        <button class=" m-auto table mt-5 text-white hover:opacity-80"><a href="../pages/login.php"
                class="bg-sky-500 p-3 rounded flex items-center gap-1"><span class="material-symbols-outlined">
                    login
                </span>Acesse sua conta</a></button>
        <?php } ?>
    </main>
</body>

</html>