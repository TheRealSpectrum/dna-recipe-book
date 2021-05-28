<?php

declare(strict_types=1);

use App\Core\View;

?>

<!-- Parts of code are copyrighted 2020 Mert Cukuren. Code released under the MIT license. See ThirdParty/Licenses/Tailblocks -->
<!-- Content -->
<section class="flex-grow text-gray-400 body-font bg-gray-900 min-h-full">
  <a href="/recipes">
    <p class="container px-5 pt-5 text-xl mx-auto">Back to recipes without saving</p>
  </a>

  <?= View::component("Recipe/EditRow", [
    "recipe" => $recipe,
    "authors" => $authors,
    "categories" => $categories,
    "recipe_categories" => $recipe_categories
  ]) ?>

  <?= View::component("Ingredient/CreateRow", [
    "ingredients" => $ingredients
  ]) ?>

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