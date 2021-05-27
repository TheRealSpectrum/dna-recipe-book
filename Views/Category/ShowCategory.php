<?php

declare(strict_types=1);

use \App\Core\View;

?>

<section class="text-gray-400 body-font bg-gray-900">
    <a href="/categories">
        <p class="container px-5 pt-5 text-xl mx-auto">Back to categories</p>
    </a>
    <div class="container px-5 pt-24 pb-5 mx-auto">
        <div class="flex w-full mb-20 flex-col gap-3">

            <div class="bg-gray-800 bg-opacity-40 rounded-lg px-6 h-9">
                <div class="grid grid-rows-1 grid-cols-4 justify-center items-center gap-3 h-full">
                    <span class="col-span-1 border-gray-200 border-r align-middle">Title</span>
                    <span class="col-span-3 align-middle"><?= $category->title ?></span>
                </div>
            </div>

            <div class="bg-gray-800 bg-opacity-40 rounded-lg px-6 h-60">
                <div class="grid grid-rows-1 grid-cols-4 justify-center items-center gap-3 h-full">
                    <span class="col-span-1 border-gray-200 border-r align-middle h-full">Description</span>
                    <span class="col-span-3 align-middle h-full"><?= $category->description ?></span>
                </div>
            </div>

        </div>
    </div>
    <h2 class="container px-5 pt-5 text-3xl mx-auto">Recipes</h2>
    <div class="container px-5 pt-5 pb-24 mx-auto flex flex-col gap-3">
        <?php
        foreach ($category->recipes() as $recipe) {
            echo View::component("User/ShowRecipe", [
                "recipe" => $recipe,
            ]);
        }
        ?>
    </div>
</section>