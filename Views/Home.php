<?php

declare(strict_types=1);

use \App\Core\View;

?>
<!-- Parts of code are copyrighted 2020 Mert Cukuren. Code released under the MIT license. See ThirdParty/Licenses/Tailblocks -->

<!-- Content -->
<section class="text-gray-400 bg-gray-900 body-font min-h-full">
    <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-wrap -m-4">
            <?php
            foreach ($recipes as $recipe) {
                echo View::component("Home/Recipe", [
                    "recipe" => $recipe,
                ]);
            }
            ?>
        </div>
    </div>
</section>