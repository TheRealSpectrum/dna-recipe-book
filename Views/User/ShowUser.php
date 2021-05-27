<?php

declare(strict_types=1);

use \App\Core\View;

?>

<section class="text-gray-400 body-font bg-gray-900">
    <div class="container px-5 py-24 mx-auto">
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
</section>