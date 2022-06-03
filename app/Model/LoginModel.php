<?php

class Login
{
    private $email;
    private $senha;
    private $msg;
    private $sessao;

    public function __construct($email, $senha)
    {
        if (($_SERVER["REQUEST_METHOD"] != "POST") || (empty($_POST["email"])) || (empty($_POST["senha"]))) {
            $this->msg = array("msg" => "Prencha os campos corretamente!", "estado" => false);
            echo json_encode($this->msg);
            return;
        }

        $this->email = $email;
        $this->senha = $senha;
    }

    public function login($email, $senha, $con)
    {
        $sql = "SELECT nome, email, senha FROM usuario WHERE email = :email AND senha = :senha";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($result)) {
            $this->msg = array("msg" => "E-mail ou senha incorretos!", "estado" => false);
            echo json_encode($this->msg);
            return;
        }

        $usuario = [
            'id' => $result['id'],
            'usuario' => $result['userName'],
            'email' => $result['email']
        ];

        $this->setLoginSession($usuario);

        $this->msg = array("msg" => "Logado com sucesso!", "estado" => true, $usuario);
        echo json_encode($this->msg);
    }

    public function setLoginSession($sessao)
    {
        if (!isset($_SESSION)) {
            session_start();
            foreach ($sessao as $i => $value) {
                $_SESSION["'" . $i . "'"] = $value;
            }
        }
    }

    public function logout()
    {
        if (isset($_SESSION)) {
            session_unset();
            session_destroy();
        }

        return;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getAcesso()
    {
        return $this->sessao;
    }

    public function getSessao()
    {
        return $this->sessao;
    }
}
