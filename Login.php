<?php
include "db.php";

if(isset($_POST['username'], $_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    
    $result = $conn->query($sql);

    if($result && $result->num_rows>0){
        $user = $result->fetch_assoc();

        if(password_verify($password, $user['password'])){
            header("Location: index.html"); 
            exit();
        } 
      
    } 
   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styleLogin.css" />
    <title>Login</title>
</head>
<body>
    <div class="conainerS">
        <div class="Login">
            <form action="Login.php" method="POST">
                <h2>Login</h2>
                <div class="username-container">
                    <input type="text" name="username" />
                    <label for="">Username</label>
                </div>

                <div class="password-container">
                    <input type="password" name="password" class="pass2" />
                    <label class="pass" for="password">Password</label>
                </div>

                <div class="remember">
                    <br>
                    <label for=""> <input type="checkbox" /> Remember me</label>
                </div>

                <button type="submit">Login</button>

                <div class="signUp-link">
                    <p>
                        Don't have an account?<a href="Signup.php" class="signUpBtn-link"> Sign Up</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>