<?php if (!session_id()) session_start();

require_once("../vendor/autoload.php");

use App\Conexao;

$db = new Conexao();
$email = null;
$provider = null;
$resultados = null;
$pinturasFeitas =  0;
if (isset($_SESSION['google_id']) || isset($_SESSION['ARTESDB_SESSION'])) {
    if(isset($_SESSION['google_email'])) {
        $resultados = $db->buscarPinturasFeitas($_SESSION['google_email'], "google" )[0];
        $email = $_SESSION['google_email'];
        $provider = "google";
    } else {
        $dados = unserialize($_SESSION['ARTESDB_SESSION']);
        $email = $dados['email'];
        $provider = $dados['oauth_provider'];
        $resultados = $db->buscarPinturasFeitas($email, $provider )[0];
    }
} else {
    header('Location: /pages/login.php');
    exit();
}
?>


<!DOCTYPE html>
<html>

<head>
    <title></title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

    <link rel="stylesheet" href="./dist/drawerJs.css" />
    <script src="./dist/drawerJs.standalone.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body style="
      z-index: -1;
      background: linear-gradient(90deg, #e3ffe7 0%, #d9e7ff 100%);
    ">
    <div class="flex justify-center items-center gap-6 md:flex-row flex-col md:mt-0 mt-6">
        <button id="button-canvas" class="p-4 bg-green-400 hover:bg-green-300 border border-green-400">
            <a class="text-green-950">Salvar Imagem</a>
        </button>
        <div id="canvas-editor" style="position: relative; top: 3rem ">
        </div>
    </div>
    <?php if($resultados['pinturas_feitas'] >= 3) { ?>
        <h1>Você já fez 3 quizzes na sua conta, pague 10 reais para desbloquear o premium</h1>
        <?php } else { ?>
    <script>
        $(document).ready(function () {
            var drawerPlugins = [
                "Pencil",
                "Eraser",
                "Line",
                "Color",
                "Triangle",
                "Rectangle",
                "Circle",
                "ShapeBorder",
                "BrushSize",
                "OpacityOption",
                "LineWidth",
                "StrokeWidth",
                "ShapeContextMenu",
                "Zoom",
                "TextLineHeight",
                "TextAlign",
                "TextFontFamily",
                "TextFontSize",
                "TextFontWeight",
                "TextFontStyle",
                "TextDecoration",
                "TextColor",
                "TextBackgroundColor",
            ];

            window.drawer = new DrawerJs.Drawer(
                null, {
                plugins: drawerPlugins,
                pluginsConfig: {
                    Image: {
                        scaleDownLargeImage: true,
                        maxImageSizeKb: 10240, //1MB
                        cropIsActive: true,
                    },
                    Zoom: {
                        enabled: false,
                        showZoomTooltip: true,
                        useWheelEvents: true,
                        zoomStep: 1.05,
                        defaultZoom: 1,
                        maxZoom: 32,
                        minZoom: 1,
                        smoothnessOfWheel: 0,
                        //Moving:
                        enableMove: true,
                        enableWhenNoActiveTool: true,
                        enableButton: true,
                    },
                },
                exitOnOutsideClick: false,
                defaultActivePlugin: {
                    name: "Pencil",
                    mode: "lastUsed"
                },
                activeColor: "#000000",
                align: "center",
                lineAngleTooltip: {
                    enabled: true,
                    color: "blue",
                    fontSize: 15
                },
            },
                400,
                400
            );

            $("#canvas-editor").append(window.drawer.getHtml());
            window.drawer.onInsert();
            window.drawer._startEditing();
            document
                .getElementById("button-canvas")
                .addEventListener("click", () => {
                    document.getElementById("button-canvas").outerHTML = "<span class='text-emerald-800 text-center'>Salvo com sucesso!<br>Vamos analisar sua arte</span>"
                    let imageData = window.drawer.getImageData();
                    let canvas = document.createElement("canvas");
                    let ctx = canvas.getContext("2d");
                    let img = new Image();
                    img.onload = function () {
                        // Aqui o sistema cria um novo "canvas" para deixar o seu fundo branco, junto com a pintura do canvas anterior
                        // É só um macete para deixar o fundo branco
                        canvas.width = img.width;
                        canvas.height = img.height;
                        ctx.fillStyle = "white";
                        ctx.fillRect(0, 0, canvas.width, canvas.height);
                        ctx.drawImage(img, 0, 0);
                        // Aqui, ele converte o canva em imagem do tipo "data/jpeg" e copia o URL desta imagem
                        let newImageData = canvas.toDataURL();
                        // Cria um "FormData" que simula como se fosse sendo enviado por um formulário
                        var fd = new FormData();
                        // Coloca o link da imagem no parâmetro "data", como se fosse um input vindo de um arquivo para o PHP
                        fd.append('data', newImageData);
                        fd.append("email", "<?php echo $email; ?>");
                        fd.append("provider", "<?php echo $provider; ?>");
                        // Faz uma requisição para o .php, indexando a imagem no POST do PHP
                        $.ajax({
                            type: 'POST',
                            url: 'enviar-imagem.php',
                            data: fd,
                            processData: false,
                            contentType: false
                        });

                    };
                    img.src = imageData;
                });
        });
    </script>
    <?php } ?>
</body>

</html>