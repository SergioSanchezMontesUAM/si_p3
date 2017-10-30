<?php

    
        $path = getcwd() . "/usuarios/laura";
        $history = simplexml_load_file($path . "/historial.xml");

        $pelicula = $history->addChild('pelicula');
        $pelicula->addChild('id', 'id2');
        $pelicula->addChild('titulo', 'Titulo2');
        $pelicula->addChild('poster', 'poster2');
        $pelicula->addChild('sinopsis', 'Sinopsis2');
        $pelicula->addChild('categoria', 'Categoria2');
        $pelicula->addChild('sinopsis', 'Sinopsis2');
        $pelicula->addChild('anno', '2018');
        $pelicula->addChild('pais', 'EEUU');
        
        $actores = $pelicula->addChild('actores');
        $actor = $actores->addChild('actor');
        $actor->addChild('nombre', 'Actor2');
        $actor->addChild('personaje', 'Personaje2');
        $actor->addChild('foto', 'foto2');
        
        
        
        $history->saveXML($path . "/historial.xml");
        
?>