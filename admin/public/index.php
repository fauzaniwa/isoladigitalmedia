<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
  case 'admin':
    include 'admin.php';
    break;
  case 'anggota':
    include 'anggota.php';
    break;
  case 'blog':
    include 'blog.php';
    break;
  case 'blogadd':
    include 'blogadd.php';
    break;
  case 'broadcasting':
    include 'broadcasting.php';
    break;
  case 'draft':
    include 'draft.php';
    break;
  case 'gallery':
    include 'gallery.php';
    break;
  case 'galleryadd':
    include 'galleryadd.php';
    break;
  case 'info':
    include 'info.php';
    break;
  case 'login':
    include 'login.php';
    break;
  case 'nomor_surat':
    include 'nomor_surat.php';
    break;
  case 'notulensi':
    include 'notulensi.php';
    break;
  case 'profile':
    include 'profile.php';
    break;
  case 'register':
    include 'register.php';
    break;
  case 'users':
    include 'users.php';
    break;
  case 'visimisi':
    include 'visimisi.php';
    break;
  case 'logout':
    include 'logout.php';
    break;
  case 'forgot':
    include 'forgot.php';
    break;
  case 'editprofile':
    include 'editprofile.php';
    break;
  case 'editpassword':
    include 'editpassword.php';
    break;
  case 'edit_notulensi':
    include 'edit_notulensi.php';
    break;
  case 'edit_surat':
    include 'edit_surat.php';
    break;
  case 'edit_draft':
    include 'edit_draft.php';
    break;
  case 'gallery_add':
    include 'gallery_add.php';
    break;
  case 'createaccount':
    include 'createaccount.php';
    break;
  case 'blog_add':
    include 'blog_add.php';
    break;
  case 'anggota_details':
    include 'anggota_details.php';
    break;
  case 'artbooth':
    include 'artbooth.php';
    break;
  case 'export_anggota':
    include 'export_anggota.php';
    break;
    case 'edit_photobooth':
      include 'edit_photobooth.php';
      break;
  default:
    if ($page === 'home') {
      include 'home.php'; // Halaman default jika page=home
    } else {
      include '404.php'; // Alihkan ke halaman 404 jika tidak ada kecocokan
    }
}
?>