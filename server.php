<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'patientendb';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if ( mysqli_connect_errno() ) {
    // If there is an error with the connection, stop the script and display the error.
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if (isset($_POST['login_user'])) {
    // Now we check if the data from the login form was submitted, isset() will check if the data exists.
    if ( !isset($_POST['username'], $_POST['password']) ) {
        // Could not get the data that should have been sent.
        die ('Please fill both the username and password field!');
    } else {
        // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
        if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
            // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
            $stmt->bind_param('s', $_POST['username']);
            $stmt->execute();
            // Store the result so we can check if the account exists in the database.
            $stmt->store_result();
        }

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $password);
            $stmt->fetch();
            // Account exists, now we verify the password.
            // Note: remember to use password_hash in your registration file to store the hashed passwords.
            if (password_verify($_POST['password'], $password)) {
                // Verification success! User has loggedin!
                // Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $_POST['username'];
                $_SESSION['id'] = $id;
                echo "bla";
                $stmt = $con->prepare('SELECT role FROM accounts WHERE username = ?');
                $stmt->bind_param('s', $_SESSION['name']);
                $stmt->execute();
                $stmt->bind_result($role);
                $stmt->fetch();
                if ($role == 'doctor') {
                    header('Location: homeDoctor.php');
                } elseif ($role == 'assistant') {
                    header('Location: homeAssistant.php');
                } else {
                    header('Location: homePatient.php');
                }
            } else {
                echo 'Incorrect password!';
            }
        } else {
            echo 'Incorrect username!';
        }
        $stmt->close();
    }
}

if (isset($_POST['register_user'])) {
    $errors = array(); 
     // receive all input values from the form
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password_1 = mysqli_real_escape_string($con, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($con, $_POST['password_2']);

    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    if ($stmt = $con->prepare('SELECT id, email, username FROM accounts WHERE email = ? OR username = ? LIMIT 1')) {
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
        $stmt->bind_param('ss', $_POST['email'], $_POST['username']);
        $stmt->execute();
        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();
    }
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $emailDB, $usernameDB);
        $stmt->fetch();
        if ($usernameDB === $username) {
            array_push($errors, "Username already exists");
          }
          if ($emailDB === $email) {
            array_push($errors, "email already exists");
          }
          
    $stmt->close();
    }
    echo implode(",", $errors);
    echo count($errors);
    if (count($errors) == 0) {
        $password = password_hash($password_1, PASSWORD_DEFAULT);
        $stmt = $con->prepare('INSERT INTO accounts (username, password, email, role) VALUES (?, ?, ?, "patient")');
        $stmt->bind_param('sss', $username, $password, $email);
        $stmt->execute();
        $stmt->store_result();
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
    }
}
?>