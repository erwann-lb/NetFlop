<?php
	$title="Series";
	require_once "./include/functions.inc.php";
	require "./include/header.inc.php";
?>

<h1 style="color:firebrick;font-size: 40px;text-align: center;font-family: arial">Séries</h1>
	<section>
		<article>
			<?php
				getSeriesGenre("20");
			?>
		</article>
	</section>



<?php
	$title="footer";
	require "./include/footer.inc.php";
?>