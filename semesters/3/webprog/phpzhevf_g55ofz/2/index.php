<?php

$errors = [];
$goblinok = true;
if (!isset($_GET["goblins"]) ||  intval($_GET["goblins"]) <= 0 || floatval($_GET["goblins"]) != intval($_GET["goblins"])) {
  $errors[] = "Érvénytelen goblin mennyiség";
  $goblinok = false;
}

if (!isset($_GET["chief"])  || count(explode(" ", $_GET["chief"])) <= 1) {
  $errors[] = "Érvénytelen vezető";
} else {
  $rangok = ["goblinka", "kisfőnök", "nagyfőnök", "főfőnök", "törzsfő"];
  $rang = explode(" ", $_GET["chief"])[count(explode(" ", $_GET["chief"])) - 1];
  if (!in_array($rang, $rangok)) {
    $errors[] = "Érvénytelen rang";
  } else {
    if ($rang == "goblinka" || $rang == "kisfőnök") {
      $errors[] = "Túl alacsony rang";
    }
  }
}

if (!isset($_GET["shovels"]) || !is_numeric($_GET["shovels"]) || floatval($_GET["shovels"]) != intval($_GET["shovels"])) {
  $errors[] = "Érvénytelen ásó mennyiség";
} else {
  if ($goblinok && intval($_GET["shovels"]) < intval($_GET["goblins"])) {
    $errors[] = "Túl kevés ásó";
  }
}

if (count($errors) == 0) {
  if (intval($_GET["shovels"]) == intval($_GET["goblins"]) * 2)
    $errors[] = "Gyorsan megszerezzük a kincset";

  else
    $errors[] = "Indulhat az akció!";
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>2. feladat</title>
</head>

<body>
      <h1>2. feladat</h1>

      <h2>Üzenetek</h2>
      <?php

  for ($i = 0; $i < count($errors); $i++) {
    echo "<br>" . $errors[$i];
  }

  ?>

      <h2>Próbalinkek</h2>
      <a href="index.php?goblins=5&chief=Snuch Nawdow nagyfőnök&shovels=7">
            <pre>index.php?goblins=5&chief=Snuch Nawdow nagyfőnök&shovels=7</pre>
      </a>
      <a href="index.php?goblins=5&chief=Snuch Nawdow nagyfőnök&shovels=10">
            <pre>index.php?goblins=5&chief=Snuch Nawdow nagyfőnök&shovels=10</pre>
      </a>
      <a href="index.php">
            <pre>index.php</pre>
      </a>
      <a href="index.php?goblins=nemszám&chief=nincsszóköz&shovels=nemszám">
            <pre>index.php?goblins=nemszám&chief=nincsszóköz&shovels=nemszám</pre>
      </a>
      <a href="index.php?goblins=-5&chief=Snuch Nawdow nagyfőnök&shovels=10">
            <pre>index.php?goblins=-5&chief=Snuch Nawdow nagyfőnök&shovels=10</pre>
      </a>
      <a href="index.php?goblins=16.2&chief=Snuch Nawdow nagyfőnök&shovels=10">
            <pre>index.php?goblins=16.2&chief=Snuch Nawdow nagyfőnök&shovels=10</pre>
      </a>
      <a href="index.php?goblins=16&chief=Snuch Nawdow nagyfőnök&shovels=10">
            <pre>index.php?goblins=16&chief=Snuch Nawdow nagyfőnök&shovels=10</pre>
      </a>
      <a href="index.php?goblins=5&chief=Snuch Nawdow párttitkár&shovels=10">
            <pre>index.php?goblins=5&chief=Snuch Nawdow párttitkár&shovels=10</pre>
      </a>
      <a href="index.php?goblins=5&chief=Snuch Nawdow kisfőnök&shovels=10">
            <pre>index.php?goblins=5&chief=Snuch Nawdow kisfőnök&shovels=10</pre>
      </a>
</body>

</html>