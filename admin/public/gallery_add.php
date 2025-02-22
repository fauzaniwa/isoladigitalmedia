<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gallery Add - IDM</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="./assets/js/init-alpine.js"></script>
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
                        Add Image
                    </h2>
                    <form action="../controllers/insert_gallery.php" method="POST" enctype="multipart/form-data">
                        <div class="mt-4 mb-6">
                            <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">Tambah
                                Gallery</p>
                            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                                <div id="image-upload-container">
                                    <!-- Initial Image Upload and Title Fields -->
                                    <div class="image-upload-wrapper">
                                        <label class="block text-sm">
                                            <span class="text-gray-700 dark:text-gray-400">File (PNG/JPG)</span>
                                            <input
                                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                                type="file" name="images[]" accept="image/png, image/jpeg" required
                                                onchange="previewImages(this)">
                                        </label>
                                        <label class="block text-sm mt-2">
                                            <span class="text-gray-700 dark:text-gray-400">Judul</span>
                                            <input
                                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                                type="text" name="judul[]" required placeholder="Judul Gallery">
                                        </label>
                                        <div class="preview mt-2"></div>
                                    </div>
                                </div>
                                <!-- Add More Button -->
                                <button type="button" id="add-more"
                                    class="mt-4 px-3 py-2 bg-purple-600 text-white rounded-md focus:outline-none">Add
                                    More</button>
                            </div>
                        </div>
                        <footer>
                            <button type="button" onclick="history.back()"
                                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                                Cancel
                            </button>
                            <button type="submit"
                                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                Accept
                            </button>
                        </footer>
                    </form>

                    <script>
                        let imageCount = 1;
                        const maxImages = 10;

                        document.getElementById('add-more').addEventListener('click', function () {
                            if (imageCount < maxImages) {
                                const container = document.getElementById('image-upload-container');
                                const wrapper = document.createElement('div');
                                wrapper.classList.add('image-upload-wrapper', 'mt-4');
                                wrapper.innerHTML = `
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">File (PNG/JPG)</span>
                    <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" type="file" name="images[]" accept="image/png, image/jpeg" required onchange="previewImages(this)">
                </label>
                <label class="block text-sm mt-2">
                    <span class="text-gray-700 dark:text-gray-400">Judul</span>
                    <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" type="text" name="judul[]" required placeholder="Judul Gallery">
                </label>
                <div class="preview mt-2"></div>
            `;
                                container.appendChild(wrapper);
                                imageCount++;
                            } else {
                                alert('You can only upload up to 10 images.');
                            }
                        });

                        function previewImages(input) {
                            const previewContainer = input.closest('.image-upload-wrapper').querySelector('.preview');
                            previewContainer.innerHTML = '';

                            if (input.files) {
                                Array.from(input.files).forEach(file => {
                                    const reader = new FileReader();
                                    reader.onload = function (e) {
                                        const img = document.createElement('img');
                                        img.src = e.target.result;
                                        img.classList.add('max-w-full', 'h-auto', 'rounded-lg', 'mt-2');
                                        previewContainer.appendChild(img);
                                    }
                                    reader.readAsDataURL(file);
                                });
                            }
                        }
                    </script>

                </div>
            </main>


        </div>
    </div>
</body>

</html>