<?php include 'session.php'; ?>

<?php
// Hubungkan ke database
require_once '../controllers/koneksi.php';

// Query untuk mengambil data berdasarkan tanggal
$query = "SELECT DATE(created_at) AS date, COUNT(*) AS total
          FROM menfess
          GROUP BY DATE(created_at)
          ORDER BY date ASC";
$result = $conn->query($query);

// Menyiapkan array untuk menampung data
$labels = [];
$data = [];

while ($row = $result->fetch_assoc()) {
  $labels[] = $row['date'];  // Menyimpan tanggal
  $data[] = $row['total'];   // Menyimpan jumlah entri
}

// Encode data ke dalam format JSON untuk digunakan di JavaScript
$labels_json = json_encode($labels);
$data_json = json_encode($data);
?>

<?php
include '../controllers/koneksi.php'; // File koneksi database Anda

// Query untuk mendapatkan data jumlah pengunjung per tanggal
$sql = "SELECT DATE(access_time) AS access_date, COUNT(*) AS total_views 
        FROM viewers 
        GROUP BY DATE(access_time) 
        ORDER BY access_date ASC";
$result = mysqli_query($conn, $sql);

// Data untuk chart
$dates = [];
$views = [];

while ($row = mysqli_fetch_assoc($result)) {
  $dates[] = $row['access_date'];
  $views[] = $row['total_views'];
}

// Encode data sebagai JSON agar bisa digunakan di JavaScript
json_encode([
  'dates' => $dates,
  'views' => $views,
]);
?>


<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tell Your Story - Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <script src="./assets/js/init-alpine.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</head>

<body>
  <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen}">
    <!-- Desktop sidebar -->
    <?php include 'aside.php'; ?>


    <div class="flex flex-col flex-1">
      <?php include 'header.php'; ?>
      <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Dashboard
          </h2>
          <!-- CTA -->
          <a class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple"
            href="profile">
            <div class="flex items-center">
              <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path
                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                </path>
              </svg>
              <span>Hi <?php echo htmlspecialchars($admin_name); ?></span>
            </div>
            <span>Profile &RightArrow;</span>
          </a>
          <!-- Cards -->
          <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
            <!-- Card -->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
              <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path
                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                  </path>
                </svg>
              </div>
              <div>
                <?php
                include '../controllers/koneksi.php'; // File koneksi database Anda
                
                // Query untuk menghitung total viewers
                $sql = "SELECT COUNT(*) AS total_views FROM viewers";
                $result = mysqli_query($conn, $sql);
                $total_views = 0; // Default jika tidak ada data
                
                if ($row = mysqli_fetch_assoc($result)) {
                  $total_views = $row['total_views'];
                }
                ?>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                  Total View
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                  <?php echo str_pad($total_views, 3, '0', STR_PAD_LEFT); ?>
                </p>
              </div>
            </div>
            <?php
            // Hubungkan ke database
            require_once '../controllers/koneksi.php';

            // Query untuk menghitung total data di tabel menfess
            $sqlCount = "SELECT COUNT(*) AS total FROM menfess";
            $resultCount = $conn->query($sqlCount);
            $totalMenfess = 0; // Inisialisasi default
            
            if ($resultCount && $resultCount->num_rows > 0) {
              $rowCount = $resultCount->fetch_assoc();
              $totalMenfess = $rowCount['total']; // Ambil total data
            }
            ?>

            <!-- Card -->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
              <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                    d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
                    clip-rule="evenodd"></path>
                </svg>
              </div>
              <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                  Total Menfess
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                  <?php echo htmlspecialchars($totalMenfess); ?>
                </p>
              </div>
            </div>

            <?php
            // Menutup koneksi
            $conn->close();
            ?>

          </div>

          <!-- New Table -->
          <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <canvas id="myChart"></canvas>
          </div>


          <!-- Charts -->
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Charts
          </h2>
          <div class="grid gap-6 mb-8 md:grid-cols-2">
            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
              <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                Revenue
              </h4>
              <canvas id="pie"></canvas>
              <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
                <!-- Chart legend -->
                <div class="flex items-center">
                  <span class="inline-block w-3 h-3 mr-1 bg-blue-500 rounded-full"></span>
                  <span>Shirts</span>
                </div>
                <div class="flex items-center">
                  <span class="inline-block w-3 h-3 mr-1 bg-teal-600 rounded-full"></span>
                  <span>Shoes</span>
                </div>
                <div class="flex items-center">
                  <span class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"></span>
                  <span>Bags</span>
                </div>
              </div>
            </div>

            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
              <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                Traffic
              </h4>
              <canvas id="line"></canvas>
              <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
                <!-- Chart legend -->
                <div class="flex items-center">
                  <span class="inline-block w-3 h-3 mr-1 bg-teal-600 rounded-full"></span>
                  <span>Total Views</span>
                </div>
              </div>
            </div>



          </div>
        </div>
      </main>
    </div>
  </div>
  <script>
    // Fetch data from the backend
    fetch('fetch_traffic_data.php') // Ganti dengan URL file PHP Anda
      .then(response => response.json())
      .then(data => {
        const ctx = document.getElementById('line').getContext('2d');
        new Chart(ctx, {
          type: 'line',
          data: {
            labels: data.dates, // Tanggal dari PHP
            datasets: [{
              label: 'Views',
              data: data.views, // Jumlah viewer dari PHP
              borderColor: 'rgba(56, 189, 248, 1)', // Warna garis
              backgroundColor: 'rgba(56, 189, 248, 0.2)', // Warna area
              fill: true,
              tension: 0.4
            }]
          },
          options: {
            responsive: true,
            plugins: {
              legend: {
                display: false // Sembunyikan legenda
              }
            },
            scales: {
              x: {
                title: {
                  display: true,
                  text: 'Date'
                }
              },
              y: {
                title: {
                  display: true,
                  text: 'Views'
                },
                beginAtZero: true
              }
            }
          }
        });
      })
      .catch(error => console.error('Error fetching data:', error));
  </script>
  <script>
    // Data dari PHP yang sudah di-encode ke dalam format JSON
    const chartData = {
      labels: <?php echo $labels_json; ?>,  // Data tanggal
      datasets: [{
        label: 'Total Menfess per Hari',
        data: <?php echo $data_json; ?>,  // Data total entri per tanggal
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
      }]
    };

    const config = {
      type: 'bar',  // Bisa diganti dengan 'line' untuk grafik gelombang
      data: chartData,
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'top',
          },
          tooltip: {
            mode: 'index',
            intersect: false,
          }
        },
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    };

    // Render grafik
    const myChart = new Chart(document.getElementById('myChart'), config);
  </script>

</body>

</html>