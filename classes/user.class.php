<?php
    include_once("./config/db.php");

    class User {
        public $db;

        public function __construct() {
            $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

            if (mysqli_connect_error()) {
                echo "Error: Could not connect to database.";
                exit;
            }
        }

        // For registration
        public function register_user($fullname, $username, $password, $email) {
            $password = md5($password);
            $query = "SELECT * FROM users WHERE Username='$username' OR Email='$email'";

            // Check username or email in database
            $check = $this->db->query($query);
            $count_row = $check->num_rows;

            // If username or email is not in database
            if ($count_row == 0) {
                $query = "INSERT INTO users SET FullName='$fullname', Username='$username', Password='$password', Email='$email'";
                $result = mysqli_query($this->db, $query) or die(mysqli_connect_error() . "Data cannot inserted");
                return $result;
            } else {
                return false;
            }
        }

        // For login
        public function login_user($username, $password) {
            $password = md5($password);
            $query = "SELECT ID FROM users WHERE Username='$username' AND Password='$password'";

            // Check username in database
            $result = mysqli_query($this->db, $query);
            $user_data = mysqli_fetch_array($result);
            $count_row = $result->num_rows;

            // If username is not in database
            if ($count_row == 1) {
                $_SESSION['login'] = true;
                $_SESSION['id'] = $user_data['ID'];
                return true;
            } else {
                return false;
            }
        }

        // Getting the fullname of user
        public function get_fullname($id) {
            $query = "SELECT FullName FROM users WHERE ID='$id'";
            $result = mysqli_query($this->db, $query);
            $user_data = mysqli_fetch_array($result);
            echo $user_data['FullName'];
        }

        // Getting the username of user
        public function get_username($id) {
            $query = "SELECT Username FROM users WHERE ID='$id'";
            $result = mysqli_query($this->db, $query);
            $user_data = mysqli_fetch_array($result);
            return $user_data['Username'];
        }

        // Starting the session
        public function get_session() {
            return $_SESSION['login'];
        }

        // Logout user
        public function user_logout() {
            $_SESSION['login'] = false;
            session_destroy();
        }
    }
?>