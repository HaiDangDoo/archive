<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: dangnhap.php');
    exit();
} else {
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $year_old = $_SESSION['year_old'];
    $sex = $_SESSION['sex'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title>
    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
    <style>
        h1 {
            color: blue;
        }

        /* main{
    display: flex;
    justify-content: center;
    align-items: flex-start;
} */
        table tr th {
            display: block;
            float: left;
        }

        .submit,
        .clear {
            border-radius: 10px;
            padding: 5px 15px;
            color: white;
        }

        .submit {
            background-color: rgb(2, 225, 255);
        }

        .clear {
            background-color: red;
        }

        fieldset {
            width: 50%;
            border: 2px solid #3353b3;
            /* Viền màu xanh lá */
            border-radius: 10px;
            /* Bo tròn góc */
            padding: 20px;
            /* Khoảng cách bên trong */
            margin: 20px 0;
            /* Khoảng cách giữa các fieldset */
            background-color: #f9f9f9;
            /* Màu nền */
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            /* Hiệu ứng đổ bóng */
        }

        main {
            display: flex;
            justify-content: center;
            /* align-items: center; */
        }

        .exit {
            padding-top: 10px;
        }

        .exit a {
            font-family: sans-serif;
            font-size: 1rem;
            font-weight: 500;
            line-height: inherit;
            cursor: pointer;
            min-width: 40%;
            height: auto;
            padding: 0.45rem 0.95rem;
            border-radius: 2rem;
            color: #fff;
            box-shadow: 0 4px 6px -1px #0000001a,
                0 2px 4px -1px #0000000f;
            text-transform: capitalize;
            background: red;
            text-rendering: optimizeLegibility;
            border: 2px solid red;
            font-weight: bold;
        }

        .exit a:hover {
            background-color: #fff;
            border: 2px solid red;
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <main>

        <fieldset>
            <legend>
                <h1>Thông tin cá nhân</h1>
            </legend>
            <table>
                <tr>
                    <td>
                        <b>Họ Và Tên:</b>
                    </td>
                    <td> <?php echo htmlspecialchars($name); ?></td>
                </tr>

                <tr>
                    <td>
                        <b>Email:</b>
                    </td>
                    <td><?php echo htmlspecialchars($email); ?></td>
                </tr>

                <tr>
                    <td>
                        <b>Năm Sinh:</b>
                    </td>
                    <td><?php echo htmlspecialchars($year_old); ?></td>
                </tr>

                <tr>
                    <td>
                        <b>Giới Tính:</b>
                    </td>
                    <td> <?php
                            if ($sex == 'Nam')
                                echo "Nam";
                            else
                                echo "Nữ"; ?></td>

                </tr>
            </table>
            <div class="exit">
                <a href="dangxuat.php">Đăng Xuất</a>
            </div>
        </fieldset>
    </main>
</body>

</html>