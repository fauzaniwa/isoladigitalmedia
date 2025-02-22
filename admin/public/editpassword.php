<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Profile - IDM</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="./assets/js/init-alpine.js"></script>
</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen}">
        <!-- Desktop sidebar -->
        <?php include 'session.php'; ?>
        <?php include 'aside.php'; ?>

        <div class="flex flex-col flex-1">
            <?php include 'header.php'; ?>
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        Edit Profile
                    </h2>
                    <form action="../controllers/update_password.php" method="POST" enctype="multipart/form-data">
                        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Password Lama</span>
                                <input type="password" id="passwordLama" name="passwordLama" for="passwordLama"
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                            </label>

                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Password Baru</span>
                                <input type="password" id="passwordBaru" name="passwordBaru" for="passwordBaru"
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                            </label>

                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Konfirmasi Password Baru</span>
                                <input type="password" id="passwordKonfirmasi" name="passwordKonfirmasi"
                                    for="passwordKonfirmasi"
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                            </label>
                        </div>
                        <div class="p-4 gap-4">
                            <button type="submit"
                                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                Accept
                            </button>
                        </div>
                    </form>

                </div>
            </main>
        </div>
    </div>
</body>

</html>