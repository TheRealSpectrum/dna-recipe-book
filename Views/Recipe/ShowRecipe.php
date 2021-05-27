<?php

use App\Core\View;
?>
<!-- Parts of code are copyrighted 2020 Mert Cukuren. Code released under the MIT license. See ThirdParty/Licenses/Tailblocks -->

<!-- Content -->
<section class="text-gray-400 bg-gray-900 body-font">
  <div class="container px-5 py-24 mx-auto flex flex-col">
    <?= View::component("Recipe/ShowRow", [
      "title" => $recipe->title,
      "description" => $recipe->description,
      "author" => $recipe->author(),
      "preparationTime" => $recipe->preparation_time,
      "cookingTime" => $recipe->cooking_time,
      "numServings" => $recipe->num_servings,
      "steps" => $recipe->steps(),
      "ingredients" => $recipe->ingredients(),
    ])?>
  </div>
</section>