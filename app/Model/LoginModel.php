<?php

namespace app\Model;

use app\lib\Database\Connection;
use PDO;

class LoginModel
{
    private $email;
    private $senha;
    private $msg;
    private $sessao;

    public function login($email, $senha)
    {
        $this->email = $email;
        $this->senha = $senha;

        $con = Connection::connect();
        $sql = "SELECT nome, email, senha FROM usuario WHERE email = :email AND senha = :senha";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':senha', $this->senha);
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
        if (!isset($_SESSION['user'])) {
            session_start();
            foreach ($sessao as $i => $value) {
                $_SESSION["'" . $i . "'"] = $value;
            }
        }
    }

    public function logout()
    {
        if (isset($_SESSION['user'])) {
            session_unset();
            session_destroy();
        }
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
