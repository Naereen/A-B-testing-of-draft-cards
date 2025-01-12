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
<legend>
  Choix d'une seule carte parmi cette sélection aléatoire uniforme. Merci de votre participation !
</legend>
<form action="radio_buttons_action.php" method="GET">
<?php
  // (B) GET IMAGES IN images FOLDER
  $dir = __DIR__ . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR;
  $images = glob("$dir*.{jpg,jpeg,gif,png,bmp,webp}", GLOB_BRACE);

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
<input type='submit' value="Je drafte cette superbe carte !">
</form>
</fieldset>
</div>
</body>
