<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'function.php';
$kue = query("SELECT * FROM kue");

// tombol cari di tekan
if( isset($_POST["cari"]) ) {
    $kue = cari($_POST["keyword"]);
}

?>
<html> 

<head>
    <title>HALAMAN ADMIN</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="background-image: url('assets/bg9.jpg')";>
 <a href="logout.php">logout</a>

    <h1>DAFTAR KUE</h1>

    <a href="tambah.php">Tambah Kue</a>
    <br></br>
 
 <form action="" method="post"> 

    <input type="text" name="keyword"size="30" autofocus
    placeholder="Masukan Keyword Pencarian..." autocomplete="off">
    <button type="submit" name="cari">Cari!</button>

 </form> 
  <br>
    <table border="1" cellpadding="25" cellspacing="0">
        <tr>
            <th>NO.</th>
            <th>aksi</th>
            <th>gambar</th>
            <th>nama_kue</th>
            <th>harga_kue</th>

        </tr>
        <?php $i = 1;?> 
         <?php foreach ($kue as $row) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td>
                <a href="ubah.php?id=<?= $row["id"]; ?>">Ubah</a>
                    <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="
                    return confirm('yakin?');">Hapus</a>
                </td>
                <td><img src="assets/<?= $row["gambar"]; ?>" width="50"></td>
                <td><?= $row["nama_kue"] ?></td>
                <td><?= $row["harga_kue"] ?></td>
            </tr>
        
            <?php $i++; ?>
         <?php endforeach; ?>
        
    </table>

</body>

</html>