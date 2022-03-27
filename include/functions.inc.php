<?php

    function getTrending($nbTrending){

        $json = file_get_contents("https://api.themoviedb.org/3/movie/popular?api_key=ceb1c71467bda2e8ea5a2fa127f7e68b&language=fr-FR&page=1");
        
        $json_data = json_decode($json);

        for($i = 0 ; $i < $nbTrending ; $i++ ){
            echo "<div onclick='infos_film.php ?id=".$json_data->results[$i]->title."'>\n";
            echo "<a href ='infos_film.php?id=".$json_data->results[$i]->id."'/>\n";
            echo "<img src ='https://image.tmdb.org/t/p/w185".$json_data->results[$i]->poster_path."' alt= 'Affiche de ".$json_data->results[$i]->title."'>\n";
            echo "<h3>".$json_data->results[$i]->title."</h3>\n";
            echo "</a>\n";
            echo "</div>\n";
        }
    }

    function getTrendingSeries($nbTrending){
        
        $json = file_get_contents("https://api.themoviedb.org/3/tv/popular?api_key=ceb1c71467bda2e8ea5a2fa127f7e68b&language=fr-FR&page=1");
        
        $json_data = json_decode($json);

        for($i = 0 ; $i < $nbTrending ; $i++ ){
            echo "<div onclick='infos_serie.php?id=".$json_data->results[$i]->name."'>\n";
            echo "<a href ='infos_serie.php?id=".$json_data->results[$i]->id."'/>\n";
            echo "<img src ='https://image.tmdb.org/t/p/w185".$json_data->results[$i]->poster_path."' alt= 'Affiche de ".$json_data->results[$i]->name."'>\n";
            echo "<h3>".$json_data->results[$i]->name."</h3>\n";
            echo "</a>\n";
            echo "</div>\n";
        }
    }


   function data_movie_details($url){
        $json = file_get_contents($url);
        $json_data = json_decode($json);
        
        echo "\t\t<section><h1>$json_data->title<h1>\n";
        echo"\t\t\t<h2>Informations générales</h2>\n";
        echo"\t\t\t<article class=\"infos_films\">\n";
        echo"\t\t\t\t<div class=\"affiche\">\n";
        echo"\t\t\t\t\t<figure>\n";
        if($json_data->poster_path!=null){
            echo "\t\t\t\t\t\t<img src ='https://image.tmdb.org/t/p/w185".$json_data->poster_path."' alt= 'Affiche de ".$json_data->title."'>\n";
        }else{
            echo "\t\t\t\t\t\t<img src ='./images/noimage.jpg' alt= 'Affiche de ".$json_data->results->original_name."'/>\n";
        } 
        echo "\t\t\t\t\t</figure>\n";
        echo"\t\t\t\t</div>\n";
        echo "\t\t\t\t<div class=\"infos_texte\">\n";
        echo "\t\t\t\t\t<p>$json_data->overview</p>\n";
        echo "\t\t\t\t\t<p> Genres :";
            foreach ($json_data->genres as $genre) {
                echo $genre->name." - ";
            }
        echo "\t\t\t\t\t</p>\n";
        echo "\t\t\t\t\t<p> Date de sortie : $json_data->release_date</p>\n";
        getProviders();
        echo "\t\t\t\t</div>\n";
        echo"\t\t\t</article>\n";
        echo"\t\t\t<h2>Bande annonce</h2>\n";
        echo "\t\t\t<article class=\"bande_annonce\">\n";
        $id = $json_data->id;
        getBandeAnnonceMovie($id);
        echo "\t\t\t</article>\n";
        echo"\t\t\t<h2>Titres similaires</h2>\n";
        echo "\t\t\t<article class=\"similaires\">\n";
        getFilmsSimilaires($url);
        echo "\t\t\t</article>\n";
        echo"\t\t</section>\n";

        readStatistics($json_data->id,$json_data->title,"movie");

        
    }

    function data_serie_details($url){
        $json = file_get_contents($url);
        $json_data = json_decode($json);
        
        echo "\t\t<section><h1>$json_data->name<h1>\n";
        echo"\t\t\t<h2>Informations générales</h2>\n";
        echo"\t\t\t<article class=\"infos_films\">\n";
        echo"\t\t\t\t<div class=\"affiche\">\n";
        echo"\t\t\t\t\t<figure>\n";
        if($json_data->poster_path!=null){
            echo "\t\t\t\t\t\t<img src ='https://image.tmdb.org/t/p/w185".$json_data->poster_path."' alt= 'Affiche de ".$json_data->name."'>\n";
        }else{
            echo "\t\t\t\t\t\t<img src ='./images/noimage.jpg' alt= 'Affiche de ".$json_data->results->original_name."'/>\n";
        } 
        echo "\t\t\t\t\t</figure>\n";
        echo"\t\t\t\t</div>\n";
        echo "\t\t\t\t<div class=\"infos_texte\">\n";
        echo "\t\t\t\t\t<p>$json_data->overview</p>\n";
        echo "\t\t\t\t\t<p> Genres :";
            foreach ($json_data->genres as $genre) {
                echo $genre->name." - ";
            }
        echo "\t\t\t\t\t</p>\n";
        echo "\t\t\t\t\t<p> Date de sortie : $json_data->first_air_date</p>\n";

        getProviders();
        echo "\t\t\t\t</div>\n";
        echo"\t\t\t</article>\n";
        
        echo"\t\t\t<h2>Bande annonce</h2>\n";
        echo "\t\t\t<article class=\"bande_annonce\">\n";
         $id = $json_data->id;
        getBandeAnnonceSerie($id);
        
        echo "\t\t\t</article>\n";
        echo"\t\t\t<h2>Titres similaires</h2>\n";
        echo "\t\t\t<article class=\"similaires\">\n";
        getSeriesSimilaires($url);
        echo "\t\t\t</article>\n";
        
        echo"\t\t</section>\n";

        readStatistics($json_data->id,$json_data->original_name,"serie");
        
    }


    function getFilmsSimilaires($url){

        $json = file_get_contents($url);
        $json_data = json_decode($json);
        $json = file_get_contents("https://api.themoviedb.org/3/movie/$json_data->id/recommendations?api_key=703c9852d7e1fbcb765e969ee6969267&language=fr-FR&page=1&with_genres");
        $json_data = json_decode($json);
        foreach ($json_data->results as $results) {
            echo "\t\t\t\t<div class=\"film_suggestion\">\n";
            echo "\t\t\t\t\t<a href ='infos_film.php?id=".$results->id."'/>\n";
            if($results->poster_path!=null){
                 echo "\t\t\t\t\t<img src ='https://image.tmdb.org/t/p/w185".$results->poster_path."' alt= 'Affiche de ".$results->title."'>\n";
            }else{
                echo "<img src ='./images/noimage.jpg' alt= 'Affiche de ".$json_data->results->original_name."'/>\n";
            }  
            echo "\t\t\t\t\t<h3>".$results->title."</h3>\n";
            echo "\t\t\t\t\t</a>\n";
            echo "\t\t\t\t</div>\n";
        }
    }

    function getSeriesSimilaires($url){

        $json = file_get_contents($url);
        $json_data = json_decode($json);
        $json = file_get_contents("https://api.themoviedb.org/3/tv/$json_data->id/recommendations?api_key=703c9852d7e1fbcb765e969ee6969267&language=fr-FR&page=1");
        $json_data = json_decode($json);
        foreach ($json_data->results as $results) {
            echo "\t\t\t\t<div class=\"film_suggestion\">\n";
            echo "\t\t\t\t\t<a href ='infos_serie.php?id=".$results->id."'/>\n";
            if($results->poster_path!=null){
                echo "\t\t\t\t\t<img src ='https://image.tmdb.org/t/p/w185".$results->poster_path."' alt= 'Affiche de ".$results->name."'>\n";
            }else{
                echo "<img src ='./images/noimage.jpg' alt= 'Affiche de ".$json_data->results->original_name."'/>\n";
            }
            echo "\t\t\t\t\t<h3>".$results->name."</h3>\n";
            echo "\t\t\t\t\t</a>\n";
            echo "\t\t\t\t</div>\n";
        }
    }

    function getFilmsGenre($nbFilms){
        
        $json_list = file_get_contents("https://api.themoviedb.org/3/genre/movie/list?api_key=ceb1c71467bda2e8ea5a2fa127f7e68b&language=fr-FR");
        $json_list_data = json_decode($json_list);

        foreach($json_list_data->genres as $genres){
            $json = file_get_contents("https://api.themoviedb.org/3/discover/movie?api_key=ceb1c71467bda2e8ea5a2fa127f7e68b&language=fr-FR&region=FR&sort_by=popularity.desc&include_adult=false&include_video=false&page=1&with_genres=$genres->id");
            $json_data = json_decode($json);
            
            echo"<h3 class=\"nom_genre\">".$genres->name."</h3>";
            echo"<article class='scroll-bar'>";
            for($i = 0 ; $i < $nbFilms ; $i++ ){
                echo "<div onclick='infos_film.php?id=".$json_data->results[$i]->original_title."'>\n";
                echo "<a href ='infos_film.php?id=".$json_data->results[$i]->id."'>\n";
                if($json_data->results[$i]->poster_path!=null){
                   echo "<img src ='https://image.tmdb.org/t/p/w185".$json_data->results[$i]->poster_path."' alt= 'Affiche de ".$json_data->results[$i]->title."'/>\n";
                }else{
                    echo "<img src ='./images/noimage.jpg' alt= 'Affiche de ".$json_data->results->original_name."'/>\n";
                }  
                echo "<h3>".$json_data->results[$i]->original_title."</h3>\n";
                echo "</a>\n";
                echo "</div>\n";
            } 
            echo"</article>";

        }
    }

    function getSeriesGenre($nbSeries){
        $json_list = file_get_contents("https://api.themoviedb.org/3/genre/tv/list?api_key=ceb1c71467bda2e8ea5a2fa127f7e68b&language=fr-FR");
        $json_list_data = json_decode($json_list);

        foreach($json_list_data->genres as $genres){
            $json = file_get_contents("https://api.themoviedb.org/3/discover/tv?api_key=ceb1c71467bda2e8ea5a2fa127f7e68b&language=fr-FR&region=FR&sort_by=popularity.desc&include_adult=false&include_video=false&page=1&with_genres=$genres->id");
            $json_data = json_decode($json);

            echo"<h3 class=\"nom_genre\">".$genres->name."</h3>";
            echo"<article class='scroll-bar'>";
            for($i = 0 ; $i < $nbSeries ; $i++ ){
                echo "<div onclick='infos_serie.php?id=".$json_data->results[$i]->original_name."'>\n";
                echo "<a href ='infos_serie.php?id=".$json_data->results[$i]->id."'>\n";
                if($json_data->results[$i]->poster_path!=null){
                    echo "<img src ='https://image.tmdb.org/t/p/w185".$json_data->results[$i]->poster_path."' alt= 'Affiche de ".$json_data->results[$i]->name."'/>\n";
                }else{
                    echo "<img src ='./images/noimage.jpg' alt= 'Affiche de ".$json_data->results->original_name."'/>\n";
                }  
                echo "<h3>".$json_data->results[$i]->original_name."</h3>\n";
                echo "</a>\n";
                echo "</div>\n";
            } 
            echo"</article>";
        }
    }

    function getBandeAnnonceMovie($id){
        $url = "http://api.themoviedb.org/3/movie/$id/videos?api_key=ceb1c71467bda2e8ea5a2fa127f7e68b&language=FR";
        $json = file_get_contents($url);
        $json_data = json_decode($json);
        $video = $json_data->results[0];
        if($video==null){
            $url = "http://api.themoviedb.org/3/movie/$id/videos?api_key=ceb1c71467bda2e8ea5a2fa127f7e68b";
            $json = file_get_contents($url);
            $json_data = json_decode($json);
            $video = $json_data->results[0];
            $trailerid = $video->key;
            if($video==null){
                echo "<p class=\"information-utilisateur\">Bande annonce non disponible</p>";
            }else{
                echo "\t\t\t\t<iframe width='420' height='315' src='https://www.youtube.com/embed/".$trailerid."'> </iframe>\n";
            }
        }else{
            $trailerid = $video->key;
            echo "\t\t\t\t<iframe width='420' height='315' src='https://www.youtube.com/embed/".$trailerid."'> </iframe>\n";
        }
       
    }
    

    function getBandeAnnonceSerie($id){
        $url = "http://api.themoviedb.org/3/tv/$id/videos?api_key=ceb1c71467bda2e8ea5a2fa127f7e68b&language=FR";
        $json = file_get_contents($url);
        $json_data = json_decode($json);
        $video = $json_data->results[0];
        if($video==null){
            $url = "http://api.themoviedb.org/3/tv/$id/videos?api_key=ceb1c71467bda2e8ea5a2fa127f7e68b";
            $json = file_get_contents($url);
            $json_data = json_decode($json);
            $video = $json_data->results[0];
            $trailerid = $video->key;
            if($video==null){
                echo "<p class=\"information-utilisateur\">Bande annonce non disponible</p>";
            }else{
                echo "\t\t\t\t<iframe width='420' height='315' src='https://www.youtube.com/embed/".$trailerid."'> </iframe>\n";
            }
        }else{
            $trailerid = $video->key;
            echo "\t\t\t\t<iframe width='420' height='315' src='https://www.youtube.com/embed/".$trailerid."'> </iframe>\n";
        }
       
    }

    function recherche_film($name_search) {

        $tabNom = $name_search;
        $nomFinal;

        for($i = 0; $i< strlen($name_search);$i++){
           if($tabNom[$i]!=" "){
                $nomFinal.="$tabNom[$i]";
            }else if($tabNom[$i]==" "){
                $nomFinal.="%";
                $nomFinal.="2B";
            }
        }
        $json = file_get_contents("https://api.themoviedb.org/3/search/multi?query=$nomFinal&api_key=ceb1c71467bda2e8ea5a2fa127f7e68b&language=fr-FR&page=1");
        
        $json_data = json_decode($json);
        foreach($json_data->results as $results){
            
            if($results->media_type=="tv"){
                echo "<a href ='infos_serie.php?id=".$results->id."'/>\n";
            }else if($results->media_type=="movie"){
                echo "<a href ='infos_film.php?id=".$results->id."'/>\n";
            }
            echo "<article class ='resultat' id= '".$results->id."'>\n";
            echo "<div class ='resultat-affiche'>";
            echo"\t\t\t<figure>\n";
            if($results->poster_path!=null){
                echo "<img src ='https://image.tmdb.org/t/p/w185".$results->poster_path."' alt= 'Affiche de ".$results->title."'/>\n";
            }else{
                 echo "<img src ='./images/noimage.jpg' alt= 'Affiche de ".$results->title."'/>\n";
            }
            
            echo "\t\t\t</figure>\n";
            echo"\t\t</div>\n";
            echo "<div class ='resultat-description'>";
            if($results->media_type=="tv"){
                echo "\t <p class='titre'>".$results->original_name."</p>\n";
            }else if($results->media_type=="movie"){
                echo "\t <p class='titre'>".$results->original_title."</p>\n";
            }
            echo "\t <p>".$results->overview."</p>\n";
            echo "\t <p>Note moyenne : $results->vote_average /10</p>\n";
            echo "</div>";
            echo "</article>\n";
            echo "</a>";
        }
    }

    function afficheDerniereConsultation(){
        if(isset($_COOKIE["lastFilm"])){
            if($_COOKIE["type"]=="movie"){
                afficheDernierFilm();
            }else{
                afficheDerniereSerie();
            }
        }
    }
    
    function afficheDernierFilm(){
        $id_film = $_COOKIE["lastFilm"];
        $date_visit = $_COOKIE['date_visited'];

        $url = "https://api.themoviedb.org/3/movie/$id_film?api_key=ceb1c71467bda2e8ea5a2fa127f7e68b&language=FR";
        $json = file_get_contents($url);
        $json_data = json_decode($json);

        echo"<article class=\"last_seen\">";
        echo"\t\t\t\t<div class=\"affiche_last_seen\">\n";
        echo"\t\t\t\t\t<figure>\n";
        echo "\t\t\t\t\t<a href ='infos_film.php?id=".$json_data->id."'/>\n";
        if($json_data->poster_path!=null){
            echo "\t\t\t\t\t\t<img src ='https://image.tmdb.org/t/p/w185".$json_data->poster_path."' alt= 'Affiche de ".$json_data->title."'></img>\n";
        }else{
            echo "\t\t\t\t\t\t<img src ='./images/noimage.jpg' alt= 'Affiche de ".$json_data->results->original_name."'/></img>\n";
        } 
        echo "\t\t\t\t\t</figure>\n";
        echo"\t\t\t\t</div>\n";
        echo"\t\t\t\t<div class=\"infos_last_seen\">\n";
        echo "\t\t\t\t\t<h3>Dernière consultation</h3>\n";
        echo "\t\t\t\t\t<p style=\"color:firebrick;\">$json_data->title</p>\n";
        echo "\t\t\t\t\t<p>Consulté le : ".$date_visit."</p>\n";
        echo "\t\t\t\t\t</a>\n";
        echo"\t\t\t\t</div>\n";
        echo"</article>";
    }

     function afficheDerniereSerie(){
        $id_serie = $_COOKIE["lastFilm"];
        $date_visit = $_COOKIE['date_visited'];

        $url = "https://api.themoviedb.org/3/tv/$id_serie?api_key=ceb1c71467bda2e8ea5a2fa127f7e68b&language=FR";
        $json = file_get_contents($url);
        $json_data = json_decode($json);

        echo"<article class=\"last_seen\">";
        echo"\t\t\t\t<div class=\"affiche_last_seen\">\n";
        echo"\t\t\t\t\t<figure>\n";
        echo "\t\t\t\t\t<a href ='infos_serie.php?id=".$json_data->id."'/>\n";
       if($json_data->poster_path!=null){
            echo "\t\t\t\t\t\t<img src ='https://image.tmdb.org/t/p/w185".$json_data->poster_path."' alt= 'Affiche de ".$json_data->name."'></img>\n";
        }else{
            echo "\t\t\t\t\t\t<img src ='./images/noimage.jpg' alt= 'Affiche de ".$json_data->results->original_name."'/></img>\n";
        } 
        echo "\t\t\t\t\t</figure>\n";
        echo"\t\t\t\t</div>\n";
        echo"\t\t\t\t<div class=\"infos_last_seen\">\n";
        echo "\t\t\t\t\t<h3>Dernière consultation</h3>\n";
        echo "\t\t\t\t\t<p style=\"color:firebrick;\">$json_data->name</p>\n";
        echo "\t\t\t\t\t<p>Consulté le : ".$date_visit."</p>\n";
        echo "\t\t\t\t\t</a>\n";
        echo"\t\t\t\t</div>\n";
        echo"</article>";
    }


    function getProviders(){

        if (isset($_GET['id']) && (!empty($_GET['id']))){
            
            $id = $_GET['id'];
            if($_GET["type"] == "serie"){
                $json = file_get_contents("https://api.themoviedb.org/3/tv/$id/watch/providers?api_key=703c9852d7e1fbcb765e969ee6969267");
            }else{
                $json = file_get_contents("https://api.themoviedb.org/3/movie/$id/watch/providers?api_key=703c9852d7e1fbcb765e969ee6969267");
            } 
                $json_data = json_decode($json);
                if($json_data->results->FR->flatrate!=null){
                    echo"\t\t\t\t<div class=\"affiche-providers\">\n";
                    foreach ($json_data->results->FR->flatrate as $flatrate) {
                        echo "\t\t\t\t\t\t<img src ='https://image.tmdb.org/t/p/w185".$flatrate->logo_path."' alt= 'Affiche de ".$flatrate->provider_name."'>\n";
                    
                    }
                echo"\t\t\t\t</div>\n";
                }else{
                    echo "<p>Ce titre n'est actuellement disponible sur aucune plateforme de streaming</p>";
                }      
        }       
    }

     
    function readStatistics(string $id, string $name, string $type): int{

        $tempFile = fopen("./temp_statistics.csv","w");
        $count = 1;

        if (($handle = fopen("./statistics.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
                if ($data[0] == $id && $data[2] == $type) {
                    $count = $data[3] + 1;
                    fputcsv($tempFile,[$data[0], $data[1], $data[2], $count], ";");
                } else {
                    fputcsv($tempFile, $data, ";");
                }
            }
            if ($count == 1) fputcsv($tempFile,[$id, $name, $type, 1], ";");

            fclose($tempFile);
            fclose($handle);

            unlink("./statistics.csv");
            rename("./temp_statistics.csv","./statistics.csv");
        }

        return $count;
    }

    function getVisits(): array {
        $array = [];
        if (($handle = fopen("./statistics.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
                array_push($array, $data);
            }

            fclose($handle);
        }

        return $array;
    }

    function json($url){
      $json = file_get_contents($url);
      $obj = json_decode($json);
      $src = $obj->url;
      $date = $obj->date;
      $titre = $obj->title;
      echo "<figure>\n";
      echo "<img src=\"".$src."\" alt=\"".$titre."\"/>";
      echo "<figcaption> Image du jour : .$titre.</figcaption>";
      echo "</figure>";
    }
?>