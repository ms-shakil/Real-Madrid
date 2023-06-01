<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>

  
</head>

<body>

</body>

</html>

</html>

<?php

include("connect.php");
//include("login.php");

$username_error = $password_error = $confirm_password_error = "";
$username = $password = $confirm_password = "";
$email = $email_error = "";


if (isset($_POST['button'])) {


    if (empty($_POST["username"])) {
        $username_error = "Username is required.";
    } else {
        $username = ($_POST["username"]);
    }


    if (empty($_POST["email"])) {
        $email_error = "Email is required.";
    } else {
        $email = ($_POST["email"]);
    }

    if (empty($_POST["password"])) {
        $password_error = "Password is required.";
    } else {
        $password = ($_POST["password"]);

        if (empty($_POST["confirm_password"])) {
            $confirm_password_error = "Confirm password is required.";
        } else {
            $confirm_password = ($_POST["confirm_password"]);
            if ($confirm_password !== $password) {
                $confirm_password_error = "Passwords do not match.";
            }
        }
    }

    if (empty($username_error) && empty($email_error) && empty($password_error) && empty($confirm_password_error)) {

        $query = "INSERT INTO userinfo (username,email,password_,confirm_password) VALUES ('$username','$email','$password','$confirm_password')";


        if (mysqli_query($conn, $query)) {

            header('Location:login.php');
        }
    } else {
        echo "Fields Cannot be Empty!";
        exit();
    }
}


$conn->close();

?>
