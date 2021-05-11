<?php

use \App\Route;

Route::list([
    Route::post('recipes/:a', function ($parameters) {
        echo $parameters["a"];
    }),
    Route::get('recipes/:a', function ($parameters) {
?>
    <form action="/recipes/<?= $parameters["a"] ?>" method="post">
        <button type="submit">hey</button>
    </form>
<?php
    }),
]);
