<?php

class DB_Functions {

    private $db;
    private $con;

    //put your code here
    // constructor
    function __construct() {
        include_once './db_connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->con = $this->db->connect();
    }

    // destructor
    function __destruct() {

    }

    /**
     * Storing new user
     * returns user details
     */
    public function storeUser($gcm_regid) {
        // insert user into database

        $result = mysqli_query($this->con,"INSERT INTO gcm_users(gcm_regid, created_at) VALUES('$gcm_regid', NOW())");
        // check for successful store
        if ($result) {
            // get user details
            $id = mysqli_insert_id(); // last inserted id
            $result = mysqli_query($this->con,"SELECT * FROM gcm_users WHERE id = $id") or die(mysqli_error());
            // return user details
            if (mysqli_num_rows($result) > 0) {
                return mysqli_fetch_array($result);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Get user by email and password
     */
    public function getUserByEmail($email) {
        $result = mysqli_query($this->con,"SELECT * FROM gcm_users WHERE email = '$email' LIMIT 1");
        return $result;
    }

    /**
     * Getting all users
     */
    public function getAllUsers() {
        $result = mysqli_query($this->con,"select * FROM gcm_users");
        return $result;
    }

    /**
     * Check user is existed or not
     */
    public function isUserExisted($email) {
        $result = mysqli_query($this->con,"SELECT email from gcm_users WHERE email = '$email'");
        $no_of_rows = mysqli_num_rows($result);
        if ($no_of_rows > 0) {
            // user existed
            return true;
        } else {
            // user not existed
            return false;
        }
    }

}

?>
