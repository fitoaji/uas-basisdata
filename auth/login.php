<?php
session_start();
include "../config/koneksi.php";

$pesan = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role     = $_POST['role'];

    $query = mysqli_query($conn, "
        SELECT * FROM users 
        WHERE username='$username'
        AND password='$password'
        AND role='$role'
    ");

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);

        $_SESSION['id_user']  = $data['id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['role']     = $data['role'];

        /* ==========================
           AMBIL NAMA SESUAI ROLE
        ========================== */

        if ($role == 'admin') {
            $_SESSION['nama'] = $data['username'];
            header("Location: ../admin/dashboard.php");

        } elseif ($role == 'dosen') {
            $qDosen = mysqli_query($conn, "
                SELECT nama FROM dosen WHERE nidn='$username'
            ");
            $dosen = mysqli_fetch_assoc($qDosen);
            $_SESSION['nama'] = $dosen['nama'];

            header("Location: ../dosen/dashboard.php");

        } elseif ($role == 'mahasiswa') {
            $qMhs = mysqli_query($conn, "
                SELECT nama FROM mahasiswa WHERE nim='$username'
            ");
            $mhs = mysqli_fetch_assoc($qMhs);
            $_SESSION['nama'] = $mhs['nama'];

            header("Location: ../mahasiswa/dashboard.php");
        }

        exit;
    } else {
        $pesan = "Username / Password / Role salah";
    }
}
?>
