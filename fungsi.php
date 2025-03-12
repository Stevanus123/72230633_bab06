    <?php
    function card($kol, $gambar = "foto", $id = "nim")
    {
        $brs = count($kol);
        echo '<table border="1">';
        $hitung = 0;
        foreach ($kol as $k => $v) {
            if ($hitung % 2 === 0)
                $warna = "#FFFFFF";
            else
                $warna = "#00ffff";

            if ($hitung == 0)
                echo '<tr><td rowspan="' . $brs . '" align=center>
            <img src="' . $kol["$gambar"] . '" width=130 height=180><br>
            <table>
            <tr><td>
            <form action="edit_mhs.php">
            <input type="hidden" name="id" value="' . $kol[$id] . '">
            <input type="submit" value="Ubah">
            </form>
            </td><td>
            <form action="delete_mhs.php">
            <input type="hidden" name="id" value="' . $kol[$id] . '">
            <input type="submit" value="Hapus">
            </form>
            </td></tr>
            </table>
            </td><td>' . ucwords($k) . '</td><td style="width: 250px;">' . $v . '</td></tr>';
            else
                echo '<tr bgcolor=' . $warna . '><td>' . ucwords($k) . '</td><td>' . $v . '</td></tr>';
            $hitung++;
        }
        echo '</table>';
    }
?>