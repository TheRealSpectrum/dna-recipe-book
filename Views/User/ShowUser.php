<?php

declare(strict_types=1);

use \App\Core\View;

?>

<section class="text-gray-400 body-font bg-gray-900 min-h-full">
    <a href="/users">
        <p class="container px-5 pt-5 text-xl mx-auto">Back to users</p>
    </a>
    <div class="container px-5 pt-24 pb-5 mx-auto">
        <div class="flex w-full mb-20 flex-col gap-3">
            <?= View::component("User/ShowRow", [
                "label" => "Name",
                "content" => $user->name,
            ]) ?>

            <?= View::component("User/ShowRow", [
                "label" => "Type",
                "content" => $user->isAdmin ? "Admin" : "User",
            ]) ?>

        </div>
    </div>
    <h2 class="container px-5 pt-5 text-3xl mx-auto">Recipes</h2>
    <div class="container px-5 pt-5 pb-24 mx-auto">
        <?php
        foreach ($user->recipes() as $recipe) {
            echo View::component("User/ShowRecipe", [
                "recipe" => $recipe,
            ]);
        }
        ?>
    </div>
</section>