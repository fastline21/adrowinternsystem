<?php
    session_start();
    include('includes/autoloader.inc.php');
    
    $user = new User();
    $profile = new Profile();

    // Define variable
    $title = "Add Profile";
    $userID = $_SESSION['id'];
    $username = $user->get_username($userID);
    $lastNameErr = $firstNameErr = $middleNameErr = $completeAddressErr = $genderErr = $civilStatusErr = $birthdayErr = $schoolErr = $courseErr = $noOfHoursErr = "";
    $errors = false;
    $message = "";

    // Check if User Profile exist
    if ($profile->get_profile($userID)) {
        header("location: profile.php?u=" . $username);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_REQUEST['submit'])) {
            extract($_REQUEST);

            // Validate input
            empty($lastName) ? ($lastNameErr = "Last Name is required" AND $errors = true) : $lastName = check_input($lastName);
            empty($firstName) ? ($firstNameErr = "First Name is required" AND $errors = true) : $firstName = check_input($firstName);
            empty($middleName) ? ($middleNameErr = "Middle Name is required" AND $errors = true) : $middleName = check_input($middleName);
            empty($completeAddress) ? ($completeAddressErr = "Complete Address is required" AND $errors = true) : $completeAddress = check_input($completeAddress);
            empty($gender) ? ($genderErr = "Gender is required" AND $errors = true) : $gender = check_input($gender);
            empty($civilStatus) ? ($civilStatusErr = "Civil Status is required" AND $errors = true) : $civilStatus = check_input($civilStatus);
            empty($birthday) ? ($birthdayErr = "Birthday is required" AND $errors = true) : $birthday = check_input($birthday);
            empty($school) ? ($schoolErr = "School is required" AND $errors = true) : $school = check_input($school);
            empty($course) ? ($courseErr = "Course is required" AND $errors = true) : $course = check_input($course);
            empty($noOfHours) ? ($noOfHoursErr = "No of Hours is required" AND $errors = true) : $noOfHours = check_input($noOfHours);

            if (!$errors) {
                $add = $profile->create_profile($userID, $lastName, $firstName, $middleName, $completeAddress, $gender, $civilStatus, $birthday, $school, $course, $noOfHours);
                
                if ($add) {
                    header("location: profile.php?u=" . $username);
                } else {
                    $message = "User already created profile";
                }
            }
        }
    }

    // Check input
    function check_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<!-- Header -->
<?php include_once('templates/header-dashboard.php'); ?>
<?php include_once("templates/sidebar-dashboard.php"); ?>

    <!-- Body -->
    <section>
        <div class="container">
            <h1><?php echo $title; ?></h1>
            <hr />
            <?php
                if ($message) {
                    echo $message;
                }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . "?u=" . $username); ?>" method="post">
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label>Last Name: </label>
                            <input type="text" name="lastName" class="form-control" placeholder="Enter Last Name (Required)" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>First Name: </label>
                            <input type="text" name="firstName" class="form-control" placeholder="Enter First Name (Required)" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Middle Name: </label>
                            <input type="text" name="middleName" class="form-control" placeholder="Enter Middle Name" />
                        </div>
                    </div>
                </div>
                <hr />
                <div class="form-group">
                    <label>Complete Address: </label>
                    <input type="text" name="completeAddress" class="form-control" placeholder="Enter Complete Address Name" />
                </div>
                <hr />
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label>Gender: </label>
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="gender" class="form-check-input" value="Male" />
                                    <label class="form-check-label">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="gender" class="form-check-input" value="Female" />
                                    <label class="form-check-label">Female</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Civil Status: </label>
                            <select name="civilStatus" class="form-control">
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorced">Divorced</option>
                                <option value="Widowed">Widowed</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Birthday: </label>
                            <input type="date" name="birthday" class="form-control" />
                        </div>
                    </div>
                </div>
                <hr />
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label>School: </label>
                            <input type="text" name="school" class="form-control" placeholder="Enter School" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Course: </label>
                            <input type="text" name="course" class="form-control" placeholder="Enter Course" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>No of Hours:</label>
                            <input type="number" name="noOfHours" class="form-control" placeholder="Enter No of Hours" />
                        </div>
                    </div>
                </div>
                <hr />
                <button type="submit" name="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </section>

<!-- Footer -->
<?php include_once("templates/sidebar-dashboard-footer.php"); ?>
<?php include_once('templates/footer.php'); ?>