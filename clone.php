<? 
if (!isset($_SESSION['role'])
    || $_REQUEST['role']== 'mahasiswa'){
    header("Location:/ uas-basisdata/login.php");}
    exit; 

   
    $nim = $_SESSION['nim'];
    $nama = $_SESSION['nama'];
    $jurusan = $_SESSION['jurusan'];
?>
