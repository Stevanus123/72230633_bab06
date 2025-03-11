<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
</head>

<body>
    <form method="post" enctype="multipart/form-data">
        <table border="1">
            <caption>Tambah Data Mahasiswa</caption>
            <tr>
                <td>NIM</td>
                <td><input type="text" name="nim"></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama"></td>
            </tr>
            <tr>
                <td>Tgl. Lahir</td>
                <td><input type="date" name="tgl_lahir"></td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>
                    <input type="radio" name="gender" value="1" checked>Laki-laki
                    <input type="radio" name="gender" value="0">Perempuan
                </td>
            </tr>
            <tr>
                <td>Bahasa</td>
                <td>
                    <input type="checkbox" name="bahasa[]" value="Indonesia">Indonesia
                    <br>
                    <input type="checkbox" name="bahasa[]" value="Inggris">Inggris
                    <br>
                    <input type="checkbox" name="bahasa[]" value="Jepang">Jepang
                    <br>
                    <input type="checkbox" name="bahasa[]" value="Mandarin">Mandarin
                    <br>
                    <input type="checkbox" name="bahasa[]" value="Arab">Arab
                    <br>
                    <input type="checkbox" name="bahasa[]" value="Korea">Korea
                </td>
            </tr>
            <tr>
                <td>Warga Negara</td>
                <td>
                    <select name="warga_negara">
                        <option value="Indonesia" selected>Indonesia</option>
                        <option value="Inggris">Inggris</option>
                        <option value="Jepang">Jepang</option>
                        <option value="Mandarin">Mandarin</option>
                        <option value="Arab">Arab</option>
                        <option value="Korea">Korea</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat"></td>
            </tr>
            <tr>
                <td>Kota</td>
                <td><input type="text" name="kota"></td>
            </tr>
            <tr>
                <td>Foto</td>
                <td><input type="file" name="foto"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td colspan="2" align="right"><input type="reset"><input type="submit" value="Simpan"></td>
            </tr>
        </table>
    </form>
    <?php
    if ($_POST) {
        include("koneksi.php");
        extract($_POST);

        $bahasa = implode(", ", $bahasa);

        $file_name = "foto/$nim" . ".jpg";
        move_uploaded_file($_FILES["foto"]["tmp_name"], $file_name);

        $query = "INSERT INTO mahasiswa VALUES ('$nim', '$nama', '$tgl_lahir', $gender, '$bahasa', '$warga_negara', '$alamat', '$kota', '$file_name', PASSWORD('$password'))";
        if ($conn->query($query))
            header("Location: tampil_mhs.php");
        else
            echo "Data gagal disimpan";
    }
    ?>

</body>

</html>