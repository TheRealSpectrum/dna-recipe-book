<?php

declare(strict_types=1);

use \App\Core\View;

?>
<div>
    <code class="sql-query">
        <?= $query ?>
    </code>
    <div class="sql-result">
        <?php

        foreach ($result as $data) {
            echo View::component("QueryData", ["data" => $data]);
        }

        ?>
    </div>
</div>