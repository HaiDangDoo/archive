const express=require('express');
const session=require('express-session');
const crypto=require('crypto');
const db=require('./db');
const bodyParser=require('body-parser');

const app=express();
app.use(bodyParser.urlencoded({extended: true}));
app.use(bodyParser.json());
app.use(express.static('public'));

app.set('view engine', 'ejs');
app.set('views', __dirname + '/views');

app.get('/dangki',(req,res)=>{
    res.sendFile(__dirname + "/views/dangki.html");
});

app.post('/dangki',(req,res)=>{
    const {name,email,psw,year,gender}=req.body;
    const hashPswSha1=crypto.createHash('sha1').update(psw).digest('hex');

    const sql="INSERT INTO users(hoten,email,namsinh,password,gioitinh) values (?,?,?,?,?)";

    db.query(sql,[name,email,year,hashPswSha1,gender],(err,result)=>{
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
    secret:'congkhanh',
    resave: false,
    saveUninitialized: true
}));

app.get('/dangnhap',(req,res)=>{
    if(req.session.loggedIn){
        return res.redirect('/thongtincanhan');
    }
    res.sendFile(__dirname + '/views/dangnhap.html');
});
app.post('/dangnhap',(req,res)=>{
    const {email,psw}=req.body;
    const hashPswSha1=crypto.createHash('sha1').update(psw).digest('hex');
    const sql="SELECT * FROM users WHERE email=? and password=?";

    db.query(sql,[email,hashPswSha1],(err,result)=>{
        if(err){
            res.status(500).send("Lỗi trong quá trình kiểm tra");
        }
        if(result.length>0){
            req.session.loggedIn = true;
            req.session.userEmail = email;  // Lưu email để dùng sau
            return res.redirect('/thongtincanhan');
        }else{
            res.status(400).send("Email hoặc mật khẩu không đúng!");
        }
    });
});

app.get('/thongtincanhan', (req, res) => {
    if (!req.session.loggedIn) {
        return res.redirect('/dangnhap');
    }
    const sql = "SELECT hoten, email, namsinh, gioitinh FROM users WHERE email = ?";
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

app.get('/capnhat', (req, res) => {
    if (!req.session.loggedIn) {
        return res.redirect('/dangnhap');
    }
    const sql = "SELECT hoten, email, namsinh, gioitinh FROM users WHERE email = ?";
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
    const sql = "UPDATE users SET hoten = ?, namsinh = ?, gioitinh = ? WHERE email = ?";
    
    db.query(sql, [hoten, namsinh, gioitinh, req.session.userEmail], (err, result) => {
        if (err) {
            console.error(err);
            return res.status(500).send("Lỗi trong quá trình cập nhật thông tin");
        }
        res.redirect('/thongtincanhan');
    });
});


app.get('/dangxuat',(req,res)=>{
    req.session.loggedIn=false;
    req.session.user=null;
    res.send("Đã đăng xuất tài khoản!");
    res.redirect('/dangnhap');
});


app.listen(5000,function(){
    console.log("Express App running at http:127.0.0.1:5000/");
});
