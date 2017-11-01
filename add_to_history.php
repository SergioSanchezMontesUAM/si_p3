<?php

        session_start();

        if(isset($_SESSION['username']) && isset($_COOKIE['cart_items_cookie'])){
            
        
                $path = getcwd() . "/usuarios/" . $_SESSION['username'];
                $history = simplexml_load_file($path . "/historial.xml");
                
                $array = json_decode($_COOKIE['cart_items_cookie']);
                foreach ($array as $key => $movie_id) {
                        $catalogo = simplexml_load_file('catalogo.xml');
                
                	$movies = $catalogo->xpath("/catalogo/pelicula[id=\"" . $movie_id . "\"]");
                	    
                	foreach($movies as $movie){
                	        
                	        echo $movie->id;
                		
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
                                
                	}
                	
                }
                
                //Eliminamos la cookie para vaciar el carrito
                unset($_COOKIE['cart_items_cookie']);
                setcookie('cart_items_cookie', '', time() - 3600, '/'); 
            
                header('Location: cart.php');
        
        }
        
?>