document.addEventListener("DOMContentLoaded", function() {
    loadDashboardStats();

    // Event Listener untuk Tombol Tambah Mahasiswa
    document.getElementById('btnAddStudent').addEventListener('click', function() {
        addStudentData();
    });
});

// FUNGSI 1: Load Data dari API (READ)
function loadDashboardStats() {
    fetch('api.php?action=get_stats')
    .then(response => response.json())
    .then(data => {
        // Update angka di HTML berdasarkan ID
        document.getElementById('count-kurikulum').innerText = data.kurikulum;
        document.getElementById('count-semester').innerText = data.semester;
        document.getElementById('count-jurusan').innerText = data.jurusan;
        document.getElementById('count-matakuliah').innerText = data.matakuliah;
        document.getElementById('count-dosen').innerText = data.dosen;
        document.getElementById('count-mahasiswa').innerText = data.mahasiswa;
        document.getElementById('count-ruangan').innerText = data.ruangan;
        document.getElementById('count-absensi').innerText = data.absensi;
    })
    .catch(error => console.error('Error fetching data:', error));
}

// FUNGSI 2: Kirim Data ke API (CREATE)
function addStudentData() {
    if(!confirm("Simulasi: Tambahkan 1 Mahasiswa baru?")) return;

    fetch('api.php?action=add_mahasiswa', {
        method: 'POST'
    })
    .then(response => response.json())
    .then(result => {
        if(result.status === 'success') {
            alert(result.message);
            // Refresh tampilan angka tanpa reload halaman
            document.getElementById('count-mahasiswa').innerText = result.new_total;
        }
    });
}

// Toggle Sidebar untuk Mobile
function toggleSidebar() {
    document.querySelector('.sidebar').classList.toggle('active');
}