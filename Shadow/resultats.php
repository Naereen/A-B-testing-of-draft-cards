<!DOCTYPE HTML>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <title>Résultats actuels de l'expérience de sélection de cartes à drafter !</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="author" content="Lilian Besson (Naereen)" />
  <link href="css/resultats.css" rel="stylesheet">
  <script src="js/gallery.js"></script>
</head>
<body> 
<?php
  // Get images in 'images/' folder
  $dir = "images" . DIRECTORY_SEPARATOR;
  $images = glob("$dir*.{jpg,jpeg,gif,png,bmp,webp}", GLOB_BRACE);
  $nbImages = count($images);
  // Cursor for the Database
  $SQLiteDBCursor = new SQLite3('experiments.db');
  $SQLiteResult = $SQLiteDBCursor->query("SELECT COUNT(path) FROM experiments");
  if ($SQLiteResult == false) {
    $lastErrorMessage = $SQLiteDBCursor->lastErrorMsg();
    printf("<script>alert('Échec pour afficher cette base de données.\n(log : « $lastErrorMessage »).\nContacter naereen@crans.org si vous pouvez ?')</script>");
  }
  $nbVotes = $SQLiteResult->fetchArray()[0];

  printf("<h1>Résultats des $nbVotes expériences menées sur ces $nbImages cartes de draft</h1><hr>\n"); 

  printf("<h2>Les cartes par ordre décroissant de préférence</h2>\n");
  printf("<a href='./statsOnVotes.php'>Tableur CSV de ces données</a>\n");
  $SQLiteResult = $SQLiteDBCursor->query("SELECT COUNT(*) as votes, path FROM experiments GROUP BY path ORDER BY votes DESC");
  if ($SQLiteResult == false) {
    $lastErrorMessage = $SQLiteDBCursor->lastErrorMsg();
    printf("<script>alert('Échec pour afficher cette base de données.\n(log : « $lastErrorMessage »).\nContacter naereen@crans.org si vous pouvez ?')</script>");
  }
  printf("<ol class='gallery'>");
  while ($row = $SQLiteResult->fetchArray()) {
    $img = $row[1];
    $caption = substr($img, 0, strrpos($img, "."));
    printf("<li><b>{$row[0]} votes</b> pour <img src='images/%s' title='%s' alt='%s'></li>\n", rawurlencode($img), $caption, $caption);
  }
  printf("</ol>\n");
  printf("</details>\n");

  printf("<h2>Des détails si besoin...</h2>\n");
  printf("<a href='./statsFullExperiments.php'>Tableur CSV des résultats bruts</a>\n");
  printf("<details><summary>Table des valeurs brutes dans la base de données (cliquer pour le détail)</summary>\n");
  $SQLiteResult = $SQLiteDBCursor->query("SELECT path, date FROM experiments");
  if ($SQLiteResult == false) {
    $lastErrorMessage = $SQLiteDBCursor->lastErrorMsg();
    printf("<script>alert('Échec pour afficher cette base de données.\n(log : « $lastErrorMessage »).\nContacter naereen@crans.org si vous pouvez ?')</script>");
  }
  printf("<ol>");
  while ($row = $SQLiteResult->fetchArray()) {
    printf("<li><a href='images/{$row[0]}'>${row[0]}</a> a été choisie, à la date/heure ${row[1]}</li>\n");
  }
  printf("</ol>\n");
  printf("</details>\n");
?>
</div>
<footer>
<h3>💚 Conçu par passion par <a href="https://github.com/Naereen/A-B-testing-of-draft-cards">Lilian (Naereen)</a>, <a href="https://naereen.mit-license.org/">MIT Licensed</a>, © 2025</h3>
</footer>
</body>
