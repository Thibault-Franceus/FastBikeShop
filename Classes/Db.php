<?php 
class Db {
    private static $conn = null;

    public static function getConnection() {
        if (self::$conn == null) {
            self::$conn = new PDO('mysql:dbname=bikeshop;host=127.0.0.1', 'root', '');
            return self::$conn;
            echo "it works";
        } 
        else {
            return self::$conn;
        }
    }
}
        
    
?>