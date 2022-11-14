<?php 
//include koneksi database 
include('koneksi.php'); 

//get data dari form 
$nisn = $_POST['nisn'];
$nama_lengkap = $_POST['nama_lengkap'];
$alamat = $_POST['alamat']; 

if (isset($_POST['upload'])) {
    // Get image name
    if($image = $_FILES['foto']['name']){
        // image file directory
        $target = "foto/".basename($image);
        
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
        }
    } else {
        $image = 'default.jpg';
    }
} 

$result = mysqli_query($connection, "SELECT * FROM tbl_siswa");

//query insert data ke dalam database 
$query = "INSERT INTO tbl_siswa (nisn, nama_lengkap, alamat, foto) VALUES ('$nisn', '$nama_lengkap', '$alamat', '$image')";
//kondisi pengecekan apakah data berhasil dimasukkan atau tidak 
if ($connection->query($query)) { 
    //redirect ke halaman index.php 
    header("location: index.php"); } 
    else { 
        //pesan error gagal insert data
         echo "Data Gagal Disimpan!";
    }
