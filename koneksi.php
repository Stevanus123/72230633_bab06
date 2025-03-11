<?php
$conn = new mysqli("localhost", "root", "", "sistem_informasi_akademik");
if($conn->connect_error){
    die("Koneksi gagal: " . $conn->connect_error);
}
?>