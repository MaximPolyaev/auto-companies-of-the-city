<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?= $this->getMeta(); ?>
</head>
<body>
<h1>Enterprices - layout</h1>
<?= $content ?>

<?php
$logs = \RedBeanPHP\R::getDatabaseAdapter()
    ->getDatabase()
    ->getLogger();

if(!empty($logs->grep('SELECT'))) {
    debug($logs->grep('SELECT'));
}
?>

</body>
</html>