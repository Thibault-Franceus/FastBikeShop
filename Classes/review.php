<?php

    include_once(__DIR__ . '/Db.php');

    class Review {

        private $id;
        private $comment;
        private $date;
        private $product_id;
        private $user_id;

        public function getID(){
            return $this->id;
        }

        public function setID($id){
            $this->id = $id;
            return $this;
        }

        public function getComment(){
            return $this->comment;
        }

        public function setComment($comment){
            $this->comment = $comment;
            return $this;
        }

        public function getDate(){
            return $this->date;
        }

        public function setDate($date){
            $this->date = $date;
            return $this;
        }

        public function getProductID(){
            return $this->product_id;
        }

        public function setProductID($product_id){
            $this->product_id = $product_id;
            return $this;
        }

        public function getUserID(){
            return $this->user_id;
        }

        public function setUserID($user_id){
            $this->user_id = $user_id;
            return $this;
        }

        public function getAllReviews($product_id){
            $conn = Db::getConnection();
            $statement = $conn->prepare("select reviews.*, users.firstname
            from reviews
             inner join users on reviews.user_id = users.id
             where reviews.product_id = :product_id
             order by reviews.created_at desc");
             $statement->bindParam(':product_id', $product_id, PDO::PARAM_INT);
                $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public function addReview(){
            $conn = Db::getConnection();
            $statement = $conn->prepare("insert into reviews (comment, date, product_id, user_id) values (:comment, :date, :product_id, :user_id)");
            $comment = $this->getComment();
            $date = date('Y-m-d H:i:s');
            $product_id = $this->getProductID();
            $user_id = $this->getUserID();
            $statement->bindValue(':comment', $comment);
            $statement->bindValue(':date', $date);
            $statement->bindValue(':product_id', $product_id);
            $statement->bindValue(':firstname', $user_id);
            $statement->execute();
        }


    }

?>