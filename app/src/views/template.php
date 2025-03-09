<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>MVC PHP</title>
    <link rel="shortcut icon" href="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <?php include "cabecalho.php" ?>
    <?php include "menu.php" ?>
    <?php $this->loadView($view, $viewData); ?>
    <?php include "rodape.php" ?>
</body>

</html>