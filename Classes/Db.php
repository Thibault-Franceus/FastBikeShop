<?php 
class Db {
    private static $conn = null; 

    public static function getConnection(){
        if (self::$conn == null){
            try{
                $pathToSSL = './cacert.pem';
                $options = array(PDO::MYSQL_ATTR_SSL_CA => $pathToSSL);

                $host = 'bikeshopweb.mysql.database.azure.com';
                $db = 'bikeshop';
                $user = 'trekbikes';
                $pass = '4rL#2m$9Bn@7tQv!';

                self::$conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass, $options);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e){
                error_log('Connection error: ' . $e->getMessage());
                die('Connection failed. Please check error log.');
            }
        }
        return self::$conn;
            }
    }

        
    
?>






