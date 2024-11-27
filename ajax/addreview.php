<?php
    require_once(__DIR__ . '/../Classes/Review.php');
    require_once(__DIR__ . '/../Classes/Db.php');
    
    
    if (!isset($_POST['comment']) || empty(trim($_POST['comment']))) {
        exit(json_encode(['status' => 'error', 'message' => 'Please enter a comment']));
    }
    
    $comment = trim($_POST['comment']);
    
    $reviewInstance = new Review();
    $reviewInstance->setComment($comment);
    $reviewInstance->setProductID($_POST['product_id']); 
    $reviewInstance->setUserID($_POST['user_id']); 
    $reviewInstance->setDate(date('Y-m-d H:i:s'));

    $firstname = $reviewInstance->getUserById($_POST['user_id']);


    

    $reviewInstance->addReview();
    
    
    $response = [
        'status' => 'success',
        'message' => 'Review added successfully',
        'comment' => htmlspecialchars($reviewInstance -> getComment()),
        'firstname' => $firstname,
        'created_at' => $reviewInstance -> getDate()
    ];
    
    echo json_encode($response);

?>