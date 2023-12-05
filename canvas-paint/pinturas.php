<?php

require_once("../vendor/autoload.php");

use App\Conexao;

$db = new Conexao();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $imagens = $db->buscarImagens();
        foreach($imagens as $index => $valor ){
            if($valor['exibir_paint'] == true )  {
                echo "<img src='" . $valor['imagem'] . "' width='300px' height='300px'/>";
            }
            else {
                continue;
            }
        }
    ?>
</body>
</html>