<!DOCTYPE html>
<html lang="pt">

<?php
if (!session_id()) {
    session_start();
}
require "vendor/autoload.php";
use App\Conexao;

$usuario = null;

$db = new Conexao();

if (!empty($_SESSION["ARTESDB_SESSION"])) {
    $sessionDetails = unserialize($_SESSION["ARTESDB_SESSION"]);
    $usuario = $db->buscarUsuario($sessionDetails["email"]);
    $inicial = substr($usuario["nome"], 0, 1);

    $sobrenome_ = strrpos($usuario["sobrenome"], " ");
    $sobrenome = substr($usuario["sobrenome"], $sobrenome_);

    if ($sobrenome[0] == " ") {
        $inicial .= substr($sobrenome, 1, 1);
    } else {
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
    <header id="header">
        <?php require "./components/navbar.php"; ?>
    </header>
    <main class="h-full">
        <button onclick="javascript:window.scrollTo(0, 0)" id="button-scroll"
            class="bg-sky-400 border border-sky-400 sm:left-[80%] rounded-full w-14 h-14 fixed z-40 left-[78%] top-[82%] p-4 md:left-[92%] md:top-[82%]">
            <div class="flex items-center justify-center">
                <span style="color: white;" class="material-symbols-outlined">
                    arrow_upward
                </span>
            </div>


        </button>
        <div
            class=" offcanvas-body fixed offCanvas_fechado transition duration-200 z-50 ease-in-out overflow-x-auto right-0 h-screen top-0 bg-gray-900  text-white">
            <div class="p-4 border-b ">
                <a href="#!" onclick="javascript:fecharOffCanvas();"><i
                        class="fa-regular fa-circle-xmark fa-xl font-bold left-3 hover:!text-red-500"></i></a>
            </div>
            <div class=" off-canvas-container flex flex-col  justify-start text-white">
                <li class=" list-offcanvas flex flex-col bg-gray-900"></li>
                <a href="#title_container" class="hover:bg-gray-800"><i class="fa-solid fa-comments pr-2"
                        style="color: #ffffff;"></i>Conteúdos</a>
                <a href="#quiz" class="flex gap-1.5 hover:bg-gray-800""><span class=" material-symbols-outlined">
                    quiz
                    </span>Quizzes</a>
                <a href="#home-paint" class="flex gap-1.5 hover:bg-gray-800""><span class=" material-symbols-outlined">
                    brush
                    </span>Desenhe</a>
                <button id="dropdownHoverButton" data-dropdown-toggle="dropdownHover" data-dropdown-trigger="click"
                    class="text-white p-4 text-start flex gap-1.5  hover:bg-gray-800"" type=" button"><span
                        class="material-symbols-outlined">
                        expand_more
                    </span>Tópicos
                </button>
                </li>
                <div id="dropdownHover"
                    class="hidden bg-gray-800 divide-y divide-gray-800 shadow w-44 dark:bg-gray-700">
                    <ul class=" text-gray-100 dark:text-gray-200 duration-200" aria-labelledby="dropdownHoverButton">
                        <li>
                            <a href="#off-canva-arte"
                                class="block px-4 py-2 hover:bg-gray-600 dark:hover:text-white">Arte</a>
                            <a href="#off-canva-linha"
                                class="block px-4 py-2 hover:bg-gray-600 dark:hover:text-white">Linhas</a>
                            <a href="#off-canva-textura"
                                class="block px-4 py-2 hover:bg-gray-600 dark:hover:text-white">Texturas</a>
                            <a href="#off-canva-cores"
                                class="block px-4 py-2 hover:bg-gray-600 dark:hover:text-white">Cores</a>
                        </li>
                    </ul>
                </div>
            </div>
            <?php if (!empty($_SESSION["ARTESDB_SESSION"]) || !empty($_SESSION["google_id"])) {
                echo '<button class=" m-auto table mt-10 text-white hover:opacity-80"><a href="./php/deslogar.php" class="bg-red-500 p-3 rounded"><i class="fa-regular fa-user" style="color: #ffffff;"></i>&nbsp;&nbsp;Desconectar</a></button>' . PHP_EOL;
            } else {
                echo '<button class=" m-auto table mt-10 text-white hover:opacity-80"><a href="pages/login.php" class="bg-sky-500 p-3 rounded"><i class="fa-regular fa-user" style="color: #ffffff;"></i>&nbsp;&nbsp;Acesse sua conta</a></button>' . PHP_EOL;
            } ?>
        </div>
        <div class="home w-full">
            <div id="home-image" />
            <div class="home-container sm:p-0 sm:w-1/2 flex-wrap w-full sm:ml-10  flex flex-col sm:gap-2">
                <h1 class=" select-none titulo text-6xl font-extrabold leading-[0.9] tracking-tight text-center sm:text-start mt-11 sm:mt-0
dark:text-slate-300 md:text-8xl p-1 py-9 transition-all ease-in duration-150
">
                    Arte que transborda<h1>
                        <h2
                            class=" select-none frase text-3xl first-letter:font-bold drop-shadow-lg bg-gradient-to-r from-sky-300 to-sky-500  dark:from-gray-300 dark:to-gray-400 bg-clip-text text-transparent text-center sm:text-start p-9 sm:p-0 transition-all ease-in duration-150">
                            Explore um mundo de imagens surpreendentes, onde cores e formas se misturam para contar
                            histórias cheias
                            de emoção.</h2><span id="cursor"></span>
                        <a href="./canvas-paint/index.php"><button
                                class=" button-headerc dark:bg-gray-300 dark:text-gray-800 hover:dark:bg-slate-200 bg-sky-500 flex text-center items-center justify-center sm:w-36 m-auto sm:m-0 px-4 py-3 rounded-md mt-4  hover:bg-sky-300 hover:text-sky-900 text-lg transition-all ease-in duration-150 sm:mt-7">Saiba
                                mais</button></a>

            </div>
        </div>
        <div class="image-line xl:block hidden">
            <img src="./img/Image_line.jpg" alt="">
        </div>
        <ol class=" content relative border-l m-10 sm:ml-16 sm:mt-16 border-sky-200 dark:border-gray-700">
            <h1 id="title_container"
                class="sm:text-5xl text-4
xl mb-10 table text-4xl m-auto sm:m-2 sm:mb-10 font-semibold text-transparent bg-clip-text bg-gradient-to-r from-sky-400 to-sky-300 dark:text-gray-200">
                Conteúdos
            </h1>
            <li class="mb-10 ml-4">
                <div
                    class="absolute w-3 h-3 bg-sky-200 rounded-full mt-5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700">
                </div>
                <h3 class="text-3xl font-semibold text-gray-900 dark:text-white py-3 w-1/5">
                    Arte</h3>
                <p class="font-medium text-lg text-gray-500 dark:text-gray-400">O que é Arte;
                    <br>
                    Como são identificados;
                    <br>
                    Arte Cronológica.
                    <br>
                <div class="pl-4 font-medium text-lg text-gray-500 dark:text-gray-400">
                    <span class="material-symbols-outlined">
                        subdirectory_arrow_right
                    </span>Clássica;
                    <br>
                    <span class="material-symbols-outlined">
                        subdirectory_arrow_right
                    </span>Moderna;
                    <br>
                    <span class="material-symbols-outlined">
                        subdirectory_arrow_right
                    </span>Contemporânea;
                    <br>
                    <span class="material-symbols-outlined">
                        subdirectory_arrow_right
                    </span>Renascentista.
                </div>
                </p>
            </li>
            <li class=" mb-10 ml-4">
                <div
                    class="absolute w-3 h-3 bg-sky-200 rounded-full mt-5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700">
                </div>
                <h3 class="text-3xl font-semibold text-gray-900 dark:text-white py-3 w-1/5">
                    Linhas</h3>
                <p class="mb-4 text-lg font-medium text-gray-500 dark:text-gray-400">O que são linhas e quais são elas.
                </p>
            </li>
            <li class="mb-10 ml-4">
                <div
                    class="absolute w-3 h-3 bg-sky-200 rounded-full mt-5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700">
                </div>
                <h3 class="title_texture text-3xl text-gray-900 dark:text-white py-3 w-1/5">Texturas</h3>
                <p class="font-medium text-lg text-gray-500 dark:text-gray-400">O que são;<br>Como são
                    identificados.<br></p>
            </li>
            <li class="mb-10 ml-4">
                <div
                    class="absolute w-3 h-3 bg-sky-200 rounded-full mt-5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700">
                </div>
                <h3 class="text-3xl font-semibold text-gray-900 dark:text-white py-3 sm:w-1/2">Releitura de Obras de
                    Arte</h3>
                <p class="font-medium text-lg text-gray-500 dark:text-gray-400">Leitura racional;<br>leitura
                    sensorial;<br>Leitura Emocional.</p>
                <p class="font-medium text-lg text-gray-500 dark:text-gray-400 pl-4"><span
                        class="material-symbols-outlined">
                        subdirectory_arrow_right
                    </span>Recriação de obras de arte.</p>
            <li class="mb-10 ml-4">
                <div
                    class="absolute w-3 h-3 bg-sky-200 rounded-full mt-5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700">
                </div>
                <h3
                    class=" font-bold text-3xl text-gray-900 dark:text-white py-3 w-1/4 hover:scale-110 hover:translate-x-[5%] hover:text-transparent hover:bg-clip-text hover:bg-gradient-to-r from-red-400 to-green-500 bg-[length:200%_150%] cursor-pointer transition animation-gradient">
                    Cores</h3>
                <p class="font-medium text-lg text-gray-500 dark:text-gray-400">Cores primárias;<br>Cores
                    Secundárias;<br>Cores Terciárias;<br>Cores frias;<br>Cores quentes.</p>
            </li>
        </ol>
        <section id="off-canva-arte" class="bg-green-500 w-full h-auto">
            <div
                class="section-arte-content text-justify gap-6 flex p-12 pt-8 flex-col sm:text-xl text-lg text-gray-200">
                <h1
                    class=" text-center justify-center sm:justify-start sm:text-start text-emerald-950 sm:text-7xl text-5xl font-bold p-0 sm:p-6">
                    Arte</h1>
                <p>
                    A arte é a comunicação, a produção, a manifestação de expressões, emoções e cultura dos seres
                    humanos. A arte pode ser representada de várias formas, dentre elas estão: Danças; Esculturas;
                    Gestos (atuação de cinema, teatro…); Pinturas; Músicas dentre outros.
                </p>
                <p> Desde seu surgimento, a arte vem evoluindo e ocupando um espaço muito importante em nossa sociedade,
                    visto isso, percebemos que a arte está exposta a muitos de nós hoje em dia. Um exemplo cotidiano de
                    arte é a música, arte essa que é capaz de mexer com emoções como por exemplo nos deixar felizes
                    quando estamos tristes. "Ela funciona como uma distração para certos problemas, um modo de expressar
                    o que sentimos aos diversos grupos da sociedade.</p>
                <p>
                    Muitas pessoas dizem que arte não é importante e não tem interesse em estudá-la, mas o que não sabem
                    é que a arte está além das esculturas e pinturas. A arte é representada de formas muito populares,
                    como cinema, dança, música, e também representações culturais, como o carnaval. Atualmente a arte
                    está dividida em duas principais formas de arte, a arte clássica e moderna.
                </p>
            </div>
        </section>
        <section class="bg-emerald-500 w-full h-auto">
            <div
                class="section-arte-content text-justify sm:items-start items-center gap-6 flex p-12 pt-8 flex-col sm:text-xl text-lg text-gray-200">
                <h1
                    class=" text-center justify-center sm:justify-start sm:text-start text-emerald-950 sm:text-7xl text-5xl font-bold p-0 sm:p-6">
                    Arte Clássica</h1>
                <p>
                    A arte clássica surgiu na Grécia antiga e tem duração do ano de 480 até 323a.C. Período
                    conhecido
                    como amadurecimento da arte grega em praticamente todos os aspectos, tem como principais
                    características das obras de arte desse período são a representação naturalista da figura humana
                    e o
                    recurso a formas idealizadas de homens e mulheres em movimento. Esses princípios podem ser
                    observados com toda a nitidez na escultura: estátuas e relevos de homens e deuses em diferentes
                    poses, atletas em pleno movimento e mulheres com vestes esvoaçantes enfeitam vários locais.
                </p>

            </div>
        </section>
        </div>
        <section class="bg-teal-500 w-full h-auto">
            <div
                class="section-arte-content text-justify sm:items-start items-center gap-6 flex p-12 pt-8 flex-col sm:text-xl text-lg text-gray-200">
                <h1
                    class=" text-center justify-center sm:justify-start sm:text-start text-emerald-950 sm:text-7xl text-5xl font-bold p-0 sm:p-6">
                    Arte Moderna</h1>
                <p>
                    A arte moderna surgiu na Europa surgiu no século XIX e durou até meados do século XX. Seu foco é
                    a
                    arquitetura, a escultura, a literatura e a pintura. No Brasil a semana da arte moderna, foi um
                    acontecimento que consolidou essa corrente artística, ocorreu em 1922 no Teatro Municipal da
                    cidade
                    de São Paulo.
                </p>
                <p> Aconteceu em um período de várias tecnologias, essas são: O invento da fotografia e do cinema.
                    Foi
                    na época também entre a primeira e segunda guerra mundial.</p>
                <p>
                    Tem como principais características: Informalidade; Liberdade de expressão; Pontuação relativa;
                    Aproximação da linguagem popular e coloquial; Figuras deformadas e cenas sem lógica; Abandono da
                    representação das formas de maneira realista; Arbitrariedade no uso das cores; Urbanismo; Humor,
                    irreverência; Estranhamento.
                </p>
                <p>A Arte Moderna deu lugar para outras formas de arte a partir de seu declínio no final da segunda
                    guerra mundial.
                </p>
            </div>
        </section>
        <div class="p-4 flex flex-col md:flex-row gap-5 m-4">
            <div class="flex-col flex p-6 gap-6 ">
                <h1
                    class="text-emerald-900 font-bold text-4xl sm:text-6xl flex text-center sm:justify-start sm:text-start items-center justify-center">
                    ARTE<br>MODERNA</h1>
                <h2 class="text-emerald-700 text-xl 2xl:text-2xl sm:text-start text-center sm:pr-24">A arte moderna, em
                    suas
                    obras, apresenta uma explosão de
                    cores, formas abstratas e expressões subjetivas, desafiando convenções e convidando-nos a
                    mergulhar em novas perspectivas. Uns dos exemplares de arte moderna são as obras "Abaporu" da
                    autora Tarsila do Amaral e a obra "Persistência da Memória" do autor Salvador Dalí.
            </div>
            <img class="w-full md:w-80 md:h-96" src="./img/abaporu.png" alt="">
            <img class="w-full md:w-80 md:h-96" src="./img/relogio.jpeg" alt="">
        </div>
        </div>
        <section class="bg-yellow-500 w-full h-auto">
            <div
                class="section-arte-content text-justify sm:items-start items-center gap-6 flex p-12 pt-8 flex-col sm:text-xl text-lg text-gray-200">
                <h1
                    class=" text-center justify-center sm:justify-start sm:text-start text-yellow-950 sm:text-7xl text-5xl font-bold p-0 sm:p-6">
                    Arte Conteporânea</h1>
                <p>
                    Utilizamos essa palavra (Contemporânea) como adjetivo para indicar o tempo presente, atual. Sua
                    origem costuma ser relacionada à década de 60 e ao movimento pop art. Chamada de Arte
                    Contemporânea
                    ou Arte Pós-Moderna surgiu na segunda metade do século XX.
                    A Arte Contemporânea se prolonga até aos dias atuais, período esse denominado de pós-modernismo,
                    propondo expressões artísticas originais a partir de técnicas inovadoras. Esse é o momento em
                    que se
                    inicia a arte digital, da fotografia, arte urbana, body arte e muitos outros…
                </p>
            </div>
        </section>
        <div class="p-4 flex flex-col md:flex-row gap-5 m-4">
            <img class="w-full md:w-80" src="./img/conte1.webp" alt="">
            <img class="w-full md:w-80" src="./img/romero.webp" alt="">
            <div class="flex-col flex p-6 gap-6">
                <h1
                    class="text-yellow-900 font-bold text-4xl sm:text-6xl items-center justify-center flex text-center sm:text-start">
                    ARTE CONTEMPORÂNEA</h1>
                <h2 class="text-yellow-700 text-xl 2xl:text-2xl text-center sm:text-start">Arte contemporânea é uma
                    expressão artística que reflete a
                    diversidade e as complexidades do mundo atual, desafiando convenções e explorando novas formas
                    de
                    representação.</h2>
            </div>
        </div>
        </div>
        <section class="bg-amber-500 w-full h-auto">
            <div
                class="section-arte-content text-justify sm:items-start items-center gap-6 flex p-12 pt-8 flex-col sm:text-xl text-lg text-gray-200">
                <h1
                    class=" text-center justify-center sm:justify-start sm:text-start text-amber-950 sm:text-7xl text-5xl font-bold p-0 sm:p-6">
                    Arte Renascentista</h1>
                <p>
                    O Renascimento foi um movimento das grandes manifestações artísticas de pintores e escultores
                    italianos, mas também teve outras abrangências no campo político filosófico e por isso mesmo inovou
                    e reinterpretou o pensamento e a cultura na Europa. No período renascentista, o homem estava
                    dividido entre o teocentrismo e o antropocentrismo medieval, esse homem enxergava-se ainda de forma
                    coletiva e não de forma individual, ele não tinha a consciência do EU e que podia pensar, ou seja,
                    racionalizar sem a intermediação da Igreja.
                </p>
                <p>
                    A pintura renascentista nesse contexto é para o professor de História uma espécie de matéria-prima,
                    ou seja, um registro histórico. Ela oferece os elementos básicos e essenciais sobre determinado
                    fato. Sem os registros históricos seria impossível reconstruir a história, já que não haveria nenhum
                    vestígio sobre o passado, mas é preciso compreender que nenhuma pintura, nenhum documento traduz de
                    maneira completa e definitiva a realidade objetiva sobre um determinado acontecimento, pois ela está
                    impregnada da visão de mundo de quem deixou o registro.
                </p>
            </div>
        </section>
        <div class="p-4 flex flex-col md:flex-row gap-5 mb-10 m-4">
            <div class="flex-col flex p-0 sm:p-6 gap-6 ">
                <h1
                    class="text-amber-900 font-bold text-4xl sm:text-6xl flex text-center sm:justify-start sm:text-start items-center justify-center">
                    ARTE<br> RENASCENTISTA</h1>
                <h2 class="text-amber-700 text-xl 2xl:text-2xl md:pr-11 sm:text-start text-center">A obra da Mona Lisa,
                    pintada por Leonardo da Vinci, é um ícone da arte renascentista, conhecida por seu enigmático
                    sorriso e pela maestria em retratar a expressão humana, assim como a obra do Homem Vitruviano, que
                    representa a harmonia entre o corpo humano e a geometria.
            </div>
            <img class="w-full md:w-80 md:h-96" src="./img/monalisa.avif" alt="">
            <img class="w-full md:w-80 md:h-96" src="./img/homem.webp" alt="">
        </div>
        </div>
        <figcaption class="flex items-center flex-col gap-2 text-center sm:gap-4 p-2 sm:p-2">
            <p style="font-size: 1rem;"><mark class="p-1.5 bg-amber-200">Esse conteúdo é pertencente à seguinte
                    fonte:</mark></p>
            <blockquote class="blockquote">
                ESCOLA, Equipe Brasil. <b>"Arte"</b>; <i class="italic">Brasil Escola.</i>
            </blockquote>
            <figcaption class="blockquote-footer">
                Disponível em: <a target="_blank" class=" text-cyan-700 hover:underline hover:decoration-cyan-700 "
                    href="https://brasilescola.uol.com.br/artes/arte.htm">Brasilescola</a>. Acesso em 14 de novembro de
                2023.
            </figcaption>
        </figcaption>
        <hr class="m-10">
        <section id="off-canva-linha" class="bg-slate-500 w-full h-auto">
            <div
                class="section-arte-content text-justify sm:items-start items-center gap-6 flex p-12 pt-8 flex-col sm:text-xl text-lg text-gray-200">
                <h1
                    class="text-center justify-center sm:justify-start sm:text-start text-slate-900 sm:text-7xl text-5xl font-bold p-0 sm:p-6">
                    Linhas</h1>
                <p>
                    São definidas pelo movimentos de pontos no espaço. Pontos que se sucedem uns aos outros em uma
                    sequência infinita. As linhas delimitam e insinuam formas,nos dão a ideia de movimento. As linhas
                    desempenham um papel fundamental nas artes visuais, sendo um dos elementos básicos da linguagem
                    visual. Elas são formadas por uma série contínua de pontos, que se estendem em uma direção
                    específica. As linhas podem se manifestar de várias formas, como retas, curvas, suaves, quebradas,
                    ásperas, espessas ou finas.
                </p>
                <p>
                    Uma linha reta, por exemplo, pode transmitir uma sensação de ordem, rigidez ou formalidade. Ela é
                    frequentemente associada a objetos geométricos e arquitetônicos, criando uma estética precisa e
                    estruturada. Por outro lado, linhas curvas e orgânicas tendem a evocar uma sensação de fluidez,
                    movimento e naturalidade. Elas estão presentes nas formas da natureza, nas ondas do mar, nas curvas
                    dos corpos humanos, proporcionando um senso de harmonia e suavidade.
                </p>
                <p>
                    As linhas físicas são as linhas que conseguimos enxergar, são enxergadas no meio
                    ambiente por exemplo.
                    Exemplos de linhas físicas:fios de lã, barbantes, rachaduras de pisos e fios elétricos.
                    As Geométricas tem seu comprimento ilimitado, não possui altura nem
                    espessura, sendo apresentadas pela imaginação particular de cada pessoa, após observar a natureza.
                    Já as Geométrica Gráfica sendo desenhadas em uma superfície, são
                    concretizadas quando colocamos algum material gráfico como por exemplo uma caneta em um papel e
                    seguimos para uma direção.
                </p>
            </div>
        </section>
        <div class="p-4 flex flex-col md:flex-row gap-5 mb-10 m-4">
            <div class="flex-col flex p-0 sm:p-6 gap-6 ">
                <h1
                    class="text-slate-900 font-bold text-4xl sm:text-6xl flex text-center sm:justify-start sm:text-start items-center justify-center">
                    TIPOS DE LINHAS</h1>
                <h2 class="text-slate-700 text-xl 2xl:text-2xl md:pr-11">
                    <li><b>Retas:</b> São as linhas que seguem sempre a mesma direção;</li>
                    <li><b>Curvas:</b> São as linhas que estão sempre em mudança de direção, de forma constante e suave;
                    </li>
                    <li><b>Linhas Complexas: </b>Mudam de direção de forma mais livre;</li>
                    <li><b>Poligonal ou quebrada:</b> É a linha composta por segmentos de retas que possuem diversas
                        direções;</li>
                    <li><b>Sinuosas ou onduladas: </b> Compostas por uma sequência de linhas curvas;
                    <li><b>Cheias ou contínuas:</b> O traço é feito sem nenhuma interrupção, tornando o movimento visual
                        extremamente rápido;</li>
                    <li><b>Pontilhadas:</b> Representadas por meio de pontos. Os intervalos entre os pontos tornam o
                        movimento visual mais lento.
                    </li>
                    <li><b>Tracejadas:</b> Representadas por meio de traços. Quanto maior o intervalo entre os traços,
                        mais lento e pesado é o movimento.</li>
                    <li><b>Combinadas:</b> Representadas por meio de traços e pontos alternados.</li>
            </div>
        </div>
        </div>

        <figcaption class="flex items-center flex-col gap-2 text-center sm:gap-4 p-2 sm:p-2">
            <p style="font-size: 1rem;"><mark class="p-1.5 bg-amber-200">Esse conteúdo é pertencente à seguinte
                    fonte:</mark></p>
            <blockquote class="blockquote">
                EVOLUCAO, grupo. <b>"Linha"</b>; <i class="italic">Grupo Evolução</i>
            </blockquote>
            <figcaption class="blockquote-footer">
                Disponível em: <a target="_blank" class=" text-cyan-700 hover:underline hover:decoration-cyan-700 "
                    href="https://grupoevolucao.com.br/livro/Old/linha.html">grupoevolucao</a>. Acesso em 15 de
                novembro de
                2023.
            </figcaption>
        </figcaption>
        <hr class="m-10">
        <section id="off-canva-textura" class="bg-sky-500 w-full h-auto">
            <div
                class="section-arte-content text-justify sm:items-start items-center gap-6 flex p-12 pt-8 flex-col sm:text-xl text-lg text-gray-200">
                <h1
                    class=" title_texture text-center justify-center sm:justify-start sm:text-start text-sky-900 sm:text-7xl text-5xl p-0 sm:p-6">
                    Texturas</h1>
                <p>
                    Texturas são qualidades de superfícies, que são identificadas pelo tato, até mesmo a olho nu. São
                    quem criam sensações em desenhos, pinturas, esculturas e não apenas na arte, mas em nosso dia a dia,
                    como: Pisos, pinturas de paredes, o toque de objetos.

                </p>
                <p>
                    Na arte os pintores usam as texturas para salientar o objetivo que deseja passar através de sua
                    obra, como exemplo: o estado de uma árvore, horário do dia em que se passa a pintura, estação do
                    ano, camuflagem ou até mesmo deixar suas pinturas realistas.
                    As texturas são divididas em quatro partes, a textura artificial, natural, tátil e visual.
                </p>
                <P>
                    Natural é aquela que é construída e encontrada na Natureza, por exemplo:Areia, folhas, madeiras,
                    terra, a textura da água.
                    Artificial é produzida artificialmente por humanos e máquinas. Por exemplo: Bordados, tecidos,
                    cortes, rasgos e pinturas com texturas projetadas. A
                    Tátil é aquela que conseguimos tocá-la, sentimos suas ondulações e apalpá-las, como exemplo: Uma
                    cacto, uma capa de celular, um tronco de árvore.
                    Visual é a sensação das texturas pela visão, só ocorre pelo conhecimento da realidade.Por exemplo
                    uma pintura, com a imaginação/visualização, conseguimos perceber suas texturas.

                </P>
            </div>
        </section>
        <div class="flex flex-col md:flex-row gap-5 mb-10 m-4 p-4">
            <div class="flex-col flex gap-6 p-4 ">
                <h1
                    class="text-sky-950 font-bold text-4xl sm:text-6xl flex text-center sm:justify-start sm:text-start items-center justify-center">
                    CLASSIFICAÇÃO<BR> DAS TEXTURAS</h1>
                <h2 class="text-sky-800 text-xl 2xl:text-2xl md:pr-8 w-full  flex gap-4 flex-col">
                    <li><b>Texturas Regulares:</b> São texturas que seguem um padrão de formas, como por exemplo uma
                        telha, uma planície regular ou azulejos;</li>
                    <li><b>Curvas:</b> São as linhas que estão sempre em mudança de direção, de forma constante e suave;
                    </li>
                    <li><b>Texturas Irregulares:</b> Não possui uma forma contínua, é algo mais grosseiro, como por
                        exemplo pedras, um carro com a lataria empenada, uma casca de árvore;</li>
                    <li><b>Texturas Simples:</b> São aquelas que não apresentam nenhum tipo de alteração, são lisas e
                        sem muitas colorações. Como por exemplo uma camiseta básica, um dia de céu limpo, uma capa de
                        celular lisa;</li>
                    <li><b>Texturas Expressivas:</b> Formada por elementos táteis e de diferentes texturas, por exemplo
                        Rachaduras, rugosidades, espinhos.
                </h2>
            </div>
            <img class="w-full md:w-80 md:h-80" src="./img/textura.avif" alt="">
            <img class="w-full md:w-80 md:h-80" src="./img/texturas2.avif" alt="">
        </div>
        <figcaption class="flex items-center flex-col gap-2 text-center sm:gap-4 p-2 sm:p-2">
            <p style="font-size: 1rem;"><mark class="p-1.5 bg-amber-200">Esse conteúdo é pertencente à seguinte
                    fonte:</mark></p>
            <blockquote class="blockquote">
                EVOLUCAO, grupo. <b>"Textura"</b>; <i class="italic">Grupo Evolução</i>
            </blockquote>
            <figcaption class="blockquote-footer">
                Disponível em: <a target="_blank" class=" text-cyan-700 hover:underline hover:decoration-cyan-700 "
                    href="https://grupoevolucao.com.br/livro/Arte4/textura.html">grupoevolucao</a>. Acesso em 15 de
                novembro de
                2023.
            </figcaption>
        </figcaption>
        <hr class="m-10">
        <section style="background-color: #e3c374;" class="bg-sky-500 w-full h-auto">
            <div style="color: #453b22;"
                class="section-arte-content  text-justify gap-6 flex p-12 pt-8 flex-col sm:text-xl text-lg text-gray-200">
                <h1 style="color: #453b22;"
                    class=" text-center justify-center  text-sky-900 sm:text-7xl text-4xl font-bold sm:p-6 p-2">
                    Releituras de Obras de Arte</h1>
                <p>
                    As releituras são uma forma de recriação de uma obra, não significa cópia ou falsificação, mas sim
                    inspiração da obra original. A releitura é em muitas das vezes homenagens às obras do autor
                    original, buscando salientar as características marcantes da obra.
                </p>
                <p>
                    Segundo a legislação brasileira, a releitura não é considerada plágio, pois não é uma cópia, sem
                    mudanças e nem visada somente em lucro. Nas releituras são sempre feitas com novos elementos.
                </p>
                <P>
                    As leituras de obras de arte são formas de observação de uma obra, analisar o que se passa na obra,
                    interpretar o pensamento do artista. Existem três formas de leitura de obras de arte, elas são:

                    Leitura Racional: É a leitura dos elementos óbvios, como exemplo o período em que se passa a obra de
                    arte; Cores que o artista utilizou, objetos que estão representados na obra.

                    Sensorial: É a leitura feita para se descobrir se a obra se passa em um local frio ou quente, triste
                    ou feliz, limpo ou sujo. É geralmente expressado de uma forma explícita na obra.

                    Emocional: É a leitura que é feita pelo emocional do apreciador da obra, o que a obra representa
                    para seu imaginário, não apenas o óbvio. Como exemplo: Levar o leitor a ter uma lembrança boa, ou ou
                    ruim, até mesmo imaginar e imaginar sem parar de pensar.
                </P>
            </div>
        </section>
        <div class="flex flex-col md:flex-row gap-5 mb-10 m-4 p-4">
            <div class="flex-col flex gap-6 p-4 ">
                <h1 style="color: #453b22;"
                    class="text-amber-900 font-bold text-4xl sm:text-6xl flex text-center sm:justify-start sm:text-start items-center justify-center">
                    COMO FAZER UMA RELEITURA?
                    <h2 style="color: #453b22;"
                        class="text-sky-800 text-xl 2xl:text-2xl md:pr-8 w-full  flex gap-4 flex-col">
                        <ul class="list-disc gap-4 flex flex-col">
                            <li>Adicionar novos elementos, caso não adicionados, se configura plágio.
                            </li>
                            <li>Não é obrigatório ter uma adição de significado mas é necessário algo novo, ou seja,
                                pode passar o mesmo pensamento.</li>
                            <li>Adicione elementos pessoais, pense em suas próprias experiências, sentimentos e
                                conhecimentos e como eles podem influenciar sua interpretação da obra original. Use sua
                                voz e estilo único para expressar suas ideias.</li>
                        </ul>
                    </h2>
            </div>
            <img class="w-full md:w-[350px] md:h-[450px]" src="./img/grito.webp" alt="">
        </div>
        <figcaption class="flex sm:text-base text-sm items-center flex-col gap-2 text-center sm:gap-4 p-2 sm:p-2">
            <p style="font-size: 1rem;"><mark class="p-1.5 bg-amber-200">Esse conteúdo é pertencente à seguinte
                    fonte:</mark></p>
            <blockquote class="blockquote">
                PARALELO, brasil. <b>"Releitura de obras de arte"</b>; <i class="italic">Brasil Paralelo</i>
            </blockquote>
            <figcaption class="blockquote-footer">
                Disponível em: <a target="_blank" class=" text-cyan-700 hover:underline hover:decoration-cyan-700 "
                    href="https://www.brasilparalelo.com.br/artigos/releitura-de-obras-de-arte">brasilparalelo</a>.
                Acesso em 15 de
                novembro de
                2023.
            </figcaption>
        </figcaption>
        <hr class="m-10">
        <section id="off-canva-cores" class="bg-red-500 w-full h-auto">
            <div
                class="section-arte-content text-justify sm:items-start items-center gap-6 flex p-12 pt-8 flex-col sm:text-xl text-lg text-gray-200">
                <h1
                    class=" text-center justify-center font-bold sm:justify-start sm:text-start text-red-900 sm:text-7xl text-5xl p-0 sm:p-6">
                    Cores</h1>
                <p>
                    As cores são raios luminosos que provocam sensações sobre os nossos olhos, essas sensações são
                    criadas pelas diferentes faixas de luz que enxergamos. A palavra cor significa “ocultar/cobrir”, a
                    causadora desses fenômenos é a cor branca, ela quem origina a luz, representa as sete cores do
                    espectro (vermelho, laranja, amarelo, verde, azul, anil e violeta). Já a cor preta, representa a
                    ausência de cor ou de luz. As cores são divididas em vários grupos e alguns deles são:
                </p>
            </div>
        </section>
        <div class=" flex items-center">
            <div class="flex flex-col md:flex-row gap-6 m-10 md:gap-4">
                <div class="w-full md:w-1/3">
                    <div class="border border-stone-300 p-4">
                        <h2 class="text-3xl font-bold py-4">CORES PRIMÁRIAS</h2>
                        <h3 class="text-lg">Chamadas de cores puras, as cores primárias pois são a base das cores, delas
                            surgem as tonalidades de cores e não é possível obtê-las pela mistura de outras cores.</h3>
                        <div class="flex gap-4 items-center justify-center p-4">
                            <div class="bg-red-500 w-10 h-10"></div>
                            <div class="bg-yellow-500 w-10 h-10"></div>
                            <div class="bg-sky-500 w-10 h-10"></div>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/3">
                    <div class="border border-stone-300 p-4">
                        <h2 class="text-3xl font-bold py-4">CORES SECUNDÁRIAS</h2>
                        <h3 class="text-lg">A união de duas cores primárias, representam as três cores. Secundárias:
                            verde (azul e amarelo); laranja (amarelo e vermelho); roxo ou violeta (vermelho e azul).
                        </h3>
                        <div class="flex gap-4 items-center justify-center p-4">
                            <div class="bg-green-500 w-10 h-10"></div>
                            <div class="bg-orange-500 w-10 h-10"></div>
                            <div class="bg-purple-500 w-10 h-10"></div>
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <div class="border border-stone-300 p-4 w-full">
                        <h2 class="text-3xl font-bold py-4">CORES TERCIÁRIAS</h2>
                        <h3 class="text-lg">As cores terciárias são originadas pela combinação de uma cor primária com
                            outra cor secundária. Elas recebem esse nome por estarem localizadas entre as cores
                            primárias e secundárias no círculo cromático. Alguns exemplos dessas cores são:
                            vermelho-arroxeado (vermelho e roxo) e vermelho-alaranjado (vermelho e laranja);
                            amarelo-esverdeado (amarelo e verde) e amarelo-alaranjado (amarelo e laranja);
                            amarelo-esverdeado (amarelo e verde) e amarelo-alaranjado (amarelo e laranja).
                        </h3>
                        <div class="flex gap-4 items-center justify-center p-4 flex-wrap">
                            <div class="bg-pink-800 w-10 h-10"></div>
                            <div style="background-color:#ff470a;" class=" w-10 h-10"></div>
                            <div class="bg-amber-400 w-10 h-10"></div>
                            <div class="flex gap-4">
                                <div style="background-color:#d6e835;" class="400 w-10 h-10"></div>
                                <div class="bg-teal-500 w-10 h-10"></div>
                                <div class="bg-blue-600 w-10 h-10"></div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="w-full">
                    <div class="border border-stone-300 p-4 w-full">
                        <h2 class="text-3xl font-bold py-4">CORES QUENTES OU CORES FRIAS</h2>
                        <h3 class="text-lg">São identificadas como temperatura das cores, são aquelas que transmitem
                            calor ou frio.
                            Cores quentes: São associadas a fogo e luz, e elas são vermelho, laranja e amarelo.
                            Cores frias: transmitem a sensação de frio, associadas à água, são elas: azul, verde e
                            violeta.
                            Além de quentes e frias temos também as cores neutras e são compostas pelas cores cinza e
                            marrom.
                        </h3>
                        <div class="flex gap-4 items-center justify-center p-4 flex-wrap">
                            <div class="bg-red-500 w-10 h-10"></div>
                            <div class=" bg-orange-500 w-10 h-10"></div>
                            <div class="bg-amber-500 w-10 h-10"></div>
                            <div class="flex gap-4">
                                <div class="bg-emerald-500 w-10 h-10"></div>
                                <div class="bg-sky-500 w-10 h-10"></div>
                                <div class="bg-purple-600 w-10 h-10"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <figcaption class="flex sm:text-base text-sm items-center flex-col gap-2 text-center sm:gap-4 p-2 sm:p-2">
            <p style="font-size: 1rem;"><mark class="p-1.5 bg-amber-200">Esse conteúdo é pertencente à seguinte
                    fonte:</mark></p>
            <blockquote class="blockquote">
                AIRDAR, Laura. <b>"Cores"</b>; <i class="italic">Toda Matéria</i>
            </blockquote>
            <figcaption class="blockquote-footer" class=" dark:text-gray-50">
                Disponível em: <a target="_blank" class=" text-cyan-700 hover:underline hover:decoration-cyan-700 "
                    href="https://www.todamateria.com.br/caracteristicas-das-cores/">todamateria</a>.
                Acesso em 20 de
                novembro de
                2023.
            </figcaption>
        </figcaption>
        <hr class="m-10">
        <div class="">
            <div class="">

            </div>
        </div>
        <section>
            <h1
                class=" text-center justify-center font-bold sm:justify-start sm:text-start text--900 sm:text-7xl text-5xl p-6">
                Quiz</h1>
            <div class="flex my-6 gap-4 items-center justify-center">

                <?php
                $json = file_get_contents("./quizzes.json");
                $json = json_decode($json, true);
                foreach ($json as $index => $quiz) {
                    ?>
                    <div id="quiz" class="border border-gray-300 rounded p-4 flex flex-col gap-2">
                        <span class="flex items-center flex-col">
                            <img src="./img/monalisa.avif" alt="" class="w-32">
                            <strong>
                                <?php echo $json[$index]['nome']; ?>
                            </strong>
                        </span>
                        <button class="bg-cyan-300 flex items-center justify-center text-center p-3 rounded hover:bg-sky-400">
                            <a href="<?php echo "/quiz/?quiz=" . $quiz['id']; ?>"
                                class="text-sky-950">
                                Acessar
                            </a>
                        </button>
                    </div>
                <?php } ?>
            </div>
        </section>
        <div class="home w-full">
            <div class="home-paint" id="home-paint" />
            <div class="p-0 sm:p-6">
                <h1 class="text-center p-6 text-slate-100 sm:text-6xl text-5xl">Pinceladas de Inspiração</h1>
            </div>
            <div class="flex flex-col justify-center gap-5 p-10">
                <h2
                    class=" select-none frase text-3xl first-letter:font-bold drop-shadow-lg bg-gradient-to-r from-green-300 to-green-500   dark:from-gray-300 dark:to-gray-400 bg-clip-text text-transparent text-center sm:p-0 mb-6">
                    <span class="material-symbols-outlined">
                        brush
                    </span>
                    A arte da pintura é como um universo colorido, onde as ideias ganham vida através de cores criativas
                    e expressivas. Desafie sua imaginação
                </h2>
                <button class="flex items-center justify-center w-full">
                    <a href="./canvas-paint/index.php">
                    <span
                        class="relative p-3 text-xl transition-all ease-in duration-75 text-emerald-950 bg-green-500 dark:bg-green-900 hover:bg-green-400 rounded-md group-hover:bg-opacity-0 flex items-center gap-1">
                        <span class="material-symbols-outlined">
                            palette
                        </span>
                        Cemece a desenhar
                    </span>
                    </a>

                </button>
                <div
                    class="grid grid-cols-[100px_60px_100px] sm:grid-cols-[175px_100px_175px] items-center text-gray-400 m-auto">
                    <hr class="border-gray-400 " />
                    <p class="text-center text-sm">OU</p>
                    <hr class="border-gray-400" />
                </div>
                <button class="flex items-center justify-center w-full">
                <a href="./canvas-paint/pinturas.php">
                    <span
                        class="relative p-3 text-xl transition-all ease-in duration-75 text-emerald-950 bg-emerald-500 dark:bg-gray-900 hover:bg-emerald-400 rounded-md group-hover:bg-opacity-0 flex items-center gap-1">
                        <span class="material-symbols-outlined">
                            photo_library
                        </span>
                        Acesse a galeria de imagens
                    </span>
                </button>
            </div>
        </div>
    </main>
    <footer class="bg-slate-200 dark:bg-gray-950 dark:text-gray-400 text-slate-800 text-center p-3">Desenvolvido por
        <span class="hover:underline hover:cursor-pointer"><a
                href="https://github.com/KaikeSathler?tab=overview&from=2023-09-01&to=2023-09-22">Kaike
                Sathler</a></span><br>Kauã Rossanezi
    </footer>
    <footer class="bg-slate-800 p-3 text-slate-200 flex sm:flex-row flex-col gap-2 justify-center">
        <a target="_blank" class="cursor-pointer flex items-center justify-center"
            href="https://ifpr.edu.br/assis-chateaubriand/">
            <img class="grayscale w-14 opacity-50 hover:opacity-100 transition-all duration-500"
                src="./img/ckan-logo.png">
        </a>
        <div class=" flex items-center justify-center text-center"> IFPR, Instituto Federal do Paraná campus Assis
            Chateaubriand.
            Av. Cívica, 475 - Assis Chateaubriand, PR, 85935-000</div>
    </footer>
    <script src="./js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"
        integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <script type="module">
        import UIAvatarSvg from "./node_modules/ui-avatar-svg/src/main.js";
        <?php if (!empty($inicial)) {
            ?>
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