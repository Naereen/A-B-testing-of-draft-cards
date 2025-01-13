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
<h1>Une petite application web pour de l'A/B testing pour du draft (Magic, the Hobbit, etc)</h1>
<p>
Je suis perdu, c'est quoi ce truc ?
<a href="https://github.com/Naereen/A-B-testing-of-draft-cards?tab=readme-ov-file">La documentation est là !</a>
</p>
<br>
<p>
Ah, c'est plus clair !
<ul>
<li>Je veux tester avec des cartes Magic ? <a href="demo-Magic-draft.php">C'est là pour le draft Magic</a></li>
<li>Et pour voir des résultats d'expérience ? <a href="demo-resultats-Magic-draft.php">C'est par là pour les résultats depuis le draft Magic</a></li>
</ul>
</p>

<h2>Cartes Magic utilisées pour la démonstration de l'application "A-B-testing-of-draft-cards"</h2>
<br>
<div class="gallery">
<?php
  // Get images in 'images/' folder
  $dir = "images" . DIRECTORY_SEPARATOR;
  $images = glob("$dir*.{jpg,jpeg,gif,png,bmp,webp}", GLOB_BRACE);
  $nbImages = count($images);

  printf("<p>Choix d'une seule carte parmi ces $nbSelectedImages cartes, tirées d'une extension avec <b>$nbImages cartes différentes</b>.</p>\n");

  foreach ($images as $numImage) {
    $img = basename($images[$numImage]);
    $caption = substr($img, 0, strrpos($img, "."));
    printf("<img src='images/%s' title='%s' alt='%s'>\n", rawurlencode($img), $caption, $caption);
  }
?>
<br>
<p>
Un clic met l'image en plein écran (cliquer pour quitter).</br>
Merci de votre participation !
</p>
</div>
<footer>
<h3>💚 Conçu par passion par <a href="https://github.com/Naereen/A-B-testing-of-draft-cards">Lilian (Naereen)</a>, <a href="https://naereen.mit-license.org/">MIT Licensed</a>, © 2025</h3>
</footer>
</body>
