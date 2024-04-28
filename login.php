<?php
if(isset($_POST['username']) and isset($_POST['password'])){
    include 'dataBase.php';
    $dataBase = new Database();
    [
        $username,$password
    ] = [
        $_POST['username'],
        $_POST['password']
    ];
    if(!$dataBase->checkUser($username, "")){
        $login = $dataBase->verifyLogin($username, $password);
        if($login){
        setcookie("id", "$username", time() + 3600, "/");
        header("Location: index.php");
        die();
        }else{
            echo "<script>alert('مشخصات وارد شده صحیح نیست')</script>";
        }
    }
    else{
        echo "<script>alert('مشخصات وارد شده صحیح نیست')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <form action="login.php" method="POST">
            <h2>Login</h2>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <p>if registered? <a href="register.php">register here</a></p>

    </div>
</body>
</html>
