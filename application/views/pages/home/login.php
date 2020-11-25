<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">
</head>

<body>
    <div class="login-page">
        <div class="form">
            <!-- <form class="register-form">
                <input type="text" placeholder="name" />
                <input type="password" placeholder="password" />
                <input type="text" placeholder="email address" />
                <button>create</button>
                <p class="message">Already registered? <a href="#">Sign In</a></p>
            </form> -->
            <form class="login-form" method="post" action="<?= base_url('home/cekLogin') ?>">
                <h2 class="title-login">Welcome</h2>
                <input type="text" name="user" placeholder="username" autocomplete="off" />
                <input type="password" name="pass" placeholder="password" autocomplete="off" />
                <button type="submit" name="submit" value="submit">login</button>
                <p class="message">Jika anda kesulitan masuk, hubungi admin!
                    <!-- <a href="#">Lapor admin</a> -->
                </p>
                <p class="message">
                    <a href="<?= base_url() ?>">Kembali ke Home!</a>
                </p>
            </form>
        </div>
    </div>
    <div id="flash" data-flashData="<?= $flashdata ?>"></div>
    <script src="<?= base_url('assets/js/jquery-3.5.1.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/login.js') ?>"></script>
</body>

</html>