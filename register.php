<?php
if(isset($_POST['username']) and isset($_POST['fullname']) and isset($_POST['email']) and isset($_POST['password'])){
    include 'dataBase.php';
    $dataBase = new Database();
    [
        $username,$fullname,$email,$password
    ] = [
        $_POST['username'],
        $_POST['fullname'],
        $_POST['email'],
        $_POST['password']
    ];
    if($dataBase->checkUser($username, $email)){
    $register = $dataBase->registerUser($username, $fullname, $email, $password);
    if($register){
        setcookie("id", "$username", time() + 3600, "/");

        header("Location: index.php");
        die();
    }else{
        echo "<script>alert('خطا')</script>";
    }
    }
    else{
        echo "<script>alert('کاربر با این مشخصات وجود دارد')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <form action="register.php" method="POST">
            <h2>Register</h2>
            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" id="fullname" name="fullname" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Register</button>
        </form>
        <p>Already registered? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
