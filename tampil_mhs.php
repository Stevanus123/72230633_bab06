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
    $baris = $conn->query("SELECT * FROM mahasiswa")->num_rows;
    if (!empty($_POST)) {
        $result_navi = navi($_POST["page"], $_POST["navi"], $baris);
        $navi = $result_navi["navi"];
        $mulai = $result_navi["mulai"];
        $fill = $result_navi["fill"];
    } else {
        $mulai = 0;
        $fill = 2;
        $navi = 0;
    }
    ?>

    <h2>Daftar Mahasiswa</h2>
    <form method="post">
        <table>
            <tr>
                <td>Halaman ke-</td>
                <td><input type="text" name="page" value="<?= $navi ?>" readonly></td>
            </tr>
            <?php
            $sql = "SELECT * FROM mahasiswa LIMIT $mulai, $fill";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc())
                card($row);
            ?>
            <tr>
                <td>
                    <input type="submit" name="navi" value="<<">
                    <input type="submit" name="navi" value="<">
                    <input type="submit" name="navi" value=">">
                    <input type="submit" name="navi" value=">>">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>