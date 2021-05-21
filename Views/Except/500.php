<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internal server error</title>
</head>

<body>
    <h1><?= $httpStatusCode ?></h1>
    <p>Internal server error</p>
    <?php
    if (!empty($message)) {
    ?>
        <p><?= $message ?></p>
    <?php
    }
    ?>

</body>

</html>