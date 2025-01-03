<?php
    include_once(__DIR__ . '/Db.php');

    class User {
        private $firstname; 
        private $lastname;
        private $email;
        private $password;
        private $role;
        private $coins;

        

        /**
         * Get the value of firstname
         */ 
        public function getFirstname()
        {
                return $this->firstname;
        }

        /**
         * Set the value of firstname
         *
         * @return  self
         */ 
        public function setFirstname($firstname)
        {
                if(empty($firstname)){
                    throw new Exception("Firstname cannot be empty");
                }
                $this->firstname = $firstname;
        
                return $this;
            }

        /**
         * Get the value of lastname
         */ 
        public function getLastname()
        {
                return $this->lastname;
        }

        /**
         * Set the value of lastname
         *
         * @return  self
         */ 
        public function setLastname($lastname)
        {
                if(empty($lastname)){
                    throw new Exception("Lastname cannot be empty");
                }
                $this->lastname = $lastname;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                if(empty($email)){
                    throw new Exception("Email cannot be empty");
                }
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
            return $this->password;

        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $options = [
                'cost'=> 6,
            ];
            $hash = password_hash($password, PASSWORD_BCRYPT, $options);

                if(empty($password)){
                    throw new Exception("Password cannot be empty");
                }
                $this->password = $hash;

                return $this;
        }

        public function getRole(){
            return $this->role;
        }

        public function getCoins(){
            return $this->coins;
        }

        public function register(){
                $conn = Db::getConnection();
                $statement = $conn->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)");
                $statement->bindValue(':firstname', $this->firstname);
                $statement->bindValue(':lastname', $this->lastname);
                $statement->bindValue(':email', $this->email);
                $statement->bindValue(':password', $this->password);
                return $statement->execute();
        }

        public static function getUserByEmail($email){
            $conn = Db::getConnection();
            $statement = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $statement->bindValue(':email', $email);
            $statement->execute();
            return $statement->fetch();
        }

        public static function isEmailAvailable($email){
            $conn = Db::getConnection();
            $statement = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $statement->bindValue(':email', $email);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($statement->rowCount()==0){
                return true;
            } else {
                return false;
            }
        }  
        
        public static function changePassword($email, $password) {
            if (empty($password)) {
                throw new Exception("Password cannot be empty");
            }
    
            $options = [
                'cost' => 6,
            ];
            $hash = password_hash($password, PASSWORD_BCRYPT, $options);
    
            // Update the password in the connected database
            $conn = Db::getConnection();
            $statement = $conn->prepare("UPDATE users SET password = :password WHERE email = :email");
            $statement->bindValue(':password', $hash);
            $statement->bindValue(':email', $email);
            return $statement->execute();
        }

        public static function isAdmin($email){
            $conn = Db::getConnection();
            $statement = $conn->prepare("SELECT role FROM users WHERE email = :email");
            $statement->bindValue(':email', $email);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result['role'] === 'admin'){
                return true;
            } else {
                return false;
            }
        }


        public static function updateCurrency($user_id, $coins){
            $conn = Db::getConnection();
            $statement = $conn->prepare("UPDATE users SET coins = :coins WHERE ID = :user_id");
            $statement->bindValue(':coins', $coins);
            $statement->bindValue(':user_id', $user_id);
            return $statement->execute();
        }
    }
    


?>