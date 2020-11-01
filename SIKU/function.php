<?php

//koneksi ke DB
$conn = mysqli_connect("localhost", "root", "", "db_tokokue");
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah ($data) {
    global $conn;
    

    $nama_kue = htmlspecialchars($data["nama_kue"]);
    $harga_kue = htmlspecialchars($data["harga_kue"]);


    $gambar = upload();

    if( !$gambar){
        return false;
    }

        $query = "INSERT INTO kue VALUES 
        ('','$nama_kue','$harga_kue','$gambar');
     ";
     mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload() {


    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];


    if( $error === 4) {
        echo "<script>
                alert('Pilih Gambar Terdahulu');
            </script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        
        echo "<script>
                alert('File Yang Anda Upload Bukan Gambar!!');
             </script>";
             return false;

    }

    if($ukuranFile >  1000000 ){
        echo "<script>
                alert('Ukuran Gambar Anda Terlalu Besar !!');
                </script>";
            return false;
    }
    $namaFileBaru = uniqid();
    $namaFielBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    



    move_uploaded_file($tmpName, 'assets/' . $namaFileBaru);


    return $namaFileBaru;

}

function hapus ($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM kue WHERE id=$id");
    return mysqli_affected_rows($conn);
}

    function ubah($data) {
        global $conn;
    
        $id  = $data["id"];
        $nama_kue = htmlspecialchars($data["nama_kue"]);
        $harga_kue = htmlspecialchars($data["harga_kue"]);
        $gambarLama = htmlspecialchars($data["gambarLama"]);

        if( $_FILES['gambar']['error'] === 4){
            $gambar = $gambarLama;
        }else{
            $gambar = upload();
        }

    
            $query = "UPDATE kue SET
                        nama_kue = '$nama_kue', 
                        harga_kue = '$harga_kue', 
                        gambar = '$gambar'
                    WHERE id = $id
                ";
         mysqli_query($conn, $query);
    
        return mysqli_affected_rows($conn);
}

function cari($keyword) {
    $query = "SELECT * FROM kue 
                WHERE
             nama_kue LIKE '%$keyword%' OR
             harga_kue LIKE '%$keyword%'
            ";
    return query($query);

}


function registrasi($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);


    // cek username udah ada apa belum
    $result = mysqli_query($conn, "SELECT username FROM user 
        WHERE username = '$username'");     
    if( mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('username sudah terdaftar!')
                </script>";
            return false;
    }

    // cek konfirmasi password
    if( $password !== $password2 ) {
        echo "<script>
                alert('konfirmasi password tidak sesuai !')
                </script>";
                
            return false;
    }


    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user terbaru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username'
            , '$password')");

    return mysqli_affected_rows($conn);
} 