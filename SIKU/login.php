<?php
session_start();
require 'function.php';
//cek cookie
if(isset($_COOKIE['id']) && isset($_COOKIE['key']) ){
  $id = $_COOKIE['id'];
  $key = $_COOKIE['key'];

  // ambil username berdasarkan id
  $result = mysqli_query($conn, "SELECT username FROM user WHERE
  id = $id");
  $row = mysqli_fetch_assoc($result);
  
  //cek cookie dan username
  if($key === hash('sha256', $row['username']) ) {
    $_SESSION['login'] = true;

}

}

if( isset($_SESSION["login"]) ){
    header("Location: index.php");
    exit;
}


if(isset($_POST["login"]) ){

    $username = $_POST["username"];
    $password = $_POST["password"];

   $result= mysqli_query($conn, "SELECT * FROM user WHERE
   username = '$username'");

   //cek username
   if( mysqli_num_rows($result) === 1 ){

    //cek password 
    $row = mysqli_fetch_assoc($result);
   if (password_verify($password, $row["password"])) {

    //set session
        $_SESSION["login"] = true;

        //cek remember me
        if(isset($_POST['remember']) ){
            //buat cookie
            setcookie('id', $row['id'], time()+60);
            setcookie('key', hash('sha256', $row['username']),
            time()+60);

        }

        header("Location: index.php");
        exit;
        }
    }

    $error = true;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Halaman Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body style="background-image: url('assets/bg9.jpg')";>
<h1 align = "center"> Silahkan Login</h1>
            <hr>
<?php if(isset($error) ) : ?>
    <p style="color: red; font-style: italic;"> username /
    password salah</p>
<?php endif; ?>
<div class="col-md-offset-4 col-md-4 ">
<form action="" method="post">

    
        <div class="form-group">
            <label for="username">Username :</label>
            <input type="text" name="username" id="username">
        </div>
    
        <div class="form-group">
            <label for="password">Password :</label>
            <input type="password" name="password" id="password">
        
        </div>

        <div class="form-group">
            <input type="checkbox" name="remember" id="password">
            <label for="remember">Remember me :</label>
        </div>
        <div class="form-group">
            <button type="submit"  name="login">Login</button>
            </div>   
</div>
</body>

</html>