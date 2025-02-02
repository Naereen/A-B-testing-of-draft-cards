# A-B testing of draft cards

Ce dépôt GitHub héberge le code source, d'une petite application web (PHP + SQLite) pour permettre des expériences de type A/B testing sur des cartes de draft. Cadeau pour un ami !

[Cette application est déployée ici](https://perso.crans.org/besson/publis/A-B-testing-of-draft-cards/index.php) (pour choisir une carte à drafter, parmi cinq),
et [ici pour voir les résultats des expériences](https://perso.crans.org/besson/publis/A-B-testing-of-draft-cards/resultats.php).

L'application est vraiment très simple, et elle est conçue pour utiliser des cartes **Magic: the Gathering**,
ou des cartes du jeu de draft du **LOTR Multi** [(une extension pour le jeu de cartes de <i>The Hobbit</i>)](http://hobbitdraftgame.free.fr/Download.html).

> *Fun fact :* Ce truc inutile et amusant a été développé seul, en 24h pour mon anniversaire en 2025. Je n'avais jamais fait de PHP, et je n'avais en fait jamais utilisé mes connaissances théoriques de SQL (SQLite) pour un vrai projet. C'est chose faite. Youpi !
> J'aime bien me donner des challenges originaux de programmation lors d'un anniversaire. Regardez [ce projet](https://github.com/Naereen/Chasse-aux-tr-sors-au-Louvre-pour-mes-25-ans) fait pour mes 25 ans, ou [celui-là](https://github.com/Naereen/GMusicBrowser-FullScreen-WebApp) pour mes 26 ans.

----

## Un aperçu de ce que cette application propose

### La page pour choisir une carte parmi 5
![screenshots/screenshots-index.png](screenshots/screenshots-index.png)

### La page de résultat de l'expérience menée
![screenshots/screenshots-resultats.png](screenshots/screenshots-resultats.png)

### Fonctionnalité interactive top moderne de dingue

- Des *raccourcis clavier* : 1/2/3/4/5 ou a/z/e/r/t ou &/é/"/'/( pour voter 1/2/3/4/5 une des cinq cartes proposées, et espace/entrer pour acter le choix
- Une petite notification discrète après un vote !
- Une aide rapide et discrète si besoin (sur raccourcis clavier h/?)
- Même features sur les trois pages de vote (Fellowship/Shadow, et démo Magic)

----

## Exemple des fichiers tableur CSV

- [Les statistiques utiles (nombre de votes par cartes) obtenus en développant l'application](csv/statsOnVotes_2025-01-13_03_27.csv) (04:27 le 2025-01-13) ;

```csv
nombresVotes,path
9,sld-1737-wolverine-best-there-is.jpg
9,j22-40-kibo-uktabi-prince.jpg
8,pcy-45-rhystic-study.jpg
8,mom-137-etali-primal-conqueror.jpg
5,lea-232-black-lotus.jpg
[...]
1,dmc-128-abundant-growth.jpg

```

- [Tous les choix faits en développant l'application](csv/statsFullExperiments_2025-01-13_03_26.csv) (04:26 le 2025-01-13) ;

```csv
id,path,date
1,stx-164-biomathematician.jpg,"2025-01-13 02:27:11"
2,pkld-59s-padeem-consul-of-innovation.jpg,"2025-01-13 02:27:13"
3,pcy-45-rhystic-study.jpg,"2025-01-13 02:27:14"
4,lea-232-black-lotus.jpg,"2025-01-13 02:27:16"
```

----

## :scroll: License ? [![GitHub license](https://img.shields.io/github/license/Naereen/A-B-testing-of-draft-cards)](https://github.com/Naereen/A-B-testing-of-draft-cards/blob/master/LICENSE)
Le code source de ce projet est publié sous les termes de la [License MIT](https://lbesson.mit-license.org/) (fichier [LICENSE](LICENSE)).
© [Lilian Besson](https://GitHub.com/Naereen), 2024.

Les images des différentes cartes ne sont pas ma propriété, mais celle de leurs auteurs respectifs (notamment [Wizards of the Coast](https://magic.wizards.com/)).

[![Maintenance](https://img.shields.io/badge/Maintained%3F-yes-green.svg)](https://GitHub.com/Naereen/A-B-testing-of-draft-cards/graphs/commit-activity)
[![Ask Me Anything !](https://img.shields.io/badge/Ask%20me-anything-1abc9c.svg)](https://GitHub.com/Naereen/ama)
[![ForTheBadge uses-badges](http://ForTheBadge.com/images/badges/uses-badges.svg)](http://ForTheBadge.com)
[![ForTheBadge uses-git](http://ForTheBadge.com/images/badges/uses-git.svg)](https://GitHub.com/)
[![ForTheBadge made-with-php](http://ForTheBadge.com/images/badges/made-with-php.svg)](http://ForTheBadge.com)
[![ForTheBadge uses-html](http://ForTheBadge.com/images/badges/uses-html.svg)](http://ForTheBadge.com)
[![ForTheBadge uses-css](http://ForTheBadge.com/images/badges/uses-css.svg)](http://ForTheBadge.com)
[![ForTheBadge uses-js](http://ForTheBadge.com/images/badges/uses-js.svg)](http://ForTheBadge.com)
