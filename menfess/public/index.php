<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
  case 'browse':
    include 'browse.php';
    break;
  case 'submit':
    include 'submit.php';
    break;
  case 'clicked':
    include 'clicked.php';
    break;
  case 'mutual':
    include 'mutual.php';
    break;
  case 'menfess':
    include 'menfess.php';
    break;
  case 'terms':
    include 'terms.php';
    break;
  case 'submitmutual':
    include 'submitmutual.php';
    break;
  default:
    if ($page === 'home') {
      include 'home.php'; // Halaman default jika page=home
    } else {
      include '404.php'; // Alihkan ke halaman 404 jika tidak ada kecocokan
    }
}
?>