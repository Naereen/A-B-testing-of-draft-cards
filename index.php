<!DOCTYPE HTML>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <title>Sélection de cartes à drafter - Choisissez une carte svp !</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="author" content="Lilian Besson (Naereen)" />
  <link href="gallery.css" rel="stylesheet">
  <script src="gallery.js"></script>
</head>
<body> 
<h1>Exemple de gallerie interactive de cartes (ici, <i>Magic: the Gathering</i>)</h1>
<h2>SVP, choisissez une seule carte pour le draft</h2>
<br>
<div class="gallery">
<fieldset id="choiceImage">
<?php
  // Get images in 'images/' folder
  $dir = "images" . DIRECTORY_SEPARATOR;
  $images = glob("$dir*.{jpg,jpeg,gif,png,bmp,webp}", GLOB_BRACE);
  $nbImages = count($images);

  // Cursor for the Database
  $SQLiteDBCursor = new SQLite3('experiments.db');

  // define variables and set to empty values
  $chosenImageErr = "";
  $chosenImage = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["choiceImage"])) {
      $chosenImageErr = "* Un choix est requis !";
    } else {
      $chosenImage = basename($images[test_input($_POST["choiceImage"])]);
      $SQLiteStatement = $SQLiteDBCursor->prepare("INSERT INTO experiments(path, date) VALUES(?, datetime('now', 'localtime'))");
      $SQLiteStatement->bindValue(1, $chosenImage, SQLITE3_TEXT);
      $SQLiteResult = $SQLiteStatement->execute();
      if ($SQLiteResult == false) {
          $lastErrorMessage = $SQLiteDBCursor->lastErrorMsg();
          printf("<script>alert('Échec pour ajouter ce choix dans la base de données.\n(log : « $lastErrorMessage »).\nContacter naereen@crans.org si vous pouvez ?')</script>");
      }
    }
  }

  // Clean the input string
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  printf("<p>Cette page affiche une sélection aléatoire uniforme, prise parmi <b>%s cartes</b>.</p>\n", $nbImages);
  printf("<legend>Choix d'une seule carte</legend>\n");
?>
<form method='POST' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
<?php
  // Select only 5 images at random
  $nbSelectedImages = 5;  // TODO: FIXME: configure this somewhere specific?
  $selectedImages = array_rand($images, $nbSelectedImages);
 
  // Print the radio buttons and the images
  // And include the radio buttons inside the grid layout
  $numLabel = 0;
  foreach ($selectedImages as $numImage) {
    $numLabel = $numLabel + 1;
    $img = basename($images[$numImage]);
    $caption = substr($img, 0, strrpos($img, "."));
    printf("<label class='radio-inline'>");
    printf("<input type='radio' name='choiceImage' id='%s' value='%s'>#%s", $numImage, $numImage, $numLabel);
    printf("<img src='images/%s' title='%s' alt='%s'>", rawurlencode($img), $caption, $caption);
    printf("</label>\n");
  }
?>
<br>
<input type='submit' value="Je drafte cette carte !">
<span class="error"><?php echo "$chosenImageErr";?></span>
</form>
</fieldset>
<p>Un clic met l'image en plein écran (clic pour quitter).</p>
<p>Merci de votre participation !</p>
</div>
<footer>
<hr>
<h3>Conçu par passion par <a href="https://github.com/Naereen/A-B-testing-of-draft-cards">Lilian (Naereen)</a></h3>
</footer>
</body>
