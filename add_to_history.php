<?php

        session_start();

        if(isset($_SESSION['username']) && isset($_COOKIE['cart_items_cookie'])){
            
        
                $path = getcwd() . "/usuarios/" . $_SESSION['username'];
                $history = simplexml_load_file($path . "/historial.xml");
                
                $array = json_decode($_COOKIE['cart_items_cookie']);
                
                $total_price = 0;
                	
                //Añadimos las peliculas compradas al historial	
                foreach ($array as $key => $movie_id) {
                        $catalogo = simplexml_load_file('catalogo.xml');
                
                	$movies = $catalogo->xpath("/catalogo/pelicula[id=\"" . $movie_id . "\"]");
                	    
                	foreach($movies as $movie){
                	        
                		$pelicula = $history->addChild('pelicula');
                                $pelicula->addChild('id', $movie->id);
                                $pelicula->addChild('titulo', $movie->titulo);
                                $pelicula->addChild('poster', $movie->poster);
                                $pelicula->addChild('sinopsis', $movie->sinopsis);
                                $pelicula->addChild('director', $movie->director);
                                $pelicula->addChild('precio', $movie->precio);
                                $pelicula->addChild('categoria', $movie->categoria);
                                $pelicula->addChild('anno', $movie->anno);
                                $pelicula->addChild('pais', $movie->pais);
                                
                                $actores = $pelicula->addChild('actores');
                                $actors = $pelicula->actores;
                                foreach($actors->actor as $a){
                                        $actor = $actores->addChild('actor');
                                        $actor->addChild('nombre', $a->nombre);
                                        $actor->addChild('personaje', $a->personaje);
                                        $actor->addChild('foto', $a->foto);
                                }
                
                                $history->saveXML($path . "/historial.xml");
                                
                                $total_price += floatval($movie->precio);
                	}
                }
                
                //Añadimos al final del fichero de datos del usuario su nuevo saldo
                $dat_file = fopen("usuarios/" . $_SESSION['username'] . "/datos.dat", "r+");
	        $i = 0;
	        while(($line = fgets($dat_file)) !== false){

	        	//Última línea del fichero (saldo actual)
	        	if((feof($dat_file))){
	        	        fwrite($dat_file, "\n" . ($line - $total_price));
	        	}
	        	
	        	$i++;
	        }
                
                
                //Eliminamos la cookie para vaciar el carrito
                //unset($_COOKIE['cart_items_cookie']);
                //setcookie('cart_items_cookie', '', time() - 3600, '/'); 
            
                //header('Location: cart.php');
        
        }
        
?>