<?php 
    class Db {
        private static $conn = null;

        public static function getConnection(){
            $pathToSSL = __DIR__ . '/config/DigiCertGlobalRootG2.crt.pem';
    $options = array(
        PDO::MYSQL_ATTR_SSL_CA => $pathToSSL
    );

    $host = 'bikeshopweb.mysql.database.azure.com';
    $db = 'bikeshop';
    $user = 'trekbikes';
    $pass = '4rL#2m$9Bn@7tQv!';
    $db = new PDO("mysql:host=$host;port=3306;dbname=$db", $user, $pass, $options);
        }
    }


?>