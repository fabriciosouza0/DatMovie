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

}
