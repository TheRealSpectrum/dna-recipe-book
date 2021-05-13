<div>
    <div class="level"> <?php echo $level; ?> </div>
    <div class="message"> <?php echo $message; ?> </div>
    <?php
    if (isset($file)) {
    ?>
        <div class="file"> <?php echo $fileAndNumber; ?> </div>
    <?php
    } else {
    ?>
        <div class="file"> unknown source </div>
    <?php
    }
    ?>
</div>