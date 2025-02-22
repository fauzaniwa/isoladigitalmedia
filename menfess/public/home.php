<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FessUp - Home</title>
  <link rel="icon" href="src/favicon.png" type="image/png">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="stylesmenfess.css">
  <style>
        .love-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
        }
        .love {
            position: absolute;
            bottom: 0;
            left: 50%;
            animation: floatUp linear infinite;
        }
        @keyframes floatUp {
            0% {
                transform: translateY(0);
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh);
                opacity: 0;
            }
        }
    </style>
</head>

<body class="bg-pink-light text-pink-main">
  <?php
  include 'track_viewers.php';
  ?>

  <?php
  include 'navbar.php'; ?>
  
  <!-- Modal -->
<!--<div id="modalGiveaway"-->
<!--  class="fixed flex inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-10">-->
<!--  <div class="bg-white rounded-lg shadow-lg p-6 w-96">-->
    <!-- Modal Header -->
<!--    <div class="flex justify-between items-center mb-4">-->
<!--      <h2 class="text-xl font-bold text-gray-700">🎁 GiveAway Alert! 🎁</h2>-->
<!--    </div>-->
    <!-- Modal Content -->
<!--    <p class="text-gray-700 mb-4">-->
<!--      Screenshot momen apa aja dari website ini, terus upload ke Instagram Story kamu. Jangan lupa tambahkan link -->
<!--      <span class="font-semibold text-blue-500">(https://bit.ly/Fess-Up)</span> -->
<!--      dan tag kami di -->
<!--      <span class="font-semibold text-yellow-500">@isoladigitalmedia</span>!  -->
<!--    </p>-->
<!--    <p class="text-gray-700 mb-4 font-bold">-->
<!--      Hadiah Rp50.000 untuk 2 orang beruntung menunggu kamu! 🎉-->
<!--    </p>-->
<!--    <p class="text-gray-700 mb-4">-->
<!--      Jangan lupa daftar sekarang untuk validasi partisipasi kamu melalui tombol di bawah ini!-->
<!--    </p>-->
    <!-- Buttons -->
<!--    <div class="flex justify-between items-center">-->
<!--      <button id="closeModalGiveaway"-->
<!--        class="btn-secondary text-gray-700 px-6 py-2 rounded-md font-semibold shadow-md hover:shadow-lg">-->
<!--        Nanti Dulu-->
<!--      </button>-->
<!--      <a href="https://docs.google.com/forms/d/e/1FAIpQLSdUqcSK7G3gJcyZks4PTuJQCeElbr7F3xILhgBoGUThxWFO0g/viewform"-->
<!--        target="_blank"-->
<!--        class="btn-primary text-white px-6 py-2 rounded-md font-semibold shadow-md hover:shadow-lg">-->
<!--        Daftar Sekarang-->
<!--      </a>-->
<!--    </div>-->
<!--  </div>-->
<!--</div>-->




  <!-- Floating Button -->
  <div class="floatingtoogle fixed bottom-6 right-6">
    <!-- Parent Button -->
    <button id="toggleMenu"
      class="bg-pink-600 text-white w-16 h-16 md:w-16 md:h-16 rounded-full shadow-lg flex justify-center items-center hover:bg-pink-700">
      <i class="bi bi-pencil-square text-2xl md:text-3xl"></i>
    </button>
    <div id="menuItems" class="hidden flex flex-col items-end gap-2 mt-2">
      <a href="submit" class="bg-white text-pink-600 px-4 py-2 rounded-md shadow-md hover:bg-pink-100">
        Create Menfess
      </a>
      <a href="submitmutual" class="bg-white text-pink-600 px-4 py-2 rounded-md shadow-md hover:bg-pink-100">
        Create Mutual
      </a>

    </div>
  </div>


    <!-- Hero Section -->
    <section class="py-10 px-5 md:py-20 bg-white relative overflow-hidden">
        <div class="love-bg"></div>
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center">
            <!-- Text Section -->
            <div class="md:w-1/2 text-center md:text-left">
                <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4">Ehem... Confess bisa kali!</h2>
                <p class="text-gray-700 text-lg mb-6">Sebenernya, selama ini aku memendam rasa. Tapi kalau dipendam terus, takutnya nanti jamuran. Jadi... di Hari Valentine ini, maukah kau jadi alasanku borong coklat diskonan?</p>
                <button class="btn-yellow w-64 px-8 py-3 rounded-xl font-semibold shadow-md card-hover">
                    Let's See
                </button>
            </div>
            <!-- Image Section -->
            <div class="md:w-1/2 mt-6 md:mt-0 flex justify-center">
                <img src="src/hero1.jpg" alt="Printing Process" class="rounded-xl shadow-md w-full md:max-w-md">
            </div>
        </div>
    </section>


  <!-- Featured Section -->
  <section class="py-16 bg-pink-light flex items-center justify-center">
    <div class="container mx-auto text-center">
      <h2 class="text-3xl font-extrabold text-pink-main mb-10">Main Featured</h2>
      <div class="items-center justify-center grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <!-- Card -->
        <div class="bg-white rounded-lg shadow-md p-6 card-animated">
          <h3 class="text-xl font-semibold text-pink-main mb-4">Send Menfess</h3>
          <p class="text-pink-main mb-6">Send anonymous messages.</p>
          <a href="submit"><button class="btn-primary text-white w-full py-2 rounded-md">Start</button></a>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6 card-animated">
          <h3 class="text-xl font-semibold text-pink-main mb-4">Browse Menfess</h3>
          <p class="text-pink-main mb-6">Search messages by Name or Instagram Username.</p>
          <a href="browse"><button class="btn-primary text-white w-full py-2 rounded-md">Search</button></a>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6 card-animated">
          <h3 class="text-xl font-semibold text-pink-main mb-4">Spotify Mutuals</h3>
          <p class="text-pink-main mb-6">Share music or follow each other.</p>
          <a href="mutual"><button class="btn-primary text-white w-full py-2 rounded-md">Join</button></a>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6 card-animated">
          <h3 class="text-xl font-semibold text-pink-main mb-4">Details & Comments</h3>
          <p class="text-pink-main mb-6">View messages or comment anonymously.</p>
          <a href="browse"><button class="btn-primary text-white w-full py-2 rounded-md">View</button></a>
        </div>
      </div>
    </div>
  </section>


  <!-- Card Section -->
  <section class="py-10 bg-main">
    <h2 class="text-3xl font-extrabold text-center text-white mb-10">Latest Menfess</h2>
    <div class="bg-[#FBC0D2] rounded-xl container mx-auto p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div class="p-4">
        <p class="text-2xl font-bold text-gray-800">Yakali Dipendam!</p>
        <p class="my-4 text-gray-800 text-lg">Kirim menfess kamu di sini! Mood apa aja boleh masuk: lucu, romantis,
          baper, atau bahkan absurd. Ceritain aja sesuai vibes kamu, bikin seru, bikin rame!</p>
        <a href="mutual"><button class="btn-primary text-white px-8 py-3 rounded-md">Create</button></a>

      </div>
      <?php
      include '../process/koneksi.php';

      $query = "
      SELECT 
        m.id, 
        m.name, 
        m.usernameig, 
        m.message, 
        m.music, 
        m.views, 
        m.comment, 
        m.created_at,
        COUNT(c.id) AS total_comments
      FROM menfess m
      LEFT JOIN comment c ON m.id = c.menfess_id
      GROUP BY m.id
      ORDER BY m.created_at DESC
      LIMIT 15
    ";
      $result = mysqli_query($conn, $query);

      if (!$result) {
        echo "<p>Error fetching data: " . mysqli_error($conn) . "</p>";
      }

      while ($row = mysqli_fetch_assoc($result)):
        $name = htmlspecialchars($row['name']);
        $usernameig = htmlspecialchars($row['usernameig'] ?? 'Anonymous');
        $message = htmlspecialchars($row['message']);
        $display_message = strlen($message) > 35 ? substr($message, 0, 35) . "..." : $message;

        $track_url = $row['music'];
        preg_match('/track\/([a-zA-Z0-9]+)/', $track_url, $matches);
        $track_id = $matches[1] ?? null;

        $menfess_id = $row['id'];
        ?>
        <!-- Card -->
        <div class="bg-white shadow-md rounded-xl p-6 card-hover animated-card batch-card"
          id="menfess-<?php echo $menfess_id; ?>">
          <p class="text-lg font-bold"><?php echo $name; ?></p>
          <p class="flex items-center text-gray-600">
            <i class="bi bi-instagram text-xl mr-2"></i><?php echo $usernameig; ?>
          </p>
          <p class="my-4 font-primary text-2xl"><?php echo $display_message; ?></p>

          <?php if (!empty($track_id)): ?>
            <div class="flex items-center">
              <!-- Thumbnail -->
              <div class="w-12 h-12 overflow-hidden rounded-md mr-2">
                <img id="track-thumbnail-<?php echo htmlspecialchars($track_id); ?>" src="" alt="Track Thumbnail"
                  class="object-cover w-full h-full" />
              </div>
              <!-- Title -->
              <span id="track-title-<?php echo htmlspecialchars($track_id); ?>"
                class="text-pink-main hover:underline">Loading...</span>
            </div>
            <script>
              fetch('https://open.spotify.com/oembed?url=<?php echo urlencode("https://open.spotify.com/track/" . $track_id); ?>')
                .then(response => response.json())
                .then(data => {
                  document.getElementById("track-title-<?php echo htmlspecialchars($track_id); ?>").textContent = data.title;
                  document.getElementById("track-thumbnail-<?php echo htmlspecialchars($track_id); ?>").src = data.thumbnail_url;
                })
                .catch(error => console.error('Error fetching oEmbed data:', error));
            </script>
          <?php else: ?>
            <p>No track available.</p>
          <?php endif; ?>

          <div class="flex justify-start gap-6 items-center mt-4">
            <span class="flex items-center">
              <i class="bi bi-eye mr-2"></i><span
                id="views-<?php echo $menfess_id; ?>"><?php echo htmlspecialchars($row['views'] ?? 0); ?></span>
            </span>
            <span class="flex items-center">
              <i class="bi bi-chat-dots mr-2"></i><?php echo htmlspecialchars($row['total_comments'] ?? 0); ?>
            </span>
          </div>
        </div>
        <script>
          window.addEventListener('load', function () {
            var menfessId = <?php echo $menfess_id; ?>;

            fetch('update_views.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
              },
              body: 'id=' + menfessId
            })
              .then(response => response.json())
              .then(data => {
                if (data.success) {
                  var viewsElement = document.getElementById('views-' + menfessId);
                  viewsElement.textContent = data.new_views;
                }
              })
              .catch(error => console.error('Error updating views:', error));
          });
        </script>
      <?php endwhile; ?>
    </div>

    <div class="text-center mt-6">
      <a href="menfess" class="btn-yellow w-64 px-8 py-3 rounded-xl font-semibold shadow-md card-hover">View More</a>

    </div>
  </section>



  <section class="py-20 bg-pink-light">
    <div class="container mx-auto">
      <h2 class="text-3xl font-extrabold text-pink-main mb-6 text-center">Spotify Mutuals</h2>
      <p class="text-lg text-gray-700 mb-10 text-center">Find friends with the same favorite music.</p>

      <!-- Desktop View -->
      <div class="hidden md:grid rounded-xl container mx-auto p-6 grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <div class="p-4">
          <p class="text-2xl font-bold text-gray-800">Mutual Yuk!</p>
          <p class="my-4 text-gray-800 text-lg">Kirimin playlist Spotify kamu di sini! Mood apa aja boleh masuk: chill,
            energik, mellow, atau bahkan lagu-lagu yang bikin kamu merasa seperti bintang rock. Share aja playlist
            sesuai vibes kamu, bikin semua orang ikutan dengerin!</p>
          <a href="mutual"><button class="btn-primary text-white px-8 py-3 rounded-md">View More</button></a>
        </div>
        <?php
        include '../process/koneksi.php';

        $query = "SELECT * FROM mutual ORDER BY created_at DESC LIMIT 7";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)):
          $name = htmlspecialchars($row['name']);
          $caption = htmlspecialchars($row['caption']);
          $tags = explode(',', htmlspecialchars($row['tags']));
          $link_spotify = htmlspecialchars($row['link_spotify']);

          // Generate random avatar
          $random_avatar_number = rand(1, 10);
          $avatar_image = "src/avatar ({$random_avatar_number}).png";
          ?>
          <div class="bg-white shadow-xl rounded-xl p-6 text-center">
            <img src="<?php echo $avatar_image; ?>" alt="User Avatar" class="w-20 h-20 rounded-full mx-auto mb-4">
            <h3 class="text-xl font-bold text-pink-main mb-2"><?php echo $name; ?></h3>
            <div class="flex flex-wrap justify-center gap-2 mb-4">
              <?php foreach ($tags as $tag): ?>
                <span class="bg-[#ABD1FA] text-blue-600 text-sm px-3 py-1 rounded-xl">
                  <?php echo $tag; ?>
                </span>
              <?php endforeach; ?>
            </div>
            <p class="text-gray-500 mb-4"><?php echo $caption; ?></p>
            <a href="<?php echo $link_spotify; ?>" target="_blank"
              class="btn-primary px-6 py-2 rounded-md text-white font-semibold bg-pink-main hover:bg-pink-700">
              Connect
            </a>
          </div>
        <?php endwhile; ?>
      </div>

      <!-- Mobile View -->
      <div class="block md:hidden relative bg-secondary container mx-auto overflow-hidden py-6 gap-6">

        <div class="w-full p-6 bg-[#FCD9E4]">
          <div id="mobile-carousel" class="flex space-x-4 mb-4">
            <?php
            mysqli_data_seek($result, 0); // Reset result pointer for reuse
            while ($row = mysqli_fetch_assoc($result)):
              $name = htmlspecialchars($row['name']);
              $caption = htmlspecialchars($row['caption']);
              $tags = explode(',', htmlspecialchars($row['tags']));
              $link_spotify = htmlspecialchars($row['link_spotify']);

              // Generate random avatar
              $random_avatar_number = rand(1, 10);
              $avatar_image = "src/avatar ({$random_avatar_number}).png";
              ?>
              <div class="bg-white shadow-lg rounded-lg p-6 text-center min-w-[80%]">
                <img src="<?php echo $avatar_image; ?>" alt="User Avatar" class="w-20 h-20 rounded-full mx-auto mb-4">
                <h3 class="text-xl font-bold text-pink-main mb-2"><?php echo $name; ?></h3>
                <div class="flex flex-wrap justify-center gap-2 mb-4">
                  <?php foreach ($tags as $tag): ?>
                    <span class="bg-[#ABD1FA] text-blue-600 text-sm px-3 py-1 rounded-xl">
                      <?php echo $tag; ?>
                    </span>
                  <?php endforeach; ?>
                </div>
                <p class="text-gray-500 mb-4"><?php echo $caption; ?></p>
                <a href="<?php echo $link_spotify; ?>" target="_blank"
                  class="btn-primary px-6 py-2 rounded-md text-white font-semibold bg-pink-main hover:bg-pink-700">
                  Connect
                </a>
              </div>
            <?php endwhile; ?>
          </div>

          <div id="mobile-carousel2" class="flex space-x-4 mb-4">
            <?php
            mysqli_data_seek($result, 0); // Reset result pointer for reuse
            while ($row = mysqli_fetch_assoc($result)):
              $name = htmlspecialchars($row['name']);
              $caption = htmlspecialchars($row['caption']);
              $tags = explode(',', htmlspecialchars($row['tags']));
              $link_spotify = htmlspecialchars($row['link_spotify']);

              // Generate random avatar
              $random_avatar_number = rand(1, 10);
              $avatar_image = "src/avatar ({$random_avatar_number}).png";
              ?>
              <div class="bg-white shadow-lg rounded-lg p-6 text-center min-w-[80%]">
                <img src="<?php echo $avatar_image; ?>" alt="User Avatar" class="w-20 h-20 rounded-full mx-auto mb-4">
                <h3 class="text-xl font-bold text-pink-main mb-2"><?php echo $name; ?></h3>
                <div class="flex flex-wrap justify-center gap-2 mb-4">
                  <?php foreach ($tags as $tag): ?>
                    <span class="bg-[#ABD1FA] text-blue-600 text-sm px-3 py-1 rounded-xl">
                      <?php echo $tag; ?>
                    </span>
                  <?php endforeach; ?>
                </div>
                <p class="text-gray-500 mb-4"><?php echo $caption; ?></p>
                <a href="<?php echo $link_spotify; ?>" target="_blank"
                  class="btn-primary px-6 py-2 rounded-md text-white font-semibold bg-pink-main hover:bg-pink-700">
                  Connect
                </a>
              </div>
            <?php endwhile; ?>
          </div>
        </div>


        <div class="text-center mt-6">
          <a href="mutual" class="btn-yellow w-64 px-8 py-3 rounded-xl font-semibold shadow-md card-hover">View
            More</a>

        </div>

      </div>
    </div>
  </section>



  <!-- Spotify Mutual Section -->
  <section class="py-20 bg-pink-light">
    <div class="container mx-auto text-center">
      <h2 class="text-3xl font-extrabold text-center text-pink-main mb-10">Part Of</h2>
      <div class="relative overflow-hidden w-full py-6">
        <!-- Kontainer untuk gambar -->
        <div class="flex gap-4 animate-slider">

          <img src="src/Asset 1.png" alt="Photo 1" class="h-36 object-cover rounded-lg" />
          
          <img src="src/Asset 9.png" alt="Photo 9" class="h-36 object-cover rounded-lg" />

          <img src="src/Asset 2.png" alt="Photo 2" class="h-36 object-cover rounded-lg" />

          <img src="src/Asset 3.png" alt="Photo 3" class="h-36 object-cover rounded-lg" />

          <img src="src/Asset 4.png" alt="Photo 4" class="h-36 object-cover rounded-lg" />

          <img src="src/Asset 5.png" alt="Photo 5" class="h-36 object-cover rounded-lg" />

          <img src="src/Asset 6.png" alt="Photo 6" class="h-36 object-cover rounded-lg" />

          <img src="src/Asset 7.png" alt="Photo 7" class="h-36 object-cover rounded-lg" />

          <img src="src/Asset 8.png" alt="Photo 8" class="h-36 object-cover rounded-lg" />

          <img src="src/Asset 1.png" alt="Photo 1" class="h-36 object-cover rounded-lg" />
          
          <img src="src/Asset 9.png" alt="Photo 9" class="h-36 object-cover rounded-lg" />

          <img src="src/Asset 2.png" alt="Photo 2" class="h-36 object-cover rounded-lg" />

          <img src="src/Asset 3.png" alt="Photo 3" class="h-36 object-cover rounded-lg" />

          <img src="src/Asset 4.png" alt="Photo 4" class="h-36 object-cover rounded-lg" />

          <img src="src/Asset 5.png" alt="Photo 5" class="h-36 object-cover rounded-lg" />

          <img src="src/Asset 6.png" alt="Photo 6" class="h-36 object-cover rounded-lg" />

          <img src="src/Asset 7.png" alt="Photo 7" class="h-36 object-cover rounded-lg" />

          <img src="src/Asset 8.png" alt="Photo 8" class="h-36 object-cover rounded-lg" />

        </div>
      </div>
    </div>
  </section>



  <?php
  include 'footer.php';
  ?>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const carousel = document.getElementById('mobile-carousel');

      // Duplicate items to make an infinite loop effect
      const items = Array.from(carousel.children);
      items.forEach(item => {
        const clone = item.cloneNode(true);
        carousel.appendChild(clone);
      });
    });
  </script>

  <script>
    const toggleButton = document.getElementById('toggleMenu');
    const menuItems = document.getElementById('menuItems');

    toggleButton.addEventListener('click', () => {
      menuItems.classList.toggle('hidden');
    });
  </script>
  <!-- JavaScript for Modal -->
  <script>
    const openModalButton = document.getElementById('openModal');
    const closeModalButton = document.getElementById('closeModal');
    const modalBackground = document.getElementById('modalBackground');

    openModalButton.addEventListener('click', () => {
      modalBackground.classList.remove('hidden');
      modalBackground.classList.add('flex');
    });

    closeModalButton.addEventListener('click', () => {
      modalBackground.classList.add('hidden');
    });

    modalBackground.addEventListener('click', (e) => {
      if (e.target === modalBackground) {
        modalBackground.classList.add('hidden');
      }
    });
  </script>


  <!-- JavaScript for Toggle Navbar -->
  <script>
    const navToggle = document.getElementById('navToggle');
    const navMenuMobile = document.getElementById('navMenuMobile');

    navToggle.addEventListener('click', () => {
      navMenuMobile.classList.toggle('hidden');
    });
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const cards = document.querySelectorAll(".animated-card");
      cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.2}s`;
      });
    });
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const cards = document.querySelectorAll(".batch-card");
      let batchSize = 5; 
      const mobileBatchSize = 2; 
      let currentBatch = 0;

      
      function updateBatchSize() {
        if (window.innerWidth <= 768) { 
          batchSize = mobileBatchSize;
        } else {
          batchSize = 5; 
        }
      }

      function showBatch() {
        const start = currentBatch * batchSize;
        const end = start + batchSize;

        cards.forEach((card, index) => {
          card.classList.remove("active");
          if (index >= start && index < end) {
            card.classList.add("active");
            card.style.animationDelay = `${(index % batchSize) * 0.2}s`;
          }
        });

        currentBatch++;
        if (start >= cards.length) {
          currentBatch = 0;
        }
      }

      updateBatchSize();
      window.addEventListener("resize", updateBatchSize);

      showBatch();
      setInterval(showBatch, 5000);
    });
  </script>
  
<script>
//   const modalGiveaway = document.getElementById("modalGiveaway");
//   const closeModalGiveaway = document.getElementById("closeModalGiveaway");

//   function openModal() {
//     modalGiveaway.classList.remove("hidden");
//   }

//   closeModalGiveaway.addEventListener("click", () => {
//     modalGiveaway.classList.add("hidden");
//   });

//   window.onload = () => {
//     setTimeout(openModal, 2000); 
//   }; 
</script>
<script>
        document.addEventListener("DOMContentLoaded", () => {
            const loveBg = document.querySelector(".love-bg");
            function getRandomColor() {
                return Math.random() > 0.5 ? "#F44379" : "#FF66A1";
            }
            function createLove() {
                const love = document.createElementNS("http://www.w3.org/2000/svg", "svg");
                love.setAttribute("class", "love");
                love.setAttribute("viewBox", "0 0 24 24");
                love.innerHTML = '<path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path>';
                const size = Math.random() * 40 + 20;
                love.style.width = `${size}px`;
                love.style.height = `${size}px`;
                love.style.fill = getRandomColor();
                love.style.left = `${Math.random() * 100}%`;
                love.style.animationDuration = `${Math.random() * 3 + 2}s`;
                loveBg.appendChild(love);
                setTimeout(() => love.remove(), 5000);
            }
            setInterval(createLove, 500);
        });
    </script>




</body>

</html>