<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $cat ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/tambahan.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/scrolltop.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/DataTables/datatables.min.css') ?>">
</head>

<body>
    <div class="sidebar">
        <div class="menu">
            <div class="title-menu text-center">
                <h3>Menu</h3>
            </div>
            <a href="#" class="link-sidebar"></a>
            <a href="#" class="link-sidebar"></a>
            <a href="#" class="link-sidebar"></a>
            <a href="#" class="link-sidebar"></a>
            <a href="#" class="link-sidebar"></a>
        </div>
    </div>
    <header class="bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="#" class="btn btn-gold mr-4" onclick="sidebar()"><i class="fas fa-bars"></i></a>
                    <h3 class="mt-2 title-cat gold" style="display: inline-block;"><?= $cat . ' - ' . $user ?></h3>
                </div>
            </div>
        </div>
    </header>