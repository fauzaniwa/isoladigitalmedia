<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: "#da373d",
                    },
                },
            },
        };
    </script>
    <script
        src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Schoolbell&display=swap" rel="stylesheet">
    <script src="script.js"></script>
    <style type="text/tailwindcss">
        @layer utilities {
        .content-auto {
          content-visibility: auto;
        }
      }
      .primary-font {
        font-family: "Schoolbell", cursive;
      }

      .spotify-embed iframe {
        border-radius: 8px;
        overflow: hidden;
      }
      .message-gradient {
        position: relative;
        overflow: hidden;
        max-width: 100%;
        white-space: nowrap;
        text-overflow: ellipsis;
        display: inline-block;
        -webkit-mask-image: linear-gradient(
          90deg,
          rgba(0, 0, 0, 1) 70%,
          rgba(0, 0, 0, 0) 100%
        );
        mask-image: linear-gradient(
          90deg,
          rgba(0, 0, 0, 1) 70%,
          rgba(0, 0, 0, 0) 100%
        );
      }
      .text-ellipsis {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.track-container {
  position: absolute;
  bottom: 10px;
  left: 10px;
  display: flex;
  align-items: center;
  gap: 10px;
}

.track-thumbnail {
  width: 40px; /* Ukuran gambar lebih kecil */
  height: 40px;
  object-fit: cover;
  border-radius: 8px;
}

.track-title {
  font-size: 0.8rem; /* Ukuran font lebih kecil */
  color: #333;
  text-align: left;
}
    </style>
</head>

<body>
    <nav class="p-4 border-b">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <ul class="flex justify-between text-l">
                <a href="home"><img src="src/smile-03.png" class="w-16" alt="" /></a>
                <div class="flex gap-x-7">
                    <li><a href="submit">Submit</a></li>
                    <li><a href="browse">Browse</a></li>
                    <li><a href="https://saweria.co/TellYourStory">Support</a></li>
                </div>
            </ul>
        </div>
    </nav>

    <?php
include '../process/koneksi.php';

// Cek apakah ID telah diterima melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data sesuai ID
    $query = "SELECT * FROM menfess WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Cek apakah data ditemukan
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        // Ambil data dari database
        $name = htmlspecialchars($row['name']);
        $message = htmlspecialchars($row['message']);
        $created_at = htmlspecialchars($row['created_at']);
        
        // Format tanggal
        $date = new DateTime($created_at);
        $formatted_date = $date->format('l, d F Y'); // Contoh: Rabu, 13 November 2024
        
        // Proses URL musik dan ambil ID track
        $track_url = $row['music'];
        preg_match('/track\/([a-zA-Z0-9]+)/', $track_url, $matches);
        $track_id = $matches[1] ?? $track_url;
    } else {
        echo "<p>Data tidak ditemukan untuk ID tersebut.</p>";
        exit;
    }
} else {
    echo "<p>ID tidak disediakan dalam URL.</p>";
    exit;
}
?>

<section class="mt-12 px-4 mx-auto items-center justify-center">
    <div class="max-w-7xl mx-auto text-center items-center justify-center text-xl">
        <h1 class="mb-4">
            Hello,
            <span class="primary-font"><?php echo $name; ?></span>
        </h1>
        <div class="text-md mb-4 text-gray-500">
            <h1>You've got a song from someone special.</h1>
            <h1>Give it a listen; you might love it!</h1>
        </div>
        <div class="w-full max-w-md mx-auto">
            <!-- Embed Spotify music dengan ID track -->
            <?php if (!empty($track_id)): ?>
                <iframe class="w-full h-48 border-0 rounded-lg" style="border-radius: 12px"
                        src="https://open.spotify.com/embed/track/<?php echo $track_id; ?>?utm_source=generator"
                        frameborder="0" allowfullscreen=""
                        allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
                        loading="lazy"></iframe>
            <?php else: ?>
                <p>Track ID tidak tersedia.</p>
            <?php endif; ?>
        </div>

        <h1 class="text-md mb-4 text-gray-500">The sender also left you this message:</h1>
        <h1 class="my-6 text-3xl primary-font">
            <?php echo $message; ?>
        </h1>
        <p class="mb-2 text-base">Sent on <?php echo $formatted_date; ?></p>

        <div class="gap-6 mb-12">
        <h1 class="mb-8 mt-12">Thinking about sending a tune to a friend?</h1>
        <a href="/submit.html" class="px-4 py-3 mb-12 rounded-md bg-black text-white text-base">Tell ur Story?</a>
        </div>
        
    </div>
</section>

</body>

</html>