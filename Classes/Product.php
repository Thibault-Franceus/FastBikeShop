<?php 
    include_once(__DIR__ . '/Db.php');

    class Product {
        private $id;
        private $title;
        private $description;
        private $image;

        public function getID(){
            return $this->id;
        }

        public function setID($id){
            $this->id = $id;
            return $this;
        }


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


        public function getImage(){
            return $this->image;
        }

         

        public function setImage($image){
            $this->image = $image;
            return $this;
        }


        public static function getAllProducts(){
                $conn = Db::getConnection();
                $stmt = $conn->query('
                    SELECT 
                        products.ID AS product_id, 
                        products.Title, 
                        products.Description, 
                        products.Price, 
                        images.url AS image_url 
                    FROM 
                        products 
                    INNER JOIN 
                        images 
                    ON 
                        products.image_id = images.ID
                ');
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getProductById($id) {
                // Get database connection
                $conn = Db::getConnection();
                
                
                // Prepare the query to fetch the product by ID
                $stmt = $conn->prepare('
                    SELECT 
                        products.*, 
                        images.url AS image_url 
                    FROM 
                        products 
                    INNER JOIN 
                        images 
                    ON 
                        products.image_id = images.ID 
                    WHERE 
                        products.ID = :id
                ');

                
                // Bind the parameter
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
                // Execute the query
                $stmt->execute();
    
                // Fetch the product data as an associative array
                $product = $stmt->fetch(PDO::FETCH_ASSOC);
        
                // Return the product if found, otherwise return false
                if ($product) {
                        return $product;
                    } else {
                        return false; // No product found for this ID
                    }
            }

            
            public static function getFilteredProducts($search = '', $category = 'all') {
                $conn = Db::getConnection();
                
                // Base query to get products with categories joined
                $query = '
                    SELECT 
                        products.ID AS product_id, 
                        products.Title, 
                        products.Description, 
                        products.Price, 
                        images.url AS image_url,
                        products.category_id,
                        categories.name AS category_name  -- Join category name
                    FROM 
                        products 
                    INNER JOIN 
                        images 
                    ON 
                        products.image_id = images.ID
                    INNER JOIN 
                        categories 
                    ON 
                        products.category_id = categories.ID  -- Join the categories table
                ';
                
                // Adding search functionality to query
                if (!empty($search)) {
                    $query .= ' WHERE products.Title LIKE :search';
                }
                
                // Adding category filter if specified
                if ($category !== 'all') {
                    $query .= (strpos($query, 'WHERE') === false ? ' WHERE ' : ' AND ') . ' products.category_id = :category';
                }
            
                // Prepare and execute query
                $stmt = $conn->prepare($query);
                
                // Bind search parameter
                if (!empty($search)) {
                    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
                }
            
                // Bind category filter parameter
                if ($category !== 'all') {
                    $stmt->bindValue(':category', $category, PDO::PARAM_INT);
                }
            
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            
            public static function getAllCategories() {
                $conn = Db::getConnection();
                $stmt = $conn->query('SELECT ID, name FROM categories');
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
    }
    







?>