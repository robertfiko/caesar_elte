<?php
/*

Feltételezheted, hogy az űrlapba beírt adatok helyesek, viszont a tároláskor figyelj arra, hogy megfelelő típusú adatokat ments el (szám típust számként, logikait logikaiként stb.)!

a. (1 pont) Az oldalra érkezve jelenjen meg egy űrlap, amely minden szükséges mezőt tartalmaz!
b. (1,5 pont) Az űrlapot helyesen kitöltve mentsd el a felküldött adatokat típushelyesen (szám, logikai) egy fájlba! Sikeres mentés után újra jelenjen meg az űrlap!
c. (1,5 pont) Az űrlap alatt listázódjanak az eddigi kincsek minden adatukkal. Ez a lista/táblázat minden oldalbetöltéskor jelenjen meg, azaz akkor is, amikor először érkezünk az oldalra, és akkor is, amikor az űrlapot elküldtük és adatait sikeresen mentettük!
d. (2 pont) Egy-egy kincset lehessen törölni a lista soraiban megjelenített "Töröl" linkre kattintva!
e. (2 pont) Oldjuk meg, hogy ha az űrlapon már létező nevű kincset adunk meg, csak frissítsük annak adatait, ne adjuk hozzá újra!


*/
$file = json_decode(file_get_contents("adatok.json"));
if (isset($_GET["kuld"]) && isset($_GET["kincsnev"]) && isset($_GET["kincsertek"]) && isset($_GET["kincsszin"]) && isset($_GET["megtartjuk"])) {
      $adatok = [
            "nev" => $_GET["kincsnev"],
            "ertek" => intval($_GET["kincsertek"]),
            "kincsszin" => $_GET["kincsszin"],
            "megtartjuk" => $_GET["megtartjuk"] == "true"
      ];
      $file[] = $adatok;

      echo json_encode($file);
      file_put_contents("adatok.json", json_encode($file), JSON_PRETTY_PRINT);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>3. feladat</title>
</head>

<body>
      <h1>3. feladat</h1>

      <h2>Űrlap</h2>
      <form method="GET">
            <label for="kincsnev">Kincs neve: </label> <input type="text" name="kincsnev" id="kincsname"><br>
            <label for="kincsnev">Kincs erteke: </label> <input type="number" name="kincsertek" id="kincsertek"><br>
            <label for="kincsszin">Kincs színe: </label><br>
            <select name="kincsszin" id="kincsszin">
                  <option value="piros">Piros</option>
                  <option value="narancs">Narancs</option>
                  <option value="zold">Zöld</option>
                  <option value="kek">Kék</option>
                  <option value="lila">Lila</option>
            </select><br>
            Megtartjuk?<br>
            <input type="radio" value="true" name="megtartjuk" id="yes"> <label for="yes">Igen</label><br>
            <input type="radio" value="false" name="megtartjuk" id="no"> <label for="no">Nem</label><br>
            <input type="submit" value="Küldés" name="kuld">
      </form>

      <h2>Kincslista</h2>
      <table>
            <tr>
                  <th>Nev</th>
                  <th>Ertek</th>
                  <th>Szin</th>
                  <th>Megtartjuk</th>
            </tr>
            <?php

            for ($i = 0; $i < count($file); $i++) {
                  echo "<tr>";


                  echo "<td>" . $file[$i]["nev"] . "</td>";
                  echo "<td>" . $file[$i]->ertek . "</td>";
                  echo "<td>" . $file[$i]->kincsszin . "</td>";
                  echo "<td>" . $file[$i]->megtartjuk . "</td>";


                  echo "</tr>";
            }

            ?>
      </table>



</body>

</html>