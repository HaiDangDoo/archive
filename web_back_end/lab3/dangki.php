<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Đăng kí</title>
        <link rel="stylesheet"  type="text/css" href="style.css">
        <style>
            .dangki{
                color:blue;
            }
        </style>
    </head>
    <body>
        <?php include('nav.php');?> 
        <main>
            <div class="main">
                <section class="wapper">
                    <div><h1>THÔNG TIN ĐĂNG KÍ THÀNH VIÊN</h1></div>
                    <div>
                        <form action="signin.php" method="POST" enctype="application/x-www-form-urlencoded" id="registerForm">
                            <div class="input_control">
                                <label for="name">Họ tên: </label>
                                <input name="name" type="text" class="input_infor"/>    
                            </div>
                            <div class="input_control">
                                <label for="email">Địa chỉ Email: </label>
                                <input name="email" type="email" class="input_infor"/>
                            </div>
                            <div class="input_control">
                                <label for="psw">Mật khẩu: </label>
                                <input type="password" name="psw" class="input_infor"/>
                            </div>
                            <div class="input_control">
                                <label for="year">Năm sinh:</label>
                                <select name="year" id="year" class="input_infor select">
                                    <?php
                                        $currentYear=date('Y');
                                        for($i=$currentYear-50;$i<=$currentYear;$i++){
                                            echo "<option value='$i'>$i</option>";
                                        }

                                    ?>
                                </select>
                            </div>
                            <div class="input_control">
                                <label>Giới tính: </label>
                                <div class="btn_gender">
                                    <input type="radio" value="male" id="male" name="gender">
                                    <label for="gender">Nam</label>
                                    <input type="radio" value="female" id="female" name="gender">
                                    <label for="gender">Nữ</label>
                                </div>  
                            </div>
                            <div class="input_control" id="btn">
                                <button type="submit" class="btn1">Đăng kí</button>
                                <button type="button" class="btn2" onclick="clearForm()">Xóa Form</button>                           
                            </div>
                        </form>
                    </div>
                </section>
                
            </div>
        </main>
        <script>
            function clearForm(){
                document.getElementById("registerForm").reset();
            }
        </script>
    </body>
</html>