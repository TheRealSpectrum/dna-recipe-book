<li>
    <div class="debug-level"> <?php echo $level; ?> </div>
    <div class="debug-message"> <?php echo $message; ?> </div>
    <?php
    if (isset($file)) {
    ?>
        <div class="debug-file"> <?php echo $fileAndNumber; ?> </div>
    <?php
    } else {
    ?>
        <div class="debug-file"> unknown source </div>
    <?php
    }
    ?>
</li>