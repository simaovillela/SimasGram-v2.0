<?php
class Database {
    private static $host = 'sql102.infinityfree.com';
    private static $db_name = 'if0_40232797_db_simasgram';
    private static $username = 'if0_40232797';
    private static $password = 'Subaru2412';
    
    public static $conn;

    public static function connect() {
        self::$conn = null;
        try {
            self::$conn = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$db_name, self::$username, self::$password);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$conn->exec("set names utf8");
        } catch(PDOException $e) {
            echo "Erro de conexão: " . $e->getMessage();
        }
        return self::$conn;
    }
}
?>