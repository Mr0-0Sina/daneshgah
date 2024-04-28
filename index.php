<?php
//////////////////////////////////////////////////////////////////////////
if(isset($_COOKIE['id'])) {
    $id = $_COOKIE['id'];
    include 'dataBase.php';
    $dataBase = new Database();
    $userInfo = $dataBase->getUserInfo($id);
    if($userInfo != null){
    $fullname = $userInfo['fullname'];
    $username = $userInfo['username'];
    $email = $userInfo['email'];
    }else{
    header("Location: login.php");
    die; 
    }
} else {
    header("Location: login.php");
    die;
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
    <p>fullname: <?= $fullname?></p>
    <p>username: <?= $username?></p>
    <p>email: <?= $email?></p>
    <p></p>

    </div>
</body>
</html>
