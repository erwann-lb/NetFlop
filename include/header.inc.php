<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta name="auteur" content="Erwann LE BOULCH, Loïc Vanden Abeele"/>
    <meta name="date" content="04/2021"/>
    <meta name="devweb" content="projet devweb"/>
    <meta name="lieu" content="Cergy Pontoise"/>
    <link rel="stylesheet" type="text/css" href="styles2.css"/>

    <title>Netflop | <?php echo $title; ?></title>

</head>

<body>
    <header>
        <a href="./index.php"><img class="logo" src="./images/logo2.png" alt="logo"/></a>
        <nav>
            <ul class="nav_links">
                <li><a href="./index.php">Accueil</a></li>
                <li><a href="./films.php">Films</a></li>
                <li><a href="./series.php">Séries</a></li>
                <li><a href="./statistiques.php">Statistiques</a></li>
                <li><a href="./imagedujour.php">Image du jour</a></li>

            </ul>
        </nav>
        <div class="barre_recherche">
            <form class="recherche" action="./recherche.php" method="get">
                <input type="search" name="film" id="film" placeholder="  Recherche de film.."/><br/>
                <input type="submit" id="bouton" value=""/>
            </form>
        </div>
    </header>
    <main>