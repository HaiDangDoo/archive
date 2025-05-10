<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <style>
        h1 {
            color: blue;
            text-align: center;
        }

        #div {
            border: solid 1px;
            padding: 8px;
        }

        section {
            padding-top: 25px;
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 60%;
        }
    </style>
    <?php
    include('nav.php'); ?>
</head>

<body>

    <section>
        <div id="div">
            <h1>Đăng Nhập Tài Khoản</h1>
            <form action="login.php" method="POST">
                <table>
                    <tr>
                        <td><b><label for="email">Email:</label></b></td>
                        <td><input type="email" name="email"></td>
                    </tr>
                    <tr>
                        <td><b><label for="pwd">Mật Khẩu:</label></b></td>
                        <td><input type="password" name="password"></td>
                    </tr>
                </table>
                <input type="submit" value="Đăng Nhập">
            </form>
        </div>
    </section>
</body>

</html>