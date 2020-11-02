<?php

class SecurityService
{
    private $email = "";
    private $password = "";

    public function authenticate(){

        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT EMAIL, PASSWORD FROM USERS WHERE EMAIL LIKE ?");

        if (!$stmt){
            echo "Binding process failed - sql error?";
            exit;
        }

        /* bind parameters to markers */
        $like_n = "%" . $this->getEmail() . "%";
        $stmt->bind_param("s", $like_n);

        /* execute query */
        $stmt->execute();

        /* get results */
        $result = $stmt->get_result();
        $row = mysqli_fetch_array($result);


        if ($result->num_rows == 0){
            return null;
        }
        if ($this->email == $row['EMAIL'] || $this->password == $row['PASSWORD']){
            return true;
        }
        else {
            return false;
        }

    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }


}

