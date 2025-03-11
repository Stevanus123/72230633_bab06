<?php 
include("koneksi.php");
$nim = $_GET["id"];
$sql = "DELETE FROM mahasiswa WHERE nim='$nim'";
if($conn->query($sql)){
    header("Location: tampil_mhs.php");
}else{
    echo "Data gagal dihapus";
    echo '<a href="tampil_mhs.php">&laquo Kembali ke Daftar Mahasiswa</a>';
}
?>