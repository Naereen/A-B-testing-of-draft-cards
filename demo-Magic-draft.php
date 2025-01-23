<!DOCTYPE HTML>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <title>Sélection de cartes Magic à drafter - Choisissez une carte svp !</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="author" content="Lilian Besson (Naereen)" />
  <link href="css/gallery.css" rel="stylesheet">
  <script src="js/gallery.js"></script>
  <!-- MouseTrap.js (https://craig.is/killing/mice) -->
  <script src="js/mousetrap.min.js"></script>
  <!-- jQuery.Noty.js (Source: https://ned.im/noty/) -->
  <script src="js/jquery.js"></script>
  <script src="js/jquery.noty.packaged.min.js"></script>
  <script type="text/javascript">
    // jQuery.noty plugin
    $.noty.defaults = {
      layout: 'bottomRight', theme: 'defaultTheme', type: 'success',
      text: 'Default text for a noty notification (change it !).',
      dismissQueue: true, // If you want to use queue feature set this true
      template: '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>',
      animation: {
          open: {height: 'toggle'},
          close: {height: 'toggle'},
          easing: 'swing',
          speed: 300 // opening & closing animation speed
      },
      timeout: 1000, // delay for closing event. Set false for sticky notifications
      force: true, // adds notification to the beginning of queue when set to true
      modal: false, maxVisible: 15, // you can set max visible notification for dismissQueue true option
      closeWith: ['click', 'button'],
      callback: {
          onShow: function() { },
          afterShow: function() { },
          onClose: function() { },
          afterClose: function() { }
      },
      buttons: false // an array of buttons
    };
    console.log("[INFO] Loading jQuery, jQuery.noty !");
    function alert(texttoprint, extradict) {
      if ($.noty !== undefined){
        if (extradict !== undefined){
          var args = extradict;
          if (args.layout == undefined){ args.layout = 'bottomRight'; }
          args.text = texttoprint;
          noty(args);
        } else { noty({text: texttoprint, layout: 'bottomRight'}); }
      }
      else {
        window.alert(texttoprint);
      }; };
  </script>
</head>
<body>
<!-- <h1>Exemple de galerie interactive de cartes (ici, <i>Magic: the Gathering</i>)</h1> -->
<h2>SVP, choisissez une de ces cartes, comme dans un Draft</h2>
<!-- <br> -->
<?php
  // #6 Select 4 guilds among 10 from Ravnica's 10 guilds
  $allTheGuilds = [
    "Azorius",
    "Simic",
    "Rakdos",
    "Gruul",
    "Orzhov",
    "Izzet",
    "Golgari",
    "Boros",
    "Selesnya",
    "Dimir"
  ];
  $nbGuildsToSelect = 2;
  $selectedGuilds = array_rand(array_flip($allTheGuilds), $nbGuildsToSelect);

  printf("<div>\n");
  $guild0 = $selectedGuilds[0];
  $guild1 = $selectedGuilds[1];
  // $guild2 = $selectedGuilds[2];
  // $guild3 = $selectedGuilds[3];
  printf("<p>Lors de la mise en place, les paquets suivants ont été tirés : $guild0 et $guild1.</p>\n");
  printf("</div>\n");
?>
<div class="gallery">
<fieldset id="choiceImage">
<?php

  session_start(); // Start the session
  // Check if the session variable is set
  if (!isset($_SESSION['nbOfTimesACardWasChosen'])) {
      $_SESSION['nbOfTimesACardWasChosen'] = 1; // Initialize to 1
  } /* else {
      $_SESSION['nbOfTimesACardWasChosen'] = 0; // Increment the counter
  } */
  // session_write_close(); // Close the session

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
      } else {
          $_SESSION['nbOfTimesACardWasChosen']++;
          if ($_SESSION['nbOfTimesACardWasChosen'] <= 10) {
            printf("<script>alert('Merci pour ce first pick de draft (le ${_SESSION['nbOfTimesACardWasChosen']}-ième) ! On continue ?', {timeout: 1000, layout: 'center', closeWith: ['button']});</script>");
          }
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

  printf("<legend>Choix #${_SESSION['nbOfTimesACardWasChosen']} d'une seule carte parmi ces $nbSelectedImages cartes, tirées d'une sélection avec <b>$nbImages cartes différentes</b>.</legend>\n");
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
    printf("<input type='radio' name='choiceImage' id='radio-%s' value='%s'>#%s", $numLabel, $numImage, $numLabel);
    printf("<img src='images/%s' title='%s' alt='%s'>", rawurlencode($img), $caption, $caption);
    printf("</label>\n");
  }
?>
<br>
<input type='submit' id='input-submit' value="🃏 Je drafte cette carte !">
<span class="error"><?php echo "$chosenImageErr";?></span>
</form>
</fieldset>
<p>
Un clic met l'image en plein écran (cliquer pour quitter).<br>
Merci de votre participation !<br>
Les résultats de cette expérience sur Magic, <a href="demo-resultats-Magic-draft.php">c'est par ici</a> !
</p>
</div>
<footer>
<script type="text/javascript">
// MouseTrap (http://craig.is/killing/mice)
Mousetrap.bind(["1", "&", "a"], function() { document.getElementById("radio-1").click(); });
Mousetrap.bind(["2", "é", "z"], function() { document.getElementById("radio-2").click(); });
Mousetrap.bind(["3", "\"", "e"], function() { document.getElementById("radio-3").click(); });
Mousetrap.bind(["4", "'", "r"], function() { document.getElementById("radio-4").click(); });
Mousetrap.bind(["5", "(", "t"], function() { document.getElementById("radio-5").click(); });
Mousetrap.bind(["enter", "space"], function() { document.getElementById("input-submit").click(); });
Mousetrap.bind(["h", "?"], function() {
  alert("Les raccourcis claviers suivants sont activés :\n"
    +" - h/? : affiche ce message d'aide,\n"
    +" - 1 / & / a : choisis la première carte,\n"
    +" - 2 / é / z : deuxième,\n"
    +" - 3 / \" / e : troisième,\n"
    +" - 4 / ' / r : quatrième,\n"
    +" - 5 / ( / t : cinquième,\n"
    +" - Enter / Space : drafter cette carte,\n"
    +"~~~ Cette application web est développée par Lilian Besson (Naereen) © 2025"
    , {layout: 'center', type: 'information', timeout: 4000, closeWith: ['button']}
  );
});
</script>
<h3>💚 Conçu par passion par <a href="https://github.com/Naereen/A-B-testing-of-draft-cards">Lilian (Naereen)</a>, <a href="https://naereen.mit-license.org/">MIT Licensed</a>, © 2025</h3>
</footer>
</body>
