<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
</head>

<body>
    <h1>Welcome to the About Page!</h1>
    <p><?= isset($_SESSION['csrf_token']) ? $_SESSION['csrf_token'] : ''; ?></p>
    <a href="<?= base_url(''); ?>">asd</a>
</body>

</html>