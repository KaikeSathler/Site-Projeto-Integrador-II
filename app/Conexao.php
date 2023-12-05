<?php
namespace App;

use PDO;

class Conexao
{
    private $ip = "localhost"; // Endereço IP do servidor de banco de dados
    private $usuario = "artes"; // Nome de usuário do banco de dados
    private $senha = ""; // Senha do banco de dados
    private $conexao;

    public function __construct()
    {
        // Estabelece a conexão com o banco de dados
        $this->conexao = new PDO("mysql:host=$this->ip;dbname=artes_db;", $this->usuario, $this->senha);
        $query = $this->conexao->prepare("USE artes_db;");
        $query->execute();
    }

    public function buscarUsuario($email)
    {
        // Busca um usuário pelo email na tabela `usuarios`
        $query = $this->conexao->prepare("SELECT * FROM `usuarios` WHERE `email`=? LIMIT 1;");
        $query->bindParam(1, $email);
        $query->execute();
        return $query->fetch(0);
    }

    public function buscarUsuarioNotGoogle($email)
    {
        // Busca um usuário pelo email e pelo provedor de autenticação "email" na tabela `usuarios`
        $query = $this->conexao->prepare("SELECT * FROM `usuarios` WHERE `email`=? AND `oauth_provider`='email' LIMIT 1;");
        $query->bindParam(1, $email);
        $query->execute();
        return $query->fetch(0);
    }

    public function buscaUsuarios()
    {
        // Retorna todos os usuários da tabela `usuarios`, retornando apenas os campos email e senha
        $query = $this->conexao->prepare("SELECT email,senha FROM `usuarios`;");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function inserirUsuario($_email, $_senha, $_nome, $_sobrenome, $oauth_provider = "email", $oauth_googleid = null)
    {
        // Insere um novo usuário na tabela `usuarios`, com os campos email, senha, nome, sobrenome, provedor de autenticação e ID do Google (opcional)
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

    public function AtualizarEstatisticas($email, int $acertos, int $erros, $provider)
    {
        // Atualiza as estatísticas de acertos e erros de um usuário na tabela `usuarios`, com base no email e provedor de autenticação
        $query = $this->conexao->prepare("UPDATE `usuarios` SET acertos=acertos + ?, erros=erros + ?, quizzes_feitos = quizzes_feitos + 1 WHERE `email`=? AND `oauth_provider`=?;");
        $query->bindParam(1, $acertos, PDO::PARAM_INT);
        $query->bindParam(2, $erros, PDO::PARAM_INT);
        $query->bindParam(3, $email);
        $query->bindParam(4, $provider);
        $query->execute();
        return $this->conexao->lastInsertId();
    }

    public function inserirImagem($imagem)
    {
        // Insere uma nova imagem na tabela `pinturas`. A imagem deve ser passada como um parâmetro de blob.
        $query = $this->conexao->prepare("INSERT INTO `pinturas` (imagem) VALUES (?);");
        $query->bindParam(1, $imagem, PDO::PARAM_LOB);
        $query->execute();
        return $this->conexao->lastInsertId();
    }

    public function buscarImagens()
    {
        $query = $this->conexao->prepare("SELECT `imagem`, `exibir_paint` FROM `pinturas`;");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function bucarQuizzesFeitos($email, $provider)
    {
        $query = $this->conexao->prepare("SELECT quizzes_feitos FROM `usuarios` WHERE `email`=? AND `oauth_provider`=?;");
        $query->bindParam(1, $email);
        $query->bindParam(2, $provider);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPinturasFeitas($email, $provider)
    {
        $query = $this->conexao->prepare("SELECT pinturas_feitas FROM `usuarios` WHERE `email`=? AND `oauth_provider`=?;");
        $query->bindParam(1, $email);
        $query->bindParam(2, $provider);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function atualizarPinturasFeitas($email, $provider)
    {
        $query = $this->conexao->prepare("UPDATE `usuarios` SET pinturas_feitas=pinturas_feitas + 1 WHERE `email`=? AND `oauth_provider`=?;");
        $query->bindParam(1, $email);
        $query->bindParam(2, $provider);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarUsuariosQuizzes($email, $provider)
    {
        $query = $this->conexao->prepare("SELECT quizzes_json FROM `usuarios` WHERE `email`=? AND `oauth_provider`=?;");
        $query->bindParam(1, $email);
        $query->bindParam(2, $provider);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function atualizarUsuariosQuizzes($quizzes ,$email, $provider) {
        $query = $this->conexao->prepare("UPDATE `usuarios` SET `quizzes_json`=? WHERE `email`=? AND `oauth_provider`=?;");
        $quizzes = json_encode($quizzes);
        $query->bindParam(1, $quizzes, PDO::PARAM_STR);
        $query->bindParam(2, $email);
        $query->bindParam(3, $provider);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>