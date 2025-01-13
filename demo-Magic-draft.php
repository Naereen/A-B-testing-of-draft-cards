<!DOCTYPE HTML>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <title>Sélection de cartes à drafter - Choisissez une carte svp !</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="author" content="Lilian Besson (Naereen)" />
  <link href="css/gallery.css" rel="stylesheet">
  <script src="js/gallery.js"></script>
</head>
<body> 
<!-- <h1>Exemple de gallerie interactive de cartes (ici, <i>Magic: the Gathering</i>)</h1> -->
<h2>SVP, choisissez une de ces cartes, comme dans un Draft</h2>
<br>
<div class="gallery">
<fieldset id="choiceImage">
<?php
  // Select only nbCards=5 images at random
  $nbSelectedImages = 5;  // TODO: document this somewhere (README.md?)
  if (empty($_GET["nbCards"]) == false) {
    $nbSelectedImages = (int)test_input($_GET["nbCards"]);
  }
  // FIXME: it does not keep the parameter after ONE vote...!
 
  // Get images in 'images/' folder
  $dir = "images" . DIRECTORY_SEPARATOR;
  $images = glob("$dir*.{jpg,jpeg,gif,png,bmp,webp}", GLOB_BRACE);
  $nbImages = count($images);
  $selectedImages = array_rand($images, $nbSelectedImages);

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

  printf("<legend>Choix d'une seule carte parmi ces $nbSelectedImages cartes, tirées d'une sélection avec <b>$nbImages cartes différentes</b>.</p>\n");
  printf("</legend>\n");
?>
<form method='POST' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
<?php
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
<input type='submit' value="🃏 Je drafte cette carte !">
<span class="error"><?php echo "$chosenImageErr";?></span>
</form>
</fieldset>
<p>
Un clic met l'image en plein écran (cliquer pour quitter).</br>
Merci de votre participation !<br>
Les résultats de cette expérience sur Magic, <a href="demo-resultats-Magic-draft.php">c'est par ici</a> !
</p>
</div>
<footer>
<h3>💚 Conçu par passion par <a href="https://github.com/Naereen/A-B-testing-of-draft-cards">Lilian (Naereen)</a>, <a href="https://naereen.mit-license.org/">MIT Licensed</a>, © 2025</h3>
</footer>
</body>
