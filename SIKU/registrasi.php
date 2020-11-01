<?php
require 'function.php';

if(isset($_POST["register"])) {

    if( registrasi ($_POST) > 0) {
        echo "<script>
        alert('user baru berhasil ditambahkan!');
        </script>";
    } else {
        echo mysqli_error($conn);
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Halaman Registrasi</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    label{
        display: block;
    }
    </style>
    <body style="background-image: url('assets/bg9.jpg')";>
</head>
<body>
<h1 align ="center">Halaman Registrasi</h1>
    <hr>
    <div class="col-md-offset-4 col-md-4 ">
    
    <form action="" method="post">

            <div class="form-group">
                <label for="username"> username :</label>
                <input type="text" name="username" id="username">
            </div>
            <div class="form-group">
                <label for="password"> password :</label>
                <input type="text" name="password" id="password">
                </div>
            <div class="form-group">
                <label for="password2">konfirmasi password :</label>
                <input type="password" name="password2" id="password2">
             </div>
            <div class="form-group">
                <button type="submit" name="register">Register!</button>
                </div>

        
    </form>
    </div>
</body>

</html>