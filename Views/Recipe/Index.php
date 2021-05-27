<!-- Parts of code are copyrighted 2020 Mert Cukuren. Code released under the MIT license. See ThirdParty/Licenses/Tailblocks -->
<?php 

use App\Core\View;

?>

<!-- Content -->
<section class="text-gray-400 bg-gray-900 body-font">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-wrap -m-4">
      <?php foreach($recipes as $recipe) {
      echo View::component("Recipe/IndexRow", [
        "id" => $recipe->id,
        "title" => $recipe->title,
        "description" => $recipe->description,
        "author" => $recipe->author(),
      ]);

      }

      ?>
        
    </div>
  </div>
</section>