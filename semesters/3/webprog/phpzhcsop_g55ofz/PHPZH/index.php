<?php

$adatok = json_decode(file_get_contents('data.json'));
$szobak = $adatok->szobak;
$szobaarak = $adatok->szobaarak;



//szobatípus_ára * szobában_megszálló_vendégek_száma * éjszakák_száma
$szobakarakSum = [];

for ($i = 0; $i < count($szobak); $i++) {
      $ar = 0;
      if ($szobak[$i]->tipus == "standard") $ar = intval($szobaarak->standard);
      else if ($szobak[$i]->tipus == "superior") $ar = intval($szobaarak->superior);
      else if ($szobak[$i]->tipus == "deluxe") $ar = intval($szobaarak->deluxe);
      else if ($szobak[$i]->tipus == "president") $ar = intval($szobaarak->president);

      $szobakarakSum[] = $ar  /*$szobaarak[$szobak[$i]->tipus]*/ *  intval($szobak[$i]->ejszakak) * count($szobak[$i]->vendegek);
}

$tipusok = [];
$selected = [];
foreach ($szobaarak as $kulcs => $ertek) {
      $tipusok[] = $kulcs;
      if (isset($_GET["tipus"]) && $_GET["tipus"] == $kulcs) {
            $selected[] = "selected";
      } else {
            $selected[] = "";
      }
}

$szurtSzobak = [];
$szurtArak = [];
$hibak = [];
if (isset($_GET["tipus"])) {
      if ($_GET["tipus"] != "összes") {
            if (in_array($_GET["tipus"], $tipusok)) {
                  for ($i = 0; $i < count($szobak); $i++) {
                        if ($szobak[$i]->tipus == $_GET["tipus"]) {
                              $szurtSzobak[] = $szobak[$i];
                              $szurtArak[] = $szobakarakSum[$i];
                        }
                  }
            } else {
                  $hibak[] = "Nincs ilyen tipus.";
            }
      }
}


?>

<!DOCTYPE html>
<html lang="hu">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>PHP csoport ZH - G55OFZ</title>
</head>
<style>
table {
      border-collapse: collapse;
}

td,
th {
      border: 1px solid black;
      padding: 5px;
      text-align: center;
}
</style>

<body>
      <form>
            Típus:
            <select name="tipus">
                  <option value="összes">összes</option>

                  <?php
                  for ($i = 0; $i < count($tipusok); $i++) {
                        echo '<option value="' . $tipusok[$i] . '" ' . $selected[$i] . ' >' . $tipusok[$i] . '</option>';
                  }


                  ?>

            </select><br><br>
            <input type="submit" value="Szűrés">
      </form>

      <br><br>

      <?php

      if (count($hibak) > 0) {
            echo "<div>";

            for ($i = 0; $i < count($hibak); $i++) {
                  echo $hibak[$i] . "<br>";
            }

            echo "</div>";
      }

      ?>


      <br><br>

      <table>
            <tr>
                  <th>Szobaszám</th>
                  <th>Típus</th>
                  <th>Vendégek</th>
                  <th>Összesen fizetendő</th>
            </tr>

            <?php

            if (count($hibak) == 0) {
                  if (count($szurtSzobak) == 0) {
                        for ($i = 0; $i < count($szobak); $i++) {
                              echo "<tr style=\"background-color: " . ($szobak[$i]->foglalt ? "lightcoral" : "lightgreen") . "\">";
                              echo "<td>" . $szobak[$i]->szobaszam . "</td>";
                              echo "<td>" . $szobak[$i]->tipus . "</td>";
                              echo "<td>";
                              for ($j = 0; $j < count($szobak[$i]->vendegek); $j++) {
                                    echo $szobak[$i]->vendegek[$j] . "<br>";
                              }
                              echo "</td>";
                              echo "<td>" . $szobakarakSum[$i] . "</td>";
                              echo "</tr>";
                        }
                  } else {
                        for ($i = 0; $i < count($szurtSzobak); $i++) {
                              echo "<tr style=\"background-color: " . ($szurtSzobak[$i]->foglalt ? "lightcoral" : "lightgreen") . "\">";
                              echo "<td>" . $szurtSzobak[$i]->szobaszam . "</td>";
                              echo "<td>" . $szurtSzobak[$i]->tipus . "</td>";
                              echo "<td>";
                              for ($j = 0; $j < count($szurtSzobak[$i]->vendegek); $j++) {
                                    echo $szurtSzobak[$i]->vendegek[$j] . "<br>";
                              }
                              echo "</td>";
                              echo "<td>" . $szurtArak[$i] . "</td>";
                              echo "</tr>";
                        }
                  }
            }

            ?>
            <!-- A táblázat többi sorát ide generáld -->

      </table>
</body>

</html>