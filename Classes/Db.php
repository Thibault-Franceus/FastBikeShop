<?php 

            $pathToSSL = __DIR__ . '/cacert.pem';
            $options = array(
            PDO::MYSQL_ATTR_SSL_CA => $pathToSSL
            );

    $host = 'bikeshopweb.mysql.database.azure.com';
    $db = 'bikeshop';
    $user = 'trekbikes';
    $pass = '4rL#2m$9Bn@7tQv!';
    $db = new PDO("mysql:host=$host;port=8080;dbname=$db", $user, $pass, $options);
        
    
?>