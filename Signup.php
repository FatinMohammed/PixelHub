<?php

session_start();
include "db.php";

if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) 
            VALUES ('$username','$email','$hashPassword')";

    if ($conn->query($sql)) {
        header("Location: index.html");
        exit();
    } else {
        echo "Error" . $conn->error;
    }
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleLogin.css">
    <title>Signup</title>
</head>
<body>
    <div class="conainerS">
        <div class="Login">
            <form action="Signup.php" method="POST">
                <h2>Sign Up</h2>

                <div class="username-container">
                    <input type="text" name="username" />
                    <label for="">Username</label>
                </div>

                <div class="username-container">
                    <input type="email" name="email" />
                    <label class="e" for="">Email</label>
                </div>

                <div class="password-container">
                    <input type="password" name="password" class="pass2" />
                    <label class="pass" for="password">Password</label>
                </div>

                <div class="remember">
                    <br>
                    <label>
                        <input type="checkbox"> I agree to the terms & conditions
                    </label>
                </div>

                <button type="submit">Sign Up</button>

                <div class="signUp-link">
                    <p>Already have an account?<a href="Login.php" class="signInBtn-link"> Sign In</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
</body>
</html>



