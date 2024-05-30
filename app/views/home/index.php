<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Bem-vindo ao Home!</h1>

    <p>Nome: <?php echo $nome; ?></p>
    <p>Idade: <?php echo $idade; ?></p>

    <img src="<?php echo asset('images/images.jpg'); ?>" alt="Logo">
</body>
</html>
