<?php
    class Conexao {

        private $ip = "127.0.0.1";
        private $usuario = "root";
        private $senha = "";
        private $conexao;

        public function __construct() {
            $this->conexao = new PDO("mysql:dbname=artes_db;host:$this->ip", $this->usuario, $this->senha);
        }
        public function buscarUsuario($email) {
            $query = $this->conexao->prepare("SELECT * FROM `usuarios` WHERE `email`=?;");
            $query->bindParam(1, $email);
            $query->execute();
            return $query->fetchAll();
        }
        public function buscaUsuarios() {
            $query = $this->conexao->prepare("SELECT email,senha FROM `usuarios`;");
            $query->execute();
            return $query->fetchAll();
        }
        public function inserirUsuario($_email, $_senha, $_nome, $_sobrenome) {
            $query = $this->conexao->prepare("INSERT INTO `usuarios` (email,senha,nome,sobrenome) VALUES (?,?,?,?);");
            $query->bindParam(1, $_email);
            $query->bindParam(2, $_senha);
            $query->bindParam(3, $_nome);
            $query->bindParam(4, $_sobrenome);
            $query->execute();
            return $query->fetchAll();
        }
    }

?>