<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="google-adsense-account" content="ca-pub-8851872691835002">
  <script src="https://cdn.tailwindcss.com"></script>
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8851872691835002"
     crossorigin="anonymous"></script>
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
  <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
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

  <section>
    <div class="max-w-7xl mx-auto text-pretty">
      <div class="text-center text-3xl mt-24 font-medium px-8">
        <h1 class="mb-2">A good story not only tell us what happened,</h1>
        <h1>but also teaches us about who we are</h1>
      </div>
      <p class="text-center mt-4 text-gray-500 mb-4">
        Express your untold message through the song
      </p>
      <div class="mx-auto flex flex-col md:flex-row gap-y-4 items-center justify-center gap-x-8">
        <a href="submit.php">
          <button class="border rounded-lg px-12 py-2 font-bold drop-shadow-md hover:bg-gray-50">
            Tell your Story :D
          </button>
        </a>
        <a href="https://saweria.co/TellYourStory">
          <button
            class="border rounded-lg px-12 py-2 font-semibold drop-shadow-md bg-black text-white hover:bg-gray-800">
            Support Dong :'
          </button>
        </a>
      </div>
    </div>
  </section>

  <section class="mt-12">
    <div class="max-w-7xl mx-auto p-4 items-center">
      <!-- Kontainer untuk konten bergerak dari kanan ke kiri -->
      <div class="scrolling-container">
        <div class="scrolling-content flex gap-4">
          <?php
          include '../process/koneksi.php';

          $query = "SELECT * FROM menfess ORDER BY created_at DESC LIMIT 20";

          $result = mysqli_query($conn, $query);

          if (!$result) {
            echo "<p>Error fetching data: " . mysqli_error($conn) . "</p>";
          }

          while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="border rounded-lg p-4 w-[300px] md:w-[400px]">
              <h1 class="mb-2">To: <?php echo htmlspecialchars($row['name']); ?></h1>
              <div class="border-b mb-2"></div>

              <?php
              $message = htmlspecialchars($row['message']);
              $display_message = strlen($message) > 35 ? substr($message, 0, 35) . "..." : $message;
              ?>

              <h1 class="mb-2 primary-font message-gradient">
                <?php echo $display_message; ?>
              </h1>

              <?php
              $track_url = $row['music'];
              preg_match('/track\/([a-zA-Z0-9]+)/', $track_url, $matches);
              $track_id = $matches[1] ?? $track_url;
              ?>

              <?php if (!empty($track_id)): ?>
                <div class="flex items-center p-4 bg-white space-x-4 flex-wrap justify-between sm:space-x-6">
                  <div class="spotify-embed flex items-center gap-4 sm:gap-6 w-full sm:w-auto">
                    <!-- Thumbnail -->
                    <div class="w-12 h-12 overflow-hidden rounded-md">
                      <img id="track-thumbnail-<?php echo htmlspecialchars($track_id); ?>" src="" alt="Track Thumbnail"
                        class="object-cover w-full h-full" />
                    </div>

                    <!-- Title -->
                    <div
                      class="flex flex-col justify-center items-center px-4 py-2 rounded-lg bg-gray-100 w-full sm:w-auto">
                      <?php
                      // Membatasi panjang judul hingga 15 karakter dan menambahkan "..." jika terlalu panjang
                      $limited_title = (strlen($row['title']) > 15) ? substr($row['title'], 0, 15) . "..." : $row['title'];
                      ?>
                      <p id="track-title-<?php echo htmlspecialchars($track_id); ?>"
                        class="text-sm sm:text-base font-semibold text-gray-800 text-center">
                        <?php echo htmlspecialchars($limited_title); ?>
                      </p>
                    </div>

                  </div>
                </div>

                <script>
                  // Fetch oEmbed data from Spotify API
                  fetch('https://open.spotify.com/oembed?url=<?php echo urlencode("https://open.spotify.com/track/" . $track_id); ?>')
                    .then(response => response.json())
                    .then(data => {
                      // Set thumbnail and title dynamically
                      document.getElementById("track-thumbnail-<?php echo htmlspecialchars($track_id); ?>").src = data.thumbnail_url;
                      document.getElementById("track-title-<?php echo htmlspecialchars($track_id); ?>").textContent = data.title;
                    })
                    .catch(error => console.error('Error fetching oEmbed data:', error));
                </script>
              <?php else: ?>
                <p>Track ID not available.</p>
              <?php endif; ?>
            </div>
          <?php endwhile; ?>
        </div>
      </div>

      <!-- Kontainer untuk konten bergerak dari kiri ke kanan -->
      <div class="scrolling-container-reverse">
        <div class="scrolling-content-reverse flex gap-4">
          <?php
          include '../process/koneksi.php';

          $query = "SELECT * FROM menfess ORDER BY created_at DESC LIMIT 15";

          $result = mysqli_query($conn, $query);

          if (!$result) {
            echo "<p>Error fetching data: " . mysqli_error($conn) . "</p>";
          }

          while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="border rounded-lg p-4 w-[300px] md:w-[400px]">
              <h1 class="mb-2">To: <?php echo htmlspecialchars($row['name']); ?></h1>
              <div class="border-b mb-2"></div>

              <?php
              $message = htmlspecialchars($row['message']);
              $display_message = strlen($message) > 35 ? substr($message, 0, 35) . "..." : $message;
              ?>

              <h1 class="mb-2 primary-font message-gradient">
                <?php echo $display_message; ?>
              </h1>

              <?php
              $track_url = $row['music'];
              preg_match('/track\/([a-zA-Z0-9]+)/', $track_url, $matches);
              $track_id = $matches[1] ?? $track_url;
              ?>

              <?php if (!empty($track_id)): ?>
                <div class="flex items-center p-4 bg-white space-x-4 flex-wrap justify-between sm:space-x-6">
                  <div class="spotify-embed flex items-center gap-4 sm:gap-6 w-full sm:w-auto">
                    <!-- Thumbnail -->
                    <div class="w-12 h-12 overflow-hidden rounded-md">
                      <img id="track-thumbnail2-<?php echo htmlspecialchars($track_id); ?>" src="" alt="Track Thumbnail"
                        class="object-cover w-full h-full" />
                    </div>

                    <!-- Title -->
                    <div
                      class="flex flex-col justify-center items-center px-4 py-2 rounded-lg bg-gray-100 w-full sm:w-auto">
                      <?php
                      // Membatasi panjang judul hingga 15 karakter dan menambahkan "..." jika terlalu panjang
                      $limited_title = (strlen($row['title']) > 15) ? substr($row['title'], 0, 15) . "..." : $row['title'];
                      ?>
                      <p id="track-title2-<?php echo htmlspecialchars($track_id); ?>"
                        class="text-sm sm:text-base font-semibold text-gray-800 text-center">
                        <?php echo htmlspecialchars($limited_title); ?>
                      </p>
                    </div>

                  </div>
                </div>

                <script>
                  // Fetch oEmbed data from Spotify API
                  fetch('https://open.spotify.com/oembed?url=<?php echo urlencode("https://open.spotify.com/track/" . $track_id); ?>')
                    .then(response => response.json())
                    .then(data => {
                      // Set thumbnail and title dynamically
                      document.getElementById("track-thumbnail2-<?php echo htmlspecialchars($track_id); ?>").src = data.thumbnail_url;
                      document.getElementById("track-title2-<?php echo htmlspecialchars($track_id); ?>").textContent = data.title;
                    })
                    .catch(error => console.error('Error fetching oEmbed data:', error));
                </script>
              <?php else: ?>
                <p>Track ID not available.</p>
              <?php endif; ?>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  </section>
  
  <footer class="mt-12 p-4 text-black text-center">
  <p class="text-sm">
    Inspired by <a href="https://sendthesong.xyz" target="_blank" class="text-blue-400 hover:underline">https://sendthesong.xyz</a>
  </p>
