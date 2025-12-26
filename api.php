<?php
include 'koneksi.php';
header("Content-Type: application/json");

$action = $_GET['action'] ?? '';

// --- ENDPOINT 1: AMBIL DATA STATISTIK (READ) ---
if ($action == 'get_stats') {
    $data = [];

    // 1. Hitung Mahasiswa
    $query = mysqli_query($conn, "SELECT COUNT(*) as total FROM mahasiswa WHERE status='AKTIF'");
    $data['mahasiswa'] = mysqli_fetch_assoc($query)['total'];

    // 2. Hitung Dosen
    $query = mysqli_query($conn, "SELECT COUNT(*) as total FROM dosen");
    $data['dosen'] = mysqli_fetch_assoc($query)['total'];

    // 3. Hitung Mata Kuliah
    $query = mysqli_query($conn, "SELECT COUNT(*) as total FROM mata_kuliah");
    $data['matakuliah'] = mysqli_fetch_assoc($query)['total'];

    // 4. Hitung Semester Aktif (Dari tabel tahun_akademik)
    $query = mysqli_query($conn, "SELECT COUNT(*) as total FROM tahun_akademik WHERE aktif=1");
    $data['semester'] = mysqli_fetch_assoc($query)['total'];

    // 5. Hitung Jurusan (Diambil dari distinct jurusan_id di tabel mahasiswa karena tabel jurusan tidak ada di dump)
    $query = mysqli_query($conn, "SELECT COUNT(DISTINCT jurusan_id) as total FROM mahasiswa");
    $data['jurusan'] = mysqli_fetch_assoc($query)['total'];

    // --- Data Dummy (Karena tabelnya tidak ada di siakad.sql) ---
    // Agar dashboard tidak kosong/error
    $data['kurikulum'] = 10; 
    $data['ruangan'] = 20;   
    $data['absensi'] = 40;   

    echo json_encode($data);
    exit;
}

// --- ENDPOINT 2: TAMBAH MAHASISWA (CREATE) ---
if ($action == 'add_mahasiswa' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    // Generate Data Dummy untuk simulasi cepat
    $nim_rand = "2023" . rand(1000, 9999); // NIM Random
    $nama_rand = "Mahasiswa Baru " . rand(1, 100);
    $jurusan_rand = "IF"; // Default Jurusan
    $angkatan = 2023;

    $sql = "INSERT INTO mahasiswa (nim, nama, jurusan_id, angkatan, status) 
            VALUES ('$nim_rand', '$nama_rand', '$jurusan_rand', '$angkatan', 'AKTIF')";

    if (mysqli_query($conn, $sql)) {
        // Ambil total terbaru
        $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM mahasiswa WHERE status='AKTIF'");
        $new_total = mysqli_fetch_assoc($result)['total'];

        echo json_encode([
            "status" => "success", 
            "message" => "Mahasiswa ($nama_rand) berhasil ditambahkan ke Database!",
            "new_total" => $new_total
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal: " . mysqli_error($conn)]);
    }
    exit;
}

// --- ENDPOINT 3: EKSPOR CSV (Ambil dari Database) ---
if ($action == 'export_csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="data_mahasiswa_siakad.csv"');

    $output = fopen('php://output', 'w');
    fputcsv($output, ['NIM', 'Nama', 'Jurusan', 'Status']); // Header

    $query = mysqli_query($conn, "SELECT nim, nama, jurusan_id, status FROM mahasiswa");
    while ($row = mysqli_fetch_assoc($query)) {
        fputcsv($output, $row);
    }
    fclose($output);
    exit;
}

echo json_encode(["status" => "error", "message" => "Action tidak valid"]);
?>