<?php
	$title="Films";
	require_once "./include/functions.inc.php";
	require "./include/header.inc.php";
?>

<main>
    <section>
        <h2>Recherche</h2>
        <article id="details">
        <?php 
            recherche_film($_GET['film']) 
        ?>
        </article>
    </section>

<?php  
    require "./include/footer.inc.php";
?>