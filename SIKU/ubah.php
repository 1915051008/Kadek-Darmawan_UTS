<?php
require 'function.php';

$id = $_GET["id"];

$cake = query("SELECT * FROM kue WHERE id = $id")[0];

if (isset($_POST["submit"])) {

    if(ubah($_POST) > 0){
        echo "
            <script>
                alert('data berhasi diubah!');
                document.location.href = 'index.php';
            </script>
                ";
    } else {
        echo "         
        <script>
        alert('data gagal diubah!');
        document.location.href = 'index.php';
        </script>";
    }
}
?>
<html>
<head>
    <title>MERUBAH DATA KUE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="background-image: url('assets/bg9.jpg')";>
<h1 align ="center">Merubah Data Kue</h1>
    <hr>
    <div class="col-md-offset-4 col-md-4 ">
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $cake["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $cake["gambar"]; ?>">
        
                <div class="form-group">
                <label for="nama_kue"> nama_kue :</label>
                <input type="text" name="nama_kue" id="nama_kue" required
                value="<?= $cake["nama_kue"];?>">
                </div>
                <div class="form-group">
                <label for="harga_kue"> harga_kue :</label>
                <input type="text" name="harga_kue" id="harga_kue"
                value="<?= $cake["harga_kue"];?>">
                </div>
                <div class="form-group">
                <label for="gambar">Gambar :</label> 
                <img src="assets/<?= $cake['gambar']; ?>" width="80"> 
                <input type="file" name="gambar" id="gambar">
                </div>
                <div class="form-group">
                <button type="submit" name="submit">UBAH DATA</button>
                </div>
    </form>
    </div>
</body>

</html>