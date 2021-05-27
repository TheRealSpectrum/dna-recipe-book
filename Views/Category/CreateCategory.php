<?php

declare(strict_types=1);

use \App\Core\View;

?>

<section class="text-gray-400 body-font bg-gray-900">
    <a href="/categories">
        <p class="container px-5 pt-5 text-xl mx-auto">Back to categories</p>
    </a>
    <form class="container px-5 pt-24 pb-5 mx-auto" method="POST" action="/categories">
        <div class="flex w-full mb-20 flex-col gap-3">

            <div class="bg-gray-800 bg-opacity-40 rounded-lg px-6 h-9">
                <div class="grid grid-rows-1 grid-cols-4 justify-center items-center gap-3 h-full">
                    <span class="col-span-1 border-gray-200 border-r align-middle">Title</span>
                    <input type="text" name="title" class="col-span-3 align-middle"><?= $category->title ?></input>
                </div>
            </div>

            <div class="bg-gray-800 bg-opacity-40 rounded-lg px-6 h-60">
                <div class="grid grid-rows-1 grid-cols-4 justify-center items-center gap-3 h-full">
                    <span class="col-span-1 border-gray-200 border-r align-middle h-full">Description</span>
                    <textarea name="description" class="col-span-3 align-middle h-full"><?= $category->description ?></textarea>
                </div>
            </div>

            <div>
                <button type="submit" class="bg-yellow-800 bg-opacity-40 rounded-lg px-6 h-6"> Create category </button>
            </div>
        </div>
    </form>
</section>