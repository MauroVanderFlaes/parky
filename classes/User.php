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

    public function setLocation($user_Id, $location, $postcode, $city, $latitude, $longitude, $prijs, $selectedDaysOutput, $selectedImage, $soortParking,$startUur, $eindUur){
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO locations (user_id, location, postcode, city, latitude, longitude, prijs, days, grootte_parking, soort_parking, startUur, eindUur) VALUES (:user_id, :location, :postcode, :city, :latitude, :longitude, :prijs, :days, :grootte_parking, :soort_parking, :startUur, :eindUur)");
        $statement->bindValue(":user_id", $user_Id);
        $statement->bindValue(":location", $location);
        $statement->bindValue(":postcode", $postcode);
        $statement->bindValue(":city", $city);
        $statement->bindValue(":latitude", $latitude);
        $statement->bindValue(":longitude", $longitude);
        $statement->bindValue(":prijs", $prijs);
        $statement->bindValue(":days", $selectedDaysOutput);
        $statement->bindValue(":grootte_parking", $selectedImage);
        $statement->bindValue(":soort_parking", $soortParking);
        $statement->bindValue(":startUur", $startUur);
        $statement->bindValue(":eindUur", $eindUur);
        $result = $statement->execute();
    }
    


    /**
     * Get the value of location
     */ 
    public function getLocation()
    {
        return $this->location;
    }

    public static function getCoordinates(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT latitude, longitude FROM locations");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }



    // public function updatePrice($prijs){
        
    //     $conn = Db::getInstance();
    //     $statement = $conn->prepare("UPDATE locations SET prijs = :prijs WHERE user_id = :user_id");
    //     $statement->bindValue(":prijs", $prijs);
    //     $statement->bindValue(":user_id", $this->user_id);
    //     $result = $statement->execute();
    // }


    // public function setAvailability($user_Id, $selectedDaysOutput){
    //     echo "test";
    //     $conn = Db::getInstance();
    //     $statement = $conn->prepare("INSERT INTO locations (user_id, days) values (:user_id, :days)");
    //     $statement->bindValue(":user_id", $user_Id);
    //     $statement->bindValue(":days", $selectedDaysOutput);
    //     $result = $statement->execute();
    // }


}
