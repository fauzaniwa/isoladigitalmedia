<?php
include '../process/koneksi.php';

$offset = isset($_GET['offset']) ? (int) $_GET['offset'] : 0;

$query = "
    SELECT 
        m.id, 
        m.name, 
        m.usernameig, 
        m.message, 
        m.music, 
        m.views, 
        m.created_at,
        COUNT(c.id) AS total_comments
    FROM menfess m
    LEFT JOIN comment c ON m.id = c.menfess_id
    GROUP BY m.id ORDER BY m.created_at DESC LIMIT 10 OFFSET $offset";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0):
    while ($row = mysqli_fetch_assoc($result)):
        $id = htmlspecialchars($row['id']);
        $name = htmlspecialchars($row['name']);
        $name = strlen($name) > 15 ? substr($name, 0, 15) . "..." : $name;
        $usernameig = htmlspecialchars($row['usernameig'] ?? 'Anonymous');
        $message = htmlspecialchars($row['message']);
        $display_message = strlen($message) > 35 ? substr($message, 0, 35) . "..." : $message;

        $track_url = $row['music'];
        preg_match('/track\/([a-zA-Z0-9]+)/', $track_url, $matches);
        $track_id = $matches[1] ?? null;
        ?>
        <!-- Card link -->
        <a href="clicked.php?id=<?php echo $id; ?>" class="bg-white shadow-md rounded-md p-6 card-hover">
            <p class="text-lg font-bold"><?php echo $name; ?></p>
            <p class="flex items-center text-gray-600">
                <i class="bi bi-instagram text-xl mr-2"></i><?php echo $usernameig; ?>
            </p>
            <p class="my-4 font-primary text-2xl"><?php echo $display_message; ?></p>

            <?php if (!empty($track_id)): ?>
                <div class="flex items-center">
                    <div class="w-12 h-12 overflow-hidden rounded-md mr-2">
                        <img id="track-thumbnail-<?php echo htmlspecialchars($track_id); ?>" src=""
                            alt="Track Thumbnail" class="object-cover w-full h-full" />
                    </div>
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
                    <i class="bi bi-eye mr-2"></i><?php echo htmlspecialchars($row['views'] ?? 0); ?>
                </span>
                <span class="flex items-center">
                    <i class="bi bi-chat-dots mr-2"></i><?php echo htmlspecialchars($row['total_comments'] ?? 0); ?>
                </span>
            </div>
        </a>
    <?php endwhile;
endif;

mysqli_close($conn);
?>
