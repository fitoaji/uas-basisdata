<?php
session_start();
include 'koneksi.php';

if (isset($_SESSION['status']) && $_SESSION['status'] == "login") {
    header("location:dashboard.php");
}

$pesan = "";
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role = $_POST['role'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password' AND role='$role'");
    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        $_SESSION['username'] = $username;
        $_SESSION['nama'] = $data['nama_lengkap'];
        $_SESSION['role'] = $role;
        $_SESSION['status'] = "login";
        header("location:dashboard.php");
    } else {
        $pesan = "Login Gagal! Cek Username/Password/Role.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login SIAKAD</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body{ background:#e9ecef; font-family:'Poppins',sans-serif; display:flex; justify-content:center; align-items:center; height:100vh;}
        .login-box{ background:white; padding:40px; border-radius:8px; box-shadow:0 0 20px rgba(0,0,0,0.1); width:350px; text-align:center;}
        input, select { width:100%; padding:10px; margin:10px 0; border:1px solid #ddd; border-radius:4px; box-sizing: border-box;}
        button { width:100%; padding:10px; background:#007bff; color:white; border:none; border-radius:4px; cursor:pointer;}
        .error { color: red; font-size: 12px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>SIAKAD LOGIN</h2>
        <div class="error"><?php echo $pesan; ?></div>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="role">
                <option value="admin">Admin</option>
                <option value="dosen">Dosen</option>
                <option value="mahasiswa">Mahasiswa</option>
            </select>
            <button type="submit" name="login">MASUK</button>
        </form>
        <p style="font-size:10px; margin-top:10px; color:#888;">Demo: admin / 123</p>
    </div>
        <p style="font-size:10px; margin-top:10px; color:#888;">Demo: dosen / 123</p>
    </div>
        <p style="font-size:10px; margin-top:10px; color:#888;">Demo: mahasiswa / 123</p>
    </div>
</body>
</html>