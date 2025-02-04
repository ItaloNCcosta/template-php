<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Template'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body class="">
    <header>
        <?php include dirname(__DIR__, 2) . '/views/_partials/navbar.php'; ?>
    </header>

    <main class="container">
        <?= $content; ?>
    </main>

    <?php include dirname(__DIR__, 2) . '/views/_partials/footer.php'; ?>
</body>

</html>