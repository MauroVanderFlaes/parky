<?php

class User
{
    private string $username;
    private string $email;
    private string $password;
    private string $location;
    private string $postalCode;

    /**
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */
    public function setUsername($username)
    {
        if(empty($username)) {
            throw new Exception("Username cannot be empty");
        } else {
            $this->username = $username;
        }

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
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Email is not valid");
            return false;
        } else {
            $this->email = $email;
            return $this;
        }


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
        if(empty($password)) {
            throw new Exception("Password is required");

        } else {
            //hash password with bcrypt and cost 12
            $options = [
                'cost'=>12,
            ];
            $password = password_hash($password, PASSWORD_DEFAULT, $options);
            $this->password = $password;
        }
    }


    public function save()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO user (username, email, password) values (:username, :email, :password)");
        $statement->bindValue(":username", $this->username);
        $statement->bindValue(":email", $this->email);
        $statement->bindValue(":password", $this->password);
        $result = $statement->execute();
        
    }

    public function canLogin($username, $password)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM user WHERE username = :username");
        $statement->bindValue(":username", $username);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        if($user){
            $hash = $user['password'];
            if(password_verify($password, $hash)){
                $_SESSION['username'] = $user['username'];
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                return true;
            } else {
                return false;
            }
        } else {
            return false;

        }
        
    }

    public function getIdByUsername($username){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT id FROM user WHERE username = :username");
        $statement->bindValue(":username", $username);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['id'];
    }

    public function setLocation($user_Id, $location, $postcode, $city, $latitude, $longitude){
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO locations (user_id, location, postcode, city, latitude, longitude) values (:user_id, :location, :postcode, :city, :latitude, :longitude)");
        $statement->bindValue(":user_id", $user_Id);
        $statement->bindValue(":location", $location);
        $statement->bindValue(":postcode", $postcode);
        $statement->bindValue(":city", $city);
        $statement->bindValue(":latitude", $latitude);
        $statement->bindValue(":longitude", $longitude);
        $result = $statement->execute();

    }


    /**
     * Get the value of location
     */ 
    public function getLocation()
    {
        return $this->location;
    }

    public static function getCoordinates($userId){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT latitude, longitude FROM locations WHERE user_id = :user_id");
        $statement->bindValue(":user_id", $userId);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }


}
