<!-- Parts of code are copyrighted 2020 Mert Cukuren. Code released under the MIT license. See ThirdParty/Licenses/Tailblocks -->

<?php

use \App\Core\View;
?>

<!-- Content -->
<section class="text-gray-400 body-font bg-gray-900">
    <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-wrap w-full mb-20 flex-col gap-3">
            <!-- User -->
            <?php
            for ($i = 0; $i < 10; ++$i) {
                echo View::component("User/IndexRow", [
                    "id" => $i,
                    "name" => "User $i",
                    "isAdmin" => $i % 2 === 0
                ]);
            }
            ?>
        </div>
    </div>
</section>