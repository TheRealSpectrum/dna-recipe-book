<?php

declare(strict_types=1);

use App\Core\View;

?>

<!-- Parts of code are copyrighted 2020 Mert Cukuren. Code released under the MIT license. See ThirdParty/Licenses/Tailblocks -->
<!-- Content -->
<section class="flex-grow text-gray-400 body-font bg-gray-900">
  <a href="/recipes">
    <p class="container px-5 pt-5 text-xl mx-auto">Back to recipes without saving</p>
  </a>
  <?php
    echo View::component("Recipe/EditRow", [
      "recipe" => $recipe,
      "authors" => $authors,
      "categories" => $categories,
      "recipe_categories" => $recipe_categories
    ]);
  ?>
  <form class="mx-auto w-full max-w-lg my-4" method="POST" action="/ingredients">
    <div class="flex flex-wrap -mx-3 mb-2">
      <div class="w-full md:w-1/2 px-3  md:mb-0">
        <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2" for="ingredient_title">Ingredient name</label>
        <input type="text" name="recipe_id" value="<?= $ingredients[0]->recipe_id ?>" hidden>
        <input class="block w-full bg-gray-200 text-gray-700 border rounded py-2 px-2  leading-tight text-sm focus:outline-none focus:bg-white" type="text" name="ingredient_title">
      </div>
      <div class="w-full md:w-1/2 px-3 mb-2 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2" for="ingredient_title">Ingredient Quantity</label>
        <input class="block w-full bg-gray-200 text-gray-700 border rounded py-2 px-2  leading-tight text-sm focus:outline-none focus:bg-white" type="text" name="ingredient_quantity">
      </div>
      <div class="px-4 py-3  text-right">
        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          Add ingredient
        </button>
      </div>
    </div>
  </form>
  <div class="mx-auto w-full max-w-2xl my-4">
    <div class="flex flex-wrap -mx-3 mb-2">
      <?php
      foreach ($ingredients as $ingredient) {
        echo View::component("Ingredient/IndexRow", [
          "ingredient" => $ingredient
        ]);
      }
      ?>
    </div>
  </div>
</section>