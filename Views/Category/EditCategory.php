<?php

declare(strict_types=1);

?>

<section class="text-gray-400 body-font bg-gray-900 min-h-full">
    <a href="/categories">
        <p class="container px-5 pt-5 text-xl mx-auto">Back to categories without saving</p>
    </a>
    <div class="container px-5 pt-24 pb-5 mx-auto">
        <form class="flex w-full mb-20 flex-col gap-3" method="POST" action="/categories/<?= $category->id ?>">
            <input type="hidden" name="_method" value="PATCH">

            <div class="bg-gray-800 bg-opacity-40 rounded-lg px-6 h-9">
                <div class="grid grid-rows-1 grid-cols-4 justify-center items-center gap-3 h-full">
                    <span class="col-span-1 border-gray-200 border-r align-middle">Title</span>
                    <input type="text" name="title" value="<?= $category->title ?>" class="col-span-3 align-middle"></input>
                </div>
            </div>

            <div class="bg-gray-800 bg-opacity-40 rounded-lg px-6 h-60">
                <div class="grid grid-rows-1 grid-cols-4 justify-center items-center gap-3 h-full">
                    <span class="col-span-1 border-gray-200 border-r align-middle h-full">Description</span>
                    <textarea name="description" class="col-span-3 align-middle h-full"><?= $category->description ?></textarea>
                </div>
            </div>

            <div>
                <button type="submit" class="bg-yellow-800 bg-opacity-40 rounded-lg px-6 h-6"> Update category </button>
            </div>
        </form>
    </div>
</section>