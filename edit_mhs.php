<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa</title>
</head>

<body>
    <table border="1">
        <caption>Edit Data Mahasiswa</caption>
        <form method="post" enctype="multipart/form-data">
            <?php
            include("koneksi.php");
            $nim = $_GET["id"];
            $sql = "SELECT * FROM mahasiswa WHERE nim='$nim'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            extract($row);
            $bhs = explode(", ", $bahasa);
            ?>
            <tr>
                <td>NIM</td>
                <td><input type="text" name="nim" value="<?= $nim ?>" readonly></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?= $nama ?>"></td>
            </tr>
            <tr>
                <td>Tgl. Lahir</td>
                <td><input type="date" name="tgl_lahir" value="<?= $tgl_lahir ?>"></td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>
                    <input type="radio" name="gender" value="1" <?= ($gender == 1) ? "checked" : ""; ?>>Laki-laki
                    <input type="radio" name="gender" value="0" <?= ($gender == 0) ? "checked" : ""; ?>>Perempuan
                </td>
            </tr>
            <tr>
                <td>Bahasa</td>
                <td>
                    <input type="checkbox" name="bahasa[]" value="Indonesia" <?= in_array("Indonesia", $bhs) ? "checked" : ""; ?>>Indonesia
                    <br>
                    <input type="checkbox" name="bahasa[]" value="Inggris" <?= in_array("Inggris", $bhs) ? "checked" : ""; ?>>Inggris
                    <br>
                    <input type="checkbox" name="bahasa[]" value="Jepang" <?= in_array("Jepang", $bhs) ? "checked" : ""; ?>>Jepang
                    <br>
                    <input type="checkbox" name="bahasa[]" value="Mandarin" <?= in_array("Mandarin", $bhs) ? "checked" : ""; ?>>Mandarin
                    <br>
                    <input type="checkbox" name="bahasa[]" value="Arab" <?= in_array("Arab", $bhs) ? "checked" : ""; ?>>Arab
                    <br>
                    <input type="checkbox" name="bahasa[]" value="Korea" <?= in_array("Korea", $bhs) ? "checked" : ""; ?>>Korea
                </td>
            </tr>
            <tr>
                <td>Warga Negara</td>
                <td>
                    <select name="warga_negara">
                        <option value="Indonesia" <?= ($warga_negara == "Indonesia") ? "selected" : ""; ?>>Indonesia</option>
                        <option value="Inggris" <?= ($warga_negara == "Inggris") ? "selected" : ""; ?>>Inggris</option>
                        <option value="Jepang" <?= ($warga_negara == "Jepang") ? "selected" : ""; ?>>Jepang</option>
                        <option value="Mandarin" <?= ($warga_negara == "Mandarin") ? "selected" : ""; ?>>Mandarin</option>
                        <option value="Arab" <?= ($warga_negara == "Arab") ? "selected" : ""; ?>>Arab</option>
                        <option value="Korea" <?= ($warga_negara == "Korea") ? "selected" : ""; ?>>Korea</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat" value="<?= $alamat ?>"></td>
            </tr>
            <tr>
                <td>Kota</td>
                <td><input type="text" name="kota" value="<?= $kota ?>"></td>
            </tr>
            <tr>
                <td>Foto</td>
                <td><input type="file" name="foto"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" placeholder="Password baru"></td>
            </tr>
            <tr>
                <td colspan="2" align="right"><input type="reset"><input type="submit" value="Simpan"></td>
            </tr>
        </form>
    </table>
    <?php
    if ($_POST) {
        extract($_POST);
        $bahasa = implode(", ", $bahasa);
        $file_name = "foto/$nim" . ".jpg";
        move_uploaded_file($_FILES["foto"]["tmp_name"], $file_name);
        if ($password == "")
            $query = "UPDATE mahasiswa SET nama='$nama', tgl_lahir='$tgl_lahir', gender=$gender, bahasa='$bahasa', warga_negara='$warga_negara', alamat='$alamat', kota='$kota', foto='$file_name' WHERE nim='$nim'";
        else
            $query = "UPDATE mahasiswa SET nama='$nama', tgl_lahir='$tgl_lahir', gender=$gender, bahasa='$bahasa', warga_negara='$warga_negara', alamat='$alamat', kota='$kota', foto='$file_name', password=PASSWORD('$password') WHERE nim='$nim'";
        if ($conn->query($query))
            header("Location: tampil_mhs.php");
        else
            header("Location: edit_mhs.php?nim=$nim");
    }
    ?>
</body>

</html>