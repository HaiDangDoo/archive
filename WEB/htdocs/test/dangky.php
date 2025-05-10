<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Thành Viên</title>
    <link rel="stylesheet" href="style.css">
    <script>
        //clear form
        function clearForm() {
            document.getElementById("dangky").reset();
        }
    </script>
    <style>
    </style>

</head>

<body>
    <header>
        <?php include('header.php'); ?>

    </header>
    <main>
        <fieldset>
            <legend>
                <h1>Thông Tin Đăng Ký Thành Viên</h1>
            </legend>

            <form action="process.php" method="POST" enctype="application/x-www-form-urlencoded" id="dangky">
                <table>
                    <tr>
                        <th><label for="name">Họ và Tên:</label></th>
                        <td><input type="text" id="name" name="name"></td>
                    </tr>
                    <tr>
                        <th><label for="email">Địa Chỉ Email:</label></th>
                        <td>
                            <input type="email" id="email" name="email">
                            <span id="emailMessage"></span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="pwd">Mật Khẩu:</label></th>
                        <td>
                            <input type="password" id="pwd" name="pwd">
                        </td>
                    </tr>
                    <tr>
                        <th><label for="year_old">Năm Sinh:</label></th>
                        <td>
                            <select name="year_old" id="year_old">
                                <script>
                                    const currentYear = new Date().getFullYear();
                                    for (let i = currentYear - 50; i < currentYear; i++) {
                                        document.write(`<option value=${i}>${i}</option>`);
                                    }
                                </script>
                            </select>

                        </td>
                    </tr>
                    <tr>
                        <th><label>Giới Tính:</label></th>
                        <td>
                            <input type="radio" value="male" id="male" name="sex">
                            <label for="male">Nam</label>
                            <input type="radio" value="female" id="female" name="sex">
                            <label for="female">Nữ</label>
                        </td>
                    </tr>
                </table>
                <div class="button" id="btn">
                    <button type="submit" class="submit">Đăng ký</button>
                    <button type="button" class="clear" onclick="clearForm()">Xóa Form</button>
                </div>
            </form>
        </fieldset>
    </main>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>

</html>