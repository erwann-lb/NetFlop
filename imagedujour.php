<?php
	$title = "Image du Jour";
	require "./include/header.inc.php";
	require_once "./include/functions.inc.php";
	require_once "./include/util.inc.php";
?>

<section><h1 style="color:firebrick;font-size: 40px;text-align: center;font-family: arial">Image du jour</h1>
    <article><h2>Image provenant de la Nasa</h2>
       
       <?php
				$url = "https://api.nasa.gov/planetary/apod?api_key=X9u33iB9wSc5cAczUGibWUz6X9gXYOK232d26q1t";
				json($url);

        ?> 
    
    </article>
</section>

<?php  
	require "./include/footer.inc.php";
?>