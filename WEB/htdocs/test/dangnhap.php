<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="style.css">
    <style>
    </style>
</head>
<?php include('header.php'); ?>


<body>
    <main>
        <fieldset>
            <legend>
                <h1>Đăng nhập tài khoản</h1>
            </legend>

            <form action="process.php" method="POST" enctype="application/x-www-form-urlencoded">
                <table>
                    <tr>
                        <th><label for="email">Email:</label></th>
                        <td><input type="email" name="email" id="email" autocomplete="off"></td>
                    </tr>
                    <tr>
                        <th><label for="pwd">Mật khẩu:</label></th>
                        <td><input type="password" id="pwd" name="pwd"></td>
                    </tr>
                </table>
                <div class="button">

                    <button class="submit" type="submit">Đăng nhập</button>
                </div>
            </form>
        </fieldset>
    </main>
</body>

</html>