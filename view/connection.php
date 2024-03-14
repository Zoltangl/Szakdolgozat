<?php

class DataBase
{
    private $servername = "localhost";
    private $username = "c31gulcsikZ";
    private $password = "zqd73iNH#Q";
    private $dbname = "c31gulcsikZ_db";
    public static $conn;

    // Konstruktor létrehozása
    public function __construct() {
        // Adatbáziskapcsolat létrehozása
        self::$conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Kapcsolat ellenőrzése
        if (self::$conn->connect_error) {
            die("Hiba az adatbázishoz való kapcsolódás közben: " . self::$conn->connect_error);
        } else {
            echo "Sikeresen csatlakozva az adatbázishoz.<br>";
        }
    }

    // Kapcsolat bezárása
    public function closeConnection() {
        if (self::$conn) {
            self::$conn->close();
            echo "Adatbáziskapcsolat lezárva.<br>";
        }
    }
}

// Kapcsolódás az adatbázishoz
$db = new DataBase();

// Adatbáziskapcsolat bezárása (opcionális)
// $db->closeConnection();

?>
