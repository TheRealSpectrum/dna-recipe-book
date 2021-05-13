<?php

declare(strict_types=1);

use \App\Core\View;

?>
<div>
    <div class="sql-query">
        <code>
            <?= $query ?>
        </code>
        <div class="count">Num = <?= count($result) ?></div>
        <div class="expand">+</div>
    </div>
    <div class="sql-result">
        <?php

        foreach ($result as $data) {
            echo View::component("QueryData", ["data" => $data]);
        }

        ?>
    </div>
</div>