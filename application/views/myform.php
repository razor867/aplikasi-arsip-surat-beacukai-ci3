<html>

<head>
    <title>My Form</title>
</head>

<body>

    <?php
    $info = validation_errors();
    '<h1 style="display:none;">' . $info . '</h1>';
    ?>

    <!-- <?php echo form_open('form'); ?>

    <h5>Username</h5>
    <input type="text" name="username" value="" size="50" />

    <h5>Password</h5>
    <input type="text" name="password" value="" size="50" />

    <h5>Password Confirm</h5>
    <input type="text" name="passconf" value="" size="50" />

    <h5>Email Address</h5>
    <input type="text" name="email" value="" size="50" />

    <div><input type="submit" value="Submit" /></div>

    </form> -->

    <form action="#" method="post">
        <label for="user">Username</label><br />
        <input type="text" name="user" id="user"><br />
        <!-- <label for="pass">Password</label><br />
        <input type="password" name="pass" id="pass"><br /> -->
        <input type="submit" name="submit" value="submit">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $username = $_POST['user'];
        $pattern = '/^[a-zA-Z0-9 ]*$/';

        if (!preg_match($pattern, $username)) {
            echo 'tidak sesuai format';
        } else {
            echo 'sesuai format';
        }
    }
    ?>

    <script>
        var info = document.getElementsByTagName('h1');
        if (info[0] === '') {
            info[0].textContent = ' ';
        } else {
            alert(info[0].textContent);
        }
    </script>
</body>

</html>