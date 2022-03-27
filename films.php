<?php
	$title="Films";
	require_once "./include/functions.inc.php";
	require "./include/header.inc.php";
?>

<h1 style="color:firebrick;font-size: 40px;text-align: center;font-family: arial">Films</h1>
	<section>
			<?php
				getFilmsGenre("20");
			?>
	</section>



<?php
	$title="footer";
	require "./include/footer.inc.php";
?>