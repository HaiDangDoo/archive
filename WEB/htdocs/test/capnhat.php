<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Cập nhật thông tin cá nhân</title>
    <link rel="stylesheet" href="style.css">
    <style>

    </style>
    <?php include('header.php'); ?>
</head>

<body>

    <main>
        <fieldset>
            <legend>
                <h1>Cập nhật thông tin cá nhân</h1>
            </legend>

            <form action="process.php" method="POST">
                <table>
                    <tr>
                        <td><b><label for="name">Họ Tên:</label></b></td>
                        <td><input type="text" name="name"></td>
                    </tr>
                    <!-- <tr>
                <td><b><label for="email">Địa chỉ Email:</label></b></td>
            <td><input type="email" name="email"></td>
        </tr> -->
                    <tr>
                        <td><b><label for="pwd">Mật Khẩu:</label></b></td>
                        <td><input type="password" name="pwd"></td>
                    </tr>
                    <tr>
                        <td><b><label for="year_old">Năm Sinh:</label></b></td>
                        <td><select name="year_old" id="year"><?php
                                                                $year_old = date('Y');
                                                                for ($i = $year_old - 50; $i <= $year_old; $i++) {
                                                                    echo "<option>$i</option>";
                                                                }
                                                                ?></select></td>
                    </tr>
                    <tr>
                        <td><b><label for="sex">Giới Tính:</label></b></td>
                        <td><input type="radio" value="Nam" name="sex"><label>Nam</label>
                            <input type="radio" value="Nữ" name="sex"><label>Nữ</label>
                        </td>
                    </tr>
                </table>
                <div>

                    <button class="exit" type="submit">Cập nhật</button>

                </div>
            </form>
        </fieldset>
    </main>
</body>

</html>