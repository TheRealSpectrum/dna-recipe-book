<!-- Parts of code are copyrighted 2020 Mert Cukuren. Code released under the MIT license. See ThirdParty/Licenses/Tailblocks -->

<?php

use \App\Core\View;
?>

<!-- Content -->
<section class="text-gray-400 body-font bg-gray-900">
    <a href="/users/create">
        <p class="container px-5 pt-5 text-xl mx-auto">Create new user</p>
    </a>
    <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-wrap w-full mb-20 flex-col gap-3">
            <!-- User -->
            <?php
            foreach ($users as $user) {
                echo View::component("User/IndexRow", [
                    "user" => $user
                ]);
            }
            ?>
        </div>
    </div>
</section>