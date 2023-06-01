<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    

    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">



</head>

<body>



    <section class="main">

        <div class="signup">
            <div class="signupform">

                <h2>LOGIN TO ACCOUNT</h2>


                <form  method="POST" action="login_process.php" class="form">


                    <input type="email" name="email" placeholder="EMAIL">

                    <input type="password" name="password" placeholder="PASSWORD">

                    <button type="submit" class="btn" name="login_button">Login</button>


                </form>

                <p class="reg_to_login">Create a new Account. <a href="index.html"> Sign Up</a> </p> 

            </div>
        </div>


    </section>

</body>

</html>