</footer>
  
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8851872691835002"
     crossorigin="anonymous"></script>
<!-- Ads -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8851872691835002"
     data-ad-slot="9416631146"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>

  <!-- Add some custom CSS for both directions -->
  <style>
    .scrolling-container,
    .scrolling-container-reverse {
      position: relative;
      width: 100%;
      overflow: hidden;
      margin-bottom: 20px;
    }

    .scrolling-content,
    .scrolling-content-reverse {
      display: flex;
      animation: scroll-left 20s linear infinite;
    }

    .scrolling-content-reverse {
      animation: scroll-right 20s linear infinite;
    }

    .scrolling-content>div,
    .scrolling-content-reverse>div {
      margin-right: 16px;
      flex-shrink: 0;
    }

    @keyframes scroll-left {
      0% {
        transform: translateX(100%);
      }

      100% {
        transform: translateX(-100%);
      }
    }

    @keyframes scroll-right {
      0% {
        transform: translateX(-100%);
      }

      100% {
        transform: translateX(100%);
      }
    }

    .scrolling-container::before,
    .scrolling-container-reverse::after {
      content: '';
      position: absolute;
      top: 0;
      width: 50px;
      height: 100%;
      background: linear-gradient(to left, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1));
      pointer-events: none;
    }

    .scrolling-container-reverse::before,
    .scrolling-container::after {
      content: '';
      position: absolute;
      top: 0;
      width: 50px;
      height: 100%;
      background: linear-gradient(to right, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1));
      pointer-events: none;
    }

    .scrolling-container::before {
      left: 0;
    }

    .scrolling-container-reverse::after {
      right: 0;
    }
  </style>



</body>

</html>