<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">

    <title>oops !</title>

    <style type="text/css">
        <?= preg_replace('#[\r\n\t ]+#', ' ', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'debug.css')) ?>
    </style>
</head>
<body>

<div class="container text-center">

    <h1 class="headline">oops!</h1>

    <p class="lead">Il semblerait qu'un problème soit survenu ! Réessayez plus tard...</p>

</div>

</body>

</html>
