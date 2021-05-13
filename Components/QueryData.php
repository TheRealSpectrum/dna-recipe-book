<div class="query-data">
    <div class="expand">&rangle;&rangle;&rangle;</div>
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