<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
</head>

<body>
    <h2>Daftar Mahasiswa</h2>
    <table border="1">
        <?php
        include("koneksi.php");
        include("fungsi.php");
        $sql = "SELECT * FROM mahasiswa";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc())
            card($row);
        ?>
    </table>
</body>

</html>