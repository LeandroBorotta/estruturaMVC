<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <?php renderComponent("header"); ?>

    <img src="data:image/png;base64,<?= $pix["img_qrcode"] ?>" width="200" alt=""><br>

    <a href="<?= $pix["external_link"] ?>">Teste</a><br>

    <textarea name="" id=""><?= $pix["copy"] ?></textarea><br>
    <img src="<?= asset('images/images.jpg') ?>" alt="Logo">

</body>

</html>