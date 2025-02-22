<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
  case 'register':
    include 'register.php';
    break;
  case 'login':
    include 'login.php';
    break;
  case 'pengumuman':
    include 'pengumuman.php';
    break;
  default:
    if ($page === 'home') {
      include 'register.php'; // Halaman default jika page=home
    } else {
      include '404.php'; // Alihkan ke halaman 404 jika tidak ada kecocokan
    }
}
?>