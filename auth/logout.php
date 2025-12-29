<?php
session_start();

// hapus semua session
session_unset();
session_destroy();

// balik ke login (karena login satu folder)
header("Location: login.php");
exit;
