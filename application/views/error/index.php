<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Not Found</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/404.css') ?>">
</head>

<body>
    <div class="kotak">
        <div class="title-image">
            <img src="<?= base_url('assets/img/404.gif') ?>" alt="" class="h-100">
        </div>
        <h1>Oops..</h1>
        <h3>Kamu Tersesat!</h3>
        <p>
            Halaman yang kamu cari tidak ditemukan. Tapi jangan khawatir,
            kamu bisa kembali lagi ke halaman Home.
        </p>
        <br />
        <a href="<?= base_url() ?>" class="btn btn-primary">Home</a>
    </div>
</body>

</html>