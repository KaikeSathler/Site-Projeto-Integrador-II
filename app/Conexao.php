<?php
namespace App;

use PDO;

class Conexao
{
    private $ip = "localhost";
    private $usuario = "root";
    private $senha = "";
    private $conexao;

    public function __construct()
    {
        $this->conexao = new PDO("mysql:host:$this->ip;dbname=artes_db;", $this->usuario, $this->senha);
        $query = $this->conexao->prepare("USE artes_db;");
        $query->execute();
    }
    public function buscarUsuario($email)
    {
        $query = $this->conexao->prepare("SELECT * FROM `usuarios` WHERE `email`=? LIMIT 1;");
        $query->bindParam(1, $email);
        $query->execute();
        return $query->fetch(0);
    }
    public function buscarUsuarioNotGoogle($email)
    {
        $query = $this->conexao->prepare("SELECT * FROM `usuarios` WHERE `email`=? AND `oauth_provider`='email' LIMIT 1;");
        $query->bindParam(1, $email);
        $query->execute();
        return $query->fetch(0);
    }
    public function buscaUsuarios()
    {
        $query = $this->conexao->prepare("SELECT email,senha FROM `usuarios`;");
        $query->execute();
        return $query->fetchAll();
    }
    public function inserirUsuario($_email, $_senha, $_nome, $_sobrenome, $oauth_provider = "email", $oauth_googleid = null)
    {
        if ($oauth_googleid !== null) {
            $query = $this->conexao->prepare("INSERT INTO `usuarios` (email,senha,nome,sobrenome,oauth_provider,oauth_googleid) VALUES (?,?,?,?,?,?);");
            $query->bindParam(6, $oauth_googleid);
        }
        $query = $this->conexao->prepare("INSERT INTO `usuarios` (email,senha,nome,sobrenome,oauth_provider) VALUES (?,?,?,?,?);");
        $query->bindParam(1, $_email);
        $query->bindParam(2, $_senha);
        $query->bindParam(3, $_nome);
        $query->bindParam(4, $_sobrenome);
        $query->bindParam(5, $oauth_provider);
        $query->execute();
        return $this->conexao->lastInsertId();
    }
}

?>