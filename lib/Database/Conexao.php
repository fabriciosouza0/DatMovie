<?php

abstract class Connection
{
    private static $banco = 'gerenciamentopedagogico';
    private static $usuario = 'root';
    private static $senha = '';
    private static $host = 'localhost';
    private static $conn;

    public static function connect()
    {
        if (self::$conn == null) {
            try {
                self::$conn = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$banco . ';', self::$usuario, self::$senha);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                throw new Exception('Erro ao conectar a base de dados: ' . $e->getMessage());
            }
        }

        return self::$conn;
    }
}
