<?php

declare(strict_types=1);

use App\Core\View;
?>

<div class="debug-bar">
    <div class="labels">
        <div class="messages">Messages</div>
        <div class="queries">Queries</div>
    </div>
    <div class="content">
        <div class="messages">
            <?php

            foreach ($messages as $message) {
                echo View::component("DebugMessage", $message);
            }

            ?>
        </div>
        <div class="queries">
        </div>
    </div>
</div>