<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Khách Hàng</title>
    <link rel="stylesheet" href="style.css">
    <style>

    </style>
    <script>
        function clearForm() {
            document.getElementById("themkhachhang").reset();
        }
    </script>
</head>

<body>

    <main>
        <fieldset>
            <legend>
                <h1>Thêm Khách Hàng</h1>
            </legend>
            <form action="process.php" method="POST" enctype="application/x-www-form-urlencoded" id="themkhachhang">
                <table>
                    <tr>
                        <th><label for="ten">Tên Khách Hàng:</label></th>
                        <td><input type="text" id="ten" name="ten"></td>
                    </tr>
                    <tr>
                        <th><label for="email">Địa chỉ email:</label></th>
                        <td><input type="email" id="email" name="email"></td>
                    </tr>
                    <tr>
                        <th><label for="quocgia">Quốc gia:</label></th>
                        <td><select name="quocgia" id="quocgia">
                                <option value="vietnam">Vietnam</option>
                                <option value="usa">USA</option>
                                <option value="khac">Khác</option>
                            </select></td>
                    </tr>
                    <tr>
                        <th><label for="namsinh">Năm Sinh:</label></th>
                        <td>
                            <select name="namsinh" id="namsinh">
                                <script>
                                    const currentYear = new Date().getFullYear();
                                    for (let i = currentYear - 50; i < currentYear; i++) {
                                        document.write(`<option value=${i}>${i}</option>`);
                                    }
                                </script>
                            </select>
                        </td>
                    </tr>

                </table>
                <nav class="button">
                    <button type="submit" class="submit">Lưu</button>
                    <button type="button" class="clear" onclick="clearForm()">Xóa</button>
                </nav>
            </form>
        </fieldset>
    </main>

</body>

</html>