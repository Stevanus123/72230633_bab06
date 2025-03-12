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
    $baris = $conn->query("SELECT * FROM mahasiswa")->num_rows;
    $fill = 2;
    $max_page = ceil($baris / $fill) -1;
    if (!empty($_GET)) {
        $page = $_GET["navi"];
        switch ($page) {
            case "<<":
                $page = 0;
                break;
            case "<":
                if($_GET["page"] > 0)
                    $page = $_GET["page"] - 1;
                else
                    $page = 0;
                break;
            case ">":
                if($_GET["page"] < $max_page)
                    $page = $_GET["page"] + 1;
                else
                    $page = $max_page;
                break;
            case ">>":
                $page = $max_page;
                break;
        }
        $mulai = $page * $fill;
    } else{
        $page = 0;
        $mulai = 0;
    }
    ?>

    <h2>Daftar Mahasiswa</h2>
    <form>
        <table>
            <tr>
                <td>Halaman ke-</td>
                <td><input type="text" name="page" value="<?= $page ?>" readonly></td>
            </tr>
            <?php
            include("fungsi.php");
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