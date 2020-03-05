<?php
    include_once('./config/db.php');

    class Profile {
        public $db;

        public function __construct() {
            $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

            if (mysqli_connect_error()) {
                echo "Error: Could not connect to database.";
                exit;
            }
        }

        // Create New Profile
        public function create_profile($userID, $lastName, $firstName, $middleName, $completeAddress, $gender, $civilStatus, $birthday, $school, $course, $noOfHours) {
            $isDeleted = false;
            $dateCreated = date("Y-m-d");
            $query = "SELECT * FROM profiles WHERE UserID='$userID'";

            // Check if the profile is already created
            $check = $this->db->query($query);
            $count_row = $check->num_rows;

            if ($count_row == 0) {
                $query = "INSERT INTO profiles (UserID, LastName, FirstName, MiddleName, CompleteAddress, Gender, CivilStatus, Birthday, School, Course, NoOfHours, IsDeleted, DateCreated) VALUES ('$userID', '$lastName', '$firstName', '$middleName', '$completeAddress', '$gender', '$civilStatus', '$birthday', '$school', '$course', '$noOfHours', '$isDeleted', '$dateCreated')";
                $result = mysqli_query($this->db, $query) or die(mysqli_connect_error() . "Data cannot inserted");
                return $result;
            } else {
                return false;
            }
        }

        // Check if User Profile exist
        public function get_profile($userID) {
            $query = "SELECT * FROM profiles WHERE UserID='$userID'";
            $result = mysqli_query($this->db, $query);
            $user_data = mysqli_fetch_array($result);
            return $user_data;
        }
    }
?>