<?php
	$title="Accueil";
	require_once "./include/functions.inc.php";
	require "./include/header.inc.php";
?>


	<h1 style="color:firebrick;font-size: 40px;text-align: center;font-family: arial">Accueil</h1>
	<section>
            <?php
				afficheDerniereConsultation();
			?>
		<h2>Films populaires</h2>
        <article class="scroll-bar">
            <?php
				getTrending("20");
			?>
        </article>
		<h2 class="nom_genre">Series Populaires</h2>
		<article class="scroll-bar">
			<?php
				getTrendingSeries("20");
			?>
		</article>

	</section>

<?php
	$title="footer";
	require "./include/footer.inc.php";
?>