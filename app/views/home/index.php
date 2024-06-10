<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <?php renderComponent("header"); ?>

    <h1>Lista de Usuários</h1>
    <?php if (!empty($users)) : ?>
        <ul>
            <?php foreach ($users[0] as $user) : ?>
                <li>ID: <?= $user['id']; ?> - Nome: <?= $user['nome']; ?> - Email: <?= $user['email']; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>Nenhum usuário encontrado.</p>
    <?php endif; ?>


    <div>
        <?= $paginate->links(""); ?>
    </div>


    <img src="<?php echo asset('images/images.jpg'); ?>" alt="Logo">
</body>

</html>