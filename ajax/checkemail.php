<?php
require_once(__DIR__ . '/../Classes/User.php');
require_once(__DIR__ . '/../Classes/Db.php');

 if(!empty($_POST)){
    $email = $_POST['email'];

    $result = User::isEmailAvailable($email);

    if($result===true){
        $available = true;
    } else {
        $available = false;
    }

    $result = [
        'status' => 'success',
        'message' => 'Email is available',
        'available' => $available
    ];

    echo json_encode($result);
 }
?>