<?php
	$title = "Infos Films";
	require "./include/header.inc.php";
	require_once "./include/functions.inc.php";
	require_once "./include/util.inc.php";
?>

<?php		
	if (isset($_GET['id']) && (!empty($_GET['id']))){
        
        $id_serie = $_GET['id'];
        $_GET["type"]="serie";
        setcookie('lastFilm' , $id_serie,time() + (86400 * 30));
        setcookie('date_visited', date("d/m/y à G:i"), time()+ (86400 * 30));
        setcookie('type' , "serie",time() + (86400 * 30));
        $url = "https://api.themoviedb.org/3/tv/$id_serie?api_key=ceb1c71467bda2e8ea5a2fa127f7e68b&language=FR";
        
        data_serie_details($url);
    }
?>
	
<?php  
	require "./include/footer.inc.php";
?>