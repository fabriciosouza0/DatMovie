<?php
class Usuario
{
    private $nome;
    private $sobrenome;
    private $email;
    private $senha;
    private $data_de_cadastro;
    private $nome_de_usuario;
    private $acesso;

    function __construct($nome, $sobrenome, $email, $senha, $nome_de_usuario)
    {
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->email = $email;
        $this->senha = $senha;
        $this->nome_de_usuario = $nome_de_usuario;
    }

    /* Inicio Get's e set's */
    /* function setNome($nome)
    {
        $this->nome = $nome;
    }

    function setSobrenome($sobrenome)
    {
        $this->sobrenome = $sobrenome;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function setSenha($senha)
    {
        $this->senha = $senha;
    } */

    function setData_de_cadastro($data_de_cadastro)
    {
        $this->data_de_cadastro = $data_de_cadastro;
    }

    /* function setNome_de_usuario($nome_de_usuario)
    {
        $this->nome_de_usuario = $nome_de_usuario;
    } */

    function setAcesso($acesso)
    {
        $this->acesso = $acesso;
    }

    function getNome()
    {
        return $this->nome;
    }

    function getSobrenome()
    {
        return $this->sobrenome;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getSenha()
    {
        return $this->senha;
    }

    function getData_de_cadastro()
    {
        return $this->data_de_cadastro;
    }

    function getNome_de_usuario()
    {
        return $this->nome_de_usuario;
    }

    function getAcesso()
    {
        return $this->acesso;
    }
    /* Fim Get's e set's */
}
