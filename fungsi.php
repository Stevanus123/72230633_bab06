    <?php
    function card($kol, $gambar = "foto", $id = "nim")
    {
        $brs = count($kol);
        echo '<table border="1">';
        $hitung = 0;
        foreach ($kol as $k => $v) {
            if ($k == "gender" && $v == 1)
                $v = "Laki-laki";
            else if ($k == "gender" && $v == 0)
                $v = "Perempuan";

            if ($k == "foto")
                continue;

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

    function navi($page, $navi, $baris, $fill = 2, $mulai = 0)
    {
        $max_page = ceil($baris / $fill) - 1;
        switch ($navi) {
            case "<<":
                $navi = 0;
                break;
            case "<":
                if ($page > 0)
                    $navi = $page - 1;
                else
                    $navi = 0;
                break;
            case ">":
                if ($page < $max_page)
                    $navi = $page + 1;
                else
                    $navi = $max_page;
                break;
            case ">>":
                $navi = $max_page;
                break;
        }
        $mulai = $navi * $fill;
        return [
            "navi" => $navi,
            "mulai" => $mulai,
            "fill" => $fill
        ];
    }
    ?>