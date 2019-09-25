<!DOCTYPE html>
<html lang="ru">
<head>
    <base href="<?php echo PATH ?>/">
    <meta charset="utf-8">
    <?= $this->getMeta() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- include favicons -->
    <link rel="shortcut icon" href="img/favicons/favicon.ico">
    
    <!-- include google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&amp;display=swap" rel="stylesheet">
    <!-- include bootstrap styles-->
    <link rel="stylesheet" href="./css/bootstrap.css">
    <!-- include fontawesome styles-->
    <link rel="stylesheet" href="./css/all.css">
    <!-- include jquery ui styles-->
    <link rel="stylesheet" href="./css/jquery-ui.css">
    <!-- include my styles-->
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>

<!-- start wrapper-->
<!--header start-->
<header class="header">
    <div class="container-fluid">
        <div class="row"><a class="header-logo" href="./">Автопредприятие города</a></div>
    </div>
</header>
<!-- header end-->
<!-- aside start-->
<!-- active sidebar add sidebar-open-->
<aside class="sidebar rounded-right">
    <ul class="sidebar-menu">
        <li class="sidebar-menu_header"><i class="fa fa-arrow-right sidebar-menu_header_open"></i><span class="sidebar-menu_header_title">Главная навигация</span><i class="fa fa-times sidebar-menu_header_close"></i></li>
        <?php new \app\widgets\menu\Menu([
                'controller' => $this->controller,
                'view' => $this->view,
                'modificator' => $this->route['modificator'] ?? null
        ]); ?>
    </ul>
</aside>
<div class="content-wrapper">
    <?= $content ?>
</div>
<!-- end wrapper-->

<!-- start modals -->
<?= isset($addModalDriver->html) ? $addModalDriver->html : '' ?>
<?= isset($addModalCar->html) ? $addModalCar->html : '' ?>
<!-- end modals -->

<script>
    const url_path = '<?= PATH ?>';
</script>

<script src="./js/modules.min.js"></script>
<script src="./js/main.min.js"></script>

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