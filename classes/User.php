<?php

class User
{
    private string $username;
    private string $email;
    private string $password;


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


}
