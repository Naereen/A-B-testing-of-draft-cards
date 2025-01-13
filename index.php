<!DOCTYPE HTML>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <title>Une petite application web pour de l'A/B testing pour du draft (Magic, the Hobbit, etc)</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="author" content="Lilian Besson (Naereen)" />
  <link href="css/gallery.css" rel="stylesheet">
  <script src="js/gallery.js"></script>
</head>
<body> 

<h1>Trouvons les cartes déséquilibrées en draft (pour <i>Magic</i>, <i>The Hobbit</i>, etc)</h1>
<p>
Oups, <a title="Perdu comme Fblthp !" href="https://scryfall.com/card/tsr/308/fr/fblthp-l%C3%A9gar%C3%A9">je suis perdu</a>, c'est quoi ce truc ? C'est une page web. OK merci !<br>
Ce projet répond à une demande d'un ami, et j'espère que cela suffira !<br>
<a href="https://github.com/Naereen/A-B-testing-of-draft-cards?tab=readme-ov-file">La documentation est là !</a>
</p>

<h2 id="demo">Pour tester, avec quelques cartes Magic ?</h2>
<p>
Ah, c'est plus clair après avoir lu la documentation (ou après m'avoir demandé des explications) !
<ul>
  <li>Pour tester cette application de mini draft, avec des cartes Magic, <a href="demo-Magic-draft.php">c'est par là (draft Magic)</a></li>
  <li>Pour voir des résultats d'expérience depuis les Magic, principalement utilisée lors du développement de cette application, <a href="demo-resultats-Magic-draft.php">c'est par ici (résultats Magic)</a></li>
</ul>
</p>

<h2 id="hobbit">Pour la prochaine extension du jeu <a href="http://hobbitdraftgame.free.fr/Updates.html">« The Hobbit: Draft Game »</a> ?</h2>
<p>
<ul>
  <li><a href="Fellowship/index.php">Draft Hobbit côté « Fellowship »</a></li>
  <li><a href="Shadow/index.php">Draft Hobbit côté « Shadow »</a></li>
  <li>Et pour voir des résultats d'expérience ?
    <a href="Fellowship/resultats.php">Résultats des drafts côté « Fellowship »</a>
    <a href="Shadow/resultats.php">Résultats des drafts côté « Shadow »</a>
  </li>
</ul>
</p>

<h2>Cartes Magic utilisées pour la démonstration de l'application "A-B-testing-of-draft-cards"</h2>
<div class="gallery">
<?php
  // Get images in 'images/' folder
  $dir = "images" . DIRECTORY_SEPARATOR;
  $images = glob("$dir*.{jpg,jpeg,gif,png,bmp,webp}", GLOB_BRACE);
  $nbImages = count($images);
  $selectedImages = array_rand($images, $nbImages);

  printf("<p>L'application de draft demande de choisir une seule carte parmi quinze cartes <i>Magic</i> (ou cinq cartes pour <i>The Hobbit</i>), tirées aléatoirement (uniformément) depuis une sélection contenant <b>$nbImages cartes différentes <i>Magic</i></b> (ou deux fois 40 cartes pour <i>The Hobbit</i>).</p>\n");

  foreach ($selectedImages as $numImage) {
    $img = basename($images[$numImage]);
    $caption = substr($img, 0, strrpos($img, "."));
    printf("<img src='images/%s' title='%s' alt='%s'>\n", rawurlencode($img), $caption, $caption);
  }
?>
<br>
<p>
Un clic met l'image en plein écran (cliquer pour quitter).<br>
Merci de votre participation !
</p>
</div>
<footer>
<h3>💚 Conçu par passion par <a href="https://github.com/Naereen/A-B-testing-of-draft-cards">Lilian (Naereen)</a>, <a href="https://naereen.mit-license.org/">MIT Licensed</a>, © 2025</h3>
</footer>
</body>
