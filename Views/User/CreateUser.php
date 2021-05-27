<?php

declare(strict_types=1);

use \App\Core\View;

?>

<section class="text-gray-400 body-font bg-gray-900">
    <div class="container px-5 py-24 mx-auto">
        <form class="flex w-full mb-20 flex-col gap-3" method="POST" action="/users">
            <input type="hidden" name="isAdmin" value="0">
            <?= View::component("User/EditRow", [
                "label" => "Name",
                "type" => "text",
                "name" => "name",
                "inputValue" => "",
                "attribute" => "",
            ]) ?>

            <?= View::component("User/EditRow", [
                "label" => "Admin",
                "type" => "checkbox",
                "name" => "isAdmin",
                "inputValue" => "1",
                "attribute" => "",
            ]) ?>

            <?= View::component("User/EditRow", [
                "label" => "Password",
                "type" => "text",
                "name" => "password",
                "inputValue" => "",
                "attribute" => "",
            ]) ?>

            <div>
                <button type="submit" class="bg-yellow-800 bg-opacity-40 rounded-lg px-6 h-6"> Create user </button>
            </div>

        </form>
    </div>
</section>