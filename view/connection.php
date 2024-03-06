<?php

class DataBase
{
    private $servername = "localhost";
    private $username = "c31gulcsikZ";
    private $password = "zqd73iNH#Q";
    private $db = "c31gulcsikZ_db";
    public static $conn;

    function __construct()
    {
        // Create connection
        self::$conn = new mysqli($this->servername, $this->username, $this->password, $this->db);

        // Check connection
        if (self::$conn->connect_error) {
            die("Connection failed: " . self::$conn->connect_error); // Hibaüzenet javítása
        }

        self::$conn->set_charset("utf8");
    }
}

// Kapcsolódás az adatbázishoz
$db = new DataBase();

?>