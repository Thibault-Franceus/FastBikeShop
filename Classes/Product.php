<?php 
    include_once(__DIR__ . '/Db.php');

    class Product {
        private $title;
        private $description;
        /**
         * Get the value of title
         */ 
        public function getTitle()
        {
                return $this->title;
        }

        /**
         * Set the value of title
         *
         * @return  self
         */ 
        public function setTitle($title)
        {
                $this->title = $title;

                return $this;
        }


        

        /**
         * Get the value of description
         */ 
        public function getDescription()
        {
                return $this->description;
        }

        /**
         * Set the value of description
         *
         * @return  self
         */ 
        public function setDescription($description)
        {
                $this->description = $description;

                return $this;
        }


        public static function getAllProducts(){
            $conn = Db::getConnection();
            $stmt = $conn->query('SELECT * FROM products');
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }







?>