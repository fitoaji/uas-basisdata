<div class="sidebar">
    <div class="sidebar-header">
        <h3>UNPRI SMT</h3>
        <small>Hi, <?php echo $_SESSION['nama']; ?> (<?php echo ucfirst($_SESSION['role']); ?>)</small>
    </div>
    
    <div class="menu">
        <?php $p = basename($_SERVER['PHP_SELF']); ?>
        
        <a href="index.php" class="<?php echo $p == 'index.php' ? 'active' : ''; ?>"><i class="fas fa-home"></i> Dashboard</a>
        
        <?php if($_SESSION['role'] == 'admin') { ?>
            <a href="mahasiswa.php" class="<?php echo $p == 'mahasiswa.php' ? 'active' : ''; ?>"><i class="fas fa-user-graduate"></i> Mahasiswa</a>
            <a href="dosen.php" class="<?php echo $p == 'dosen.php' ? 'active' : ''; ?>"><i class="fas fa-chalkboard-teacher"></i> Dosen</a>
            <a href="matakuliah.php" class="<?php echo $p == 'matakuliah.php' ? 'active' : ''; ?>"><i class="fas fa-book-open"></i> Matakuliah</a>
            <a href="semester.php" class="<?php echo $p == 'semester.php' ? 'active' : ''; ?>"><i class="fas fa-calendar-alt"></i> Semester</a>
        <?php } ?>

        <?php if($_SESSION['role'] == 'dosen') { ?>
            <a href="matakuliah.php" class="<?php echo $p == 'matakuliah.php' ? 'active' : ''; ?>"><i class="fas fa-book-open"></i> Jadwal Ajar</a>
        <?php } ?>

        <?php if($_SESSION['role'] == 'mahasiswa') { ?>
            <a href="matakuliah.php" class="<?php echo $p == 'matakuliah.php' ? 'active' : ''; ?>"><i class="fas fa-book"></i> KRS / Matkul</a>
        <?php } ?>
        
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>  