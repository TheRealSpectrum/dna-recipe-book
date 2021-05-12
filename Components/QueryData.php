<div class="query-data">
    <?php
    foreach ($data as $key => $value) {
    ?>
        <div>
            <div class="key"><?= $key ?></div>
            <div class="value"><?= $value ?></div>
        </div>
    <?php
    }
    ?>
</div>