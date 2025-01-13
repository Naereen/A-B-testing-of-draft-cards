<!DOCTYPE HTML>
<html lang="fr">
<head>
	<meta charset="utf-8" />
	<title>Sélection de cartes à drafter - Expérience numérique en cours !</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="author" content="Lilian Besson" />
	<link href="gallery.css" rel="stylesheet">
	<script src="gallery.js"></script>
</head>
<body> 
<h1>Exemple de gallerie d'images de cartes (ici, Magic)</h1>
<h2>Choisir une carte pour le draft</h2>
<br>
<div class="gallery">
<fieldset id="choiceImage">
<?php
  // (B) GET IMAGES IN images FOLDER
  // $dir = __DIR__ . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR;
  $dir = "images" . DIRECTORY_SEPARATOR;
  $images = glob("$dir*.{jpg,jpeg,gif,png,bmp,webp}", GLOB_BRACE);
  $nbImages = count($images);

  // Cursor for the Database
  $SQLiteDBCursor = new SQLite3('experiments.db');

  // https://tryphp.w3schools.com/showphp.php?filename=demo_form_validation_complete
  // define variables and set to empty values
  $chosenImageErr = "";
  $chosenImage = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["choiceImage"])) {
      $chosenImageErr = "* Un choix est requis !";
    } else {
      $chosenImage = $images[test_input($_POST["choiceImage"])];
      // printf("<script>alert('Image choisie : $chosenImage')</script>");
      // TODO: insert this into the database!
      $SQLiteStatement = $SQLiteDBCursor->prepare("INSERT INTO experiments(path) VALUES(?)");
      // $SQLiteStatement->bindParam(1, $chosenImage);
      $resultBindValue = $SQLiteStatement->bindValue(1, "$chosenImage", SQLITE3_TEXT);
      if ($resultBindValue == false) {
          printf("<script>alert('Échec pour bindValue. Contacter naereen@crans.org si vous pouvez ?')</script>");
      }
      $SQLiteResult = $SQLiteStatement->execute();
      if ($SQLiteResult == false) {
          printf("<script>alert('Échec pour ajouter ce choix dans la base de données. Contacter naereen@crans.org si vous pouvez ?')</script>");
      }
      // $chosenImage = 'TODO: TEST from index.php';
      // $SQLiteResult = $SQLiteStatement->execute();
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
<!-- <form method='POST' action='action_button_draft.php'> -->
<form method='POST' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
<?php
  // Select only 5 images at random
  $nbSelectedImages = 5;
  $selectedImages = array_rand($images, $nbSelectedImages);
 
  // Print the radio buttons
  // And include the radio buttons inside the grid layout?
  // (C) OUTPUT IMAGES
  $numLabel = 0;
  foreach ($selectedImages as $numImage) {
    $numLabel = $numLabel + 1;
    $img = basename($images[$numImage]);
    $caption = substr($img, 0, strrpos($img, "."));
    printf("<label class='radio-inline'>");
    printf("<input type='radio' name='choiceImage' id='%s' value='%s'>#%s", $numImage, $numImage, $numLabel);
    printf("<img src='images/%s' alt='%s'>", rawurlencode($img), $caption);
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
<h4>Conçu par passion par <a href="https://github.com/Naereen/A-B-testing-of-draft-cards">Lilian (Naereen)</a></h4>
</footer>
</body>
