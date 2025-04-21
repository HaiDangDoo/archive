<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <style>
    
    </style>
     
    
    <?php
    include('nav.php');
    ?>
</head>
<body>
    <header>
    </header>

    <main>
    <section style="  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 69%;
  padding-top: 25px;">
    <div style="border: solid 1px; padding:8px"; >
        <div>
        <h1 style="text-align: center; color:blue">Thông Tin Đăng Ký Thành Viên</h1>
        </div>
        <form action="register.php" method="POST" id="register" enctype="application/x-www-form-urlencoded">   
        <table>
            <tr>
                <td><b><label for="name">Họ Tên:</label></b></td>
            <td><input type="text" name="name"></td>
        </tr>
        <tr>
                <td><b><label for="email">Địa chỉ Email:</label></b></td>
            <td><input type="email" name="email"></td>
        </tr>
        <tr>
                <td><b><label for="pwd">Mật Khẩu:</label></b></td>
            <td><input type="password" name="pwd"></td>
        </tr>
        <tr>
                <td><b><label for="year_old">Năm Sinh:</label></b></td>
            <td><select name="year_old" id="year"><?php
            $year_old = date('Y');
            for($i=$year_old-50; $i<=$year_old;$i++){
                echo "<option>$i</option>";
            }
            ?>
            </select></td>
        </tr>
        <tr>
                <td><b><label for="sex">Giới Tính:</label></b></td>
            <td><input type="radio" value="Nam" name="sex">Nam
            <input type="radio" value="Nữ" name="sex">Nữ</td>
        </tr>
        </table>
        <div id="btn">
            <button type="submit" class="btn1">Đăng Ký</button>
            <button type="button" class="btn2" onclick="clear_form()">Xóa Form</button>
            
        </div>
        </form>
    </div>
    </section>
    </main>
    <script>
    function clear_form(){
        document.getElementById("register").reset();
    }
    </script>
<footer>
</footer>
</body>
</html>