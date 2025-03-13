<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
</head>

<body>
    <?php
    include("koneksi.php");
    include("fungsi.php");

    if (!empty($_POST)) {
        $_COOKIE["search"] = $_POST["search"];
        $_COOKIE["jenis"] = $_POST["jenis"];
        $baris = $conn->query("SELECT * FROM mahasiswa WHERE " . $_COOKIE["jenis"] . " LIKE '%" . $_COOKIE["search"] . "%'")->num_rows;
        $result_navi = navi($_POST["page"], $_POST["navi"], $baris);
        $navi = $result_navi["navi"];
        $mulai = $result_navi["mulai"];
        $fill = $result_navi["fill"];
    } else {
        $mulai = 0;
        $fill = 2;
        $navi = 0;
        setcookie("search", "");
        setcookie("jenis", "nim");
    }
    ?>

    <form method="post">
        <table border="1">
            <caption>
                <h3>Daftar Mahasiswa</h3>
            </caption>
            <tr>
                <td align="right">Search:</td>
                <td align="center"><select name="jenis">
                        <option value="nim" <?= ($_COOKIE["jenis"] ?? "nim") == "nim" ? "selected" : "" ?>>NIM</option>
                        <option value="nama" <?= ($_COOKIE["jenis"] ?? "nim") == "nama" ? "selected" : "" ?>>Nama</option>
                        <option value="bahasa" <?= ($_COOKIE["jenis"] ?? "nim") == "bahasa" ? "selected" : "" ?>>Bahasa</option>
                        <option value="warga_negara <?= ($_COOKIE["jenis"] ?? "nim") == "warga_negara" ? "selected" : "" ?>">Negara</option>
                        <option value="alamat" <?= ($_COOKIE["jenis"] ?? "nim") == "alamat" ? "selected" : "" ?>>Alamat</option>
                        <option value="kota" <?= ($_COOKIE["jenis"] ?? "nim") == "kota" ? "selected" : "" ?>>Kota</option>
                    </select></td>
                <td><input type="text" name="search" style="width: 243px;" placeholder="Masukkan keyword" value="<?= $_COOKIE["search"] ?? ""; ?>"></td>
            </tr>
            <tr>
                <td style="width: 130px;" align="right">Halaman ke-</td>
                <td><input type="text" name="page" value="<?= $navi ?>" readonly style="width: 83px;"></td>
                <td style="width: 251px;" align="center">
                    <a href="form_tambah_mhs.php" style="display: inline-flex; align-items: center; gap: 5px;">
                        Tambah Data
                        <img src="new.png" alt="Insert" height="25px">
                    </a>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="right">
                    <input type="submit" name="navi" value="<<" title="Top">
                    <input type="submit" name="navi" value="<" title="Previous">
                    <input type="submit" name="navi" value=">" title="Next">
                    <input type="submit" name="navi" value=">>" title="End">
                </td>
            </tr>
        </table>
    </form>
    <?php
    if (!empty($_POST))
        $sql = "SELECT nim, nama, tgl_lahir, gender, bahasa, warga_negara, alamat, kota, foto FROM mahasiswa WHERE " . $_COOKIE["jenis"] . " LIKE '%" . $_COOKIE["search"] . "%' LIMIT $mulai, $fill";
    else
        $sql = "SELECT nim, nama, tgl_lahir, gender, bahasa, warga_negara, alamat, kota, foto FROM mahasiswa LIMIT $mulai, $fill";

    $result = $conn->query($sql);
    if ($result->num_rows > 0)
        while ($row = $result->fetch_assoc())
            card($row);
    else
        echo '<h3>Data Tidak Ada!</h3>';
    ?>

</body>

</html>