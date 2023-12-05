<?php
    require('../vendor/autoload.php');
    use App\Conexao as Conexao;

    $conexao = new Conexao();
    if( $trocaravriavel >=5) {
        echo 'erro';
    } else {
        $conexao->inserirImagem($_POST['data']);
        $conexao->atualizarPinturasFeitas($_POST['email'], $_POST['provider']);
    }
?>  