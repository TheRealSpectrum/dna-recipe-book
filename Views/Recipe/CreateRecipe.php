<?php

use App\Core\View;

?>
<!-- Parts of code are copyrighted 2020 Mert Cukuren. Code released under the MIT license. See ThirdParty/Licenses/Tailblocks -->

<!-- Content -->
<section class="flex-grow text-gray-400 body-font bg-gray-900">
    <a href="/recipes">
        <p class="container px-5 pt-5 text-xl mx-auto">Back to recipes without saving</p>
    </a>
    <?= View::component("Recipe/CreateRow", [
      "authors" => $authors,
      "categories" => $categories
    ]) ?>
</section>