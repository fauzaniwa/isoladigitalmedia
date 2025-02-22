<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="google-adsense-account" content="ca-pub-8851872691835002">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8851872691835002"
     crossorigin="anonymous"></script>
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

<body class="flex flex-col min-h-screen">
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



  <section class="mt-12 px-4 flex-grow items-center justify-center">
    <form class="max-w-2xl mx-auto" method="GET" action="">
      <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
      <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
          <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
          </svg>
        </div>
        <input type="search" name="search" id="default-search"
          class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50"
          placeholder="Search Name"
          value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" required />
        <button type="submit"
          class="text-white absolute end-2.5 bottom-2.5 bg-black hover:bg-gray-800 font-medium rounded-lg text-sm px-4 py-2">
          Search
        </button>
      </div>
    </form>
  </section>

  <section class="mt-12 px-4 flex-grow items-center justify-center">
    <div class="max-w-7xl mx-auto p-4 items-center">
      <div class="mx-auto items-center justify-center gap-x-4 gap-y-4 flex flex-wrap">
        <?php
        include '../process/koneksi.php';

        // Check if search input exists
        $search_term = isset($_GET['search']) ? $_GET['search'] : '';

        // If no search term, display the message
        if (!$search_term) {
          echo "<p class='text-center text-gray-600'>Harap lakukan pencarian</p>";
        } else {
          // Adjust query based on search input
          $query = "SELECT * FROM menfess WHERE name LIKE '%$search_term%' LIMIT 10";
          $result = mysqli_query($conn, $query);

          if (!$result) {
            echo "<p>Error fetching data: " . mysqli_error($conn) . "</p>";
          } else {
            // Check if any results found
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)):
                $id = htmlspecialchars($row['id']); // Ambil ID untuk digunakan di link
                ?>

                <!-- Card link -->
                <a href="clicked.php?id=<?php echo $id; ?>"
                  class="border rounded-lg p-4 w-full md:w-[400px] block hover:bg-gray-100 transition">
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
                        <div class="flex flex-col justify-center items-center px-4 py-2 rounded-lg bg-gray-100 w-full sm:w-auto">
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
                </a>

              <?php endwhile;
            } else {
              echo "<p class='text-center text-gray-600'>Tidak ada hasil untuk pencarian ini.</p>";
            }
          }
        }
        ?>
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
<!-- Ads Browse -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8851872691835002"
     data-ad-slot="8103549472"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>

</body>

</html>