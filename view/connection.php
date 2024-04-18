<?php
class DataBase
{
    private $servername = "localhost";
    private $username = "c31gulcsikZ";
    private $password = "zqd73iNH#Q";
    private $dbname = "c31gulcsikZ_db";
    public static $conn;

    public function __construct() {
        self::$conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if (self::$conn->connect_error) {
            die("Hiba az adatbázishoz való kapcsolódás közben: " . self::$conn->connect_error);
        } else {
            echo "";
        }
    }

    public function closeConnection() {
        if (self::$conn) {
            self::$conn->close();
        }
    }
}

$db = new DataBase();

// Adatbáziskapcsolat bezárása (opcionális)
// $db->closeConnection();
?>
