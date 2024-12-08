<?php 
    include_once(__DIR__ . '/Db.php');

    class Product {
        private $id;
        private $title;
        private $description;
        private $image;
        private $price;
        private $category_id;
        private $size_id;
        private $image_id;

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

        public function getPrice(){
            return $this->price;
        }

        public function setPrice($price){
            $this->price = $price;
            return $this;
        }

        public function getCategoryID(){
            return $this->category_id;
        }

        public function setCategoryID($category_id){
            $this->category_id = $category_id;
            return $this;
        }

        public function getSizeID(){
            return $this->size_id;
        }

        public function setSizeID($size_id){
            $this->size_id = $size_id;
            return $this;
        }

        public function getImageID(){
            return $this->image_id;
        }

        public function setImageID($image_id){
            $this->image_id = $image_id;
            return $this;
        }



        public static function getAllProducts() {
            $conn = Db::getConnection();
            $stmt = $conn->query('SELECT * FROM products');
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
                        products.image_id = images.ID  -- Join the images table
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

            public static function deleteProduct ($id) {
                $conn = Db::getConnection();
                $stmt = $conn->prepare('DELETE FROM products WHERE ID = :id');
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                return $stmt->execute();
            }

            public static function updateProduct($id, $title, $description, $price, $category_id, $image_id, $size_id) {
                $conn = Db::getConnection();
                $stmt = $conn->prepare('UPDATE products SET Title = :title, description = :description, Price = :price, category_id = :category_id, image_id = :image_id, size_id = :size_id WHERE ID = :id');
                $stmt->bindValue(':title', $title);
                $stmt->bindValue(':description', $description);
                $stmt->bindValue(':price', $price);
                $stmt->bindValue(':category_id', $category_id, PDO::PARAM_INT);
                $stmt->bindValue(':image_id', $image_id, PDO::PARAM_INT);
                $stmt->bindValue(':size_id', $size_id, PDO::PARAM_INT);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                return $stmt->execute();
            }
        
            public static function addProduct($title, $description, $price, $category_id, $image_id, $size_id) {
                $conn = Db::getConnection();
                $stmt = $conn->prepare('INSERT INTO products (Title, description, Price, category_id, image_id, size_id) VALUES (:title, :description, :price, :category_id, :image_id, :size_id)');
                $stmt->bindValue(':title', $title);
                $stmt->bindValue(':description', $description);
                $stmt->bindValue(':price', $price);
                $stmt->bindValue(':category_id', $category_id, PDO::PARAM_INT);
                $stmt->bindValue(':image_id', $image_id, PDO::PARAM_INT);
                $stmt->bindValue(':size_id', $size_id, PDO::PARAM_INT);
                return $stmt->execute();
            }

            public static function searchProducts($searchTerm) {
                $conn = Db::getConnection();
                $stmt = $conn->prepare('SELECT * FROM products WHERE Title LIKE :searchTerm');
                $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
    }
    







?>