// import thư viện
const express=require('express');           //server web. → Express giúp tạo API, xử lý request và response dễ dàng.
const session=require('express-session');
const crypto=require('crypto');
const db=require('./db');                   //database
const bodyParser=require('body-parser');    //form
const cors = require("cors");

const app = express();
app.use(cors());
app.use(bodyParser.urlencoded({extended: true}));
app.use(bodyParser.json());
app.use(express.static('public'));

app.set('view engine', 'ejs');
app.set('views', __dirname + '/views');


app.get("/nav", (req, res) => {
    res.render("nav");
});

app.get('/dangky',(req,res)=>{
    res.sendFile(__dirname + "/public/dangky.html");
});
app.get("/", (req, res) => { 
    res.sendFile(__dirname + "/public/dangky.html");
});


// check email
app.post("/check-email", (req, res) => {
    const { email } = req.body;

    const sql = "SELECT email FROM users WHERE email = ?";
    db.query(sql, [email], (err, result) => {
        if (err) {
            console.error("Lỗi truy vấn:", err);
            return res.status(500).send("Lỗi server");
        }

        if (result.length > 0) {
            res.send({ exists: true });
        } else {
            res.send({ exists: false });
        }
    });
});

// Xu Ly Dang Ky
app.post('/dangky',(req,res)=>{
    const {name,email,pwd,year_old,sex}=req.body;
    const hashPswSha1=crypto.createHash('sha1').update(pwd).digest('hex');


    const sql="INSERT INTO users(name,email,year_old,pwd,sex) values (?,?,?,?,?)";

    db.query(sql,[name,email,year_old,hashPswSha1,sex],(err,result)=>{
        if(err){
            if(err.code=='ER_DUP_ENTRY'){
                return res.status(400).send("Email này đã tồn tại!!!!");
            }
            return res.status(500).send("Lỗi trong quá trình lưu dữ liệu!!!");
        }
        return res.send("Đăng kí thành công!!!");
    });
});







app.use(session({
    secret:'haidangdeptrai',  //Chuỗi bí mật dùng để mã hóa session.
    resave: false,            //không lưu ss vào store neeys không có thay đổi
    saveUninitialized: true
}));


//xu ly dang nhap
app.get('/dangnhap',(req,res)=>{
    if(req.session.loggedIn){
        return res.redirect('/thongtincanhan');
    }
    res.sendFile(__dirname + '/public/dangnhap.html');
});
app.post('/dangnhap',(req,res)=>{
    const {email,pwd}=req.body;
    const hashPswSha1=crypto.createHash('sha1').update(pwd).digest('hex');
    const sql="SELECT * FROM users WHERE email=? and pwd=?";

    db.query(sql,[email,hashPswSha1],(err,result)=>{
        if(err){
            res.status(500).send("Lỗi trong quá trình kiểm tra");
        }
        if(result.length>0){
            req.session.loggedIn = true;
            req.session.userEmail = email;  
            return res.redirect('/thongtincanhan');
        }else{
            res.status(400).send("Email hoặc mật khẩu không đúng!");
        }
    });
});



// Thông Tin Cá Nhân:
app.get('/thongtincanhan', (req, res) => {
    if (!req.session.loggedIn) {
        return res.redirect('/dangnhap');
    }
    const sql = "SELECT name, email, year_old, sex FROM users WHERE email = ?";
    db.query(sql, [req.session.userEmail], (err, result) => {
        if (err) {
            console.error(err);
            return res.status(500).send("Lỗi trong quá trình truy xuất thông tin cá nhân");
        }
        if (result.length > 0) {
            const userInfo = result[0];
            res.render('thongtincanhan', { user: userInfo });
        } else {
            res.status(404).send("Không tìm thấy thông tin người dùng");
        }
    });
});

// Cập nhật
app.get('/capnhat', (req, res) => {
    if (!req.session.loggedIn) {
        return res.redirect('/dangnhap');
    }
    const sql = "SELECT name, email, year_old, sex FROM users WHERE email = ?";
    db.query(sql, [req.session.userEmail], (err, result) => {
        if (err) {
            console.error(err);
            return res.status(500).send("Lỗi trong quá trình truy xuất thông tin cá nhân");
        }
        if (result.length > 0) {
            res.render('capnhat', { user: result[0] });
        } else {
            res.status(404).send("Không tìm thấy thông tin người dùng");
        }
    });
});

app.post('/capnhat', (req, res) => {
    if (!req.session.loggedIn) {
        return res.redirect('/dangnhap');
    }

    const { hoten, namsinh, gioitinh } = req.body;
    const sql = "UPDATE users SET name = ?, year_old = ?, sex = ? WHERE email = ?";
    
    db.query(sql, [name, year_old, sex, req.session.userEmail], (err, result) => {
        if (err) {
            console.error(err);
            return res.status(500).send("Lỗi trong quá trình cập nhật thông tin");
        }
        res.redirect('/thongtincanhan');
    });
});

//Đăng Xuất
app.get('/dangxuat',(req,res)=>{
    req.session.loggedIn=false;
    req.session.user=null;
    res.send("Đã đăng xuất tài khoản!");
    res.redirect('/dangnhap');
});




app.listen(5001,function(){
    console.log("Express App running at http://127.0.0.1:5001");
});
