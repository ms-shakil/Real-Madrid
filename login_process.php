<?php

include("connect.php");
include("login.php");

if (isset($_POST['login_button'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];


    $query = "SELECT * FROM userinfo WHERE email = '$email' AND password_ = '$password'";

$result = mysqli_query($conn, $query);
//$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
//$active = $row['active'];

$count = mysqli_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row


if ($count >= 1) {
    header('Location:Home.php');
    
} else {
    echo "user does not exitst!";
    
}

//$conn->close();
   
}

?>

