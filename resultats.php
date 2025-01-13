<!DOCTYPE HTML>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <title>Résultats actuels de l'expérience de sélection de cartes à drafter !</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="author" content="Lilian Besson (Naereen)" />
  <link href="gallery.css" rel="stylesheet">
  <script src="gallery.js"></script>
</head>
<body> 
<h1>Table des valeurs brutes dans la base de données</h1>
<?php
  // Cursor for the Database
  $SQLiteDBCursor = new SQLite3('experiments.db');

  $SQLiteResult = $SQLiteDBCursor->query("SELECT * FROM experiments");
  if ($SQLiteResult == false) {
    $lastErrorMessage = $SQLiteDBCursor->lastErrorMsg();
    printf("<script>alert('Échec pour afficher cette table.ajouter ce choix dans la base de données.\n(log : « $lastErrorMessage »).\nContacter naereen@crans.org si vous pouvez ?')</script>");
  }
  printf("<ol>");
  while ($row = $SQLiteResult->fetchArray()) {
    printf("<li>{$row[1]}</li>");
  }
  printf("</ol>");
?>
</div>
<footer>
<h4>Conçu par passion par <a href="https://github.com/Naereen/A-B-testing-of-draft-cards">Lilian (Naereen)</a></h4>
</footer>
</body>
