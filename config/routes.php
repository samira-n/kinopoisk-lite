<?php

use App\Router\Route;

return[
    Route::get('/kinopoisk-lite/home', function(){
        include_once APP_PATH . "/views/pages/home.php";
    }),
    Route::get('/kinopoisk-lite/movies', function(){
        include_once APP_PATH . "/views/pages/movies.php";
    })
]
?>