<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

</html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Tambahkan Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="./assets/js/init-alpine.js"></script>
</head>

<body class="bg-gray-100 h-screen flex justify-center items-center bg-gray-50 dark:bg-gray-900">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-sm dark:bg-gray-800">
        <!-- Theme toggler -->
        <div class="text-purple-600 dark:text-purple-300">
            <button class="rounded-md focus:outline-none focus:shadow-outline-purple" @click="toggleTheme"
                aria-label="Toggle color mode">
                <template x-if="!dark">
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                </template>
                <template x-if="dark">
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </template>
            </button>
        </div>
        <h2 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">Register Admin</h2>
        <form action="../controllers/registercontroller.php" method="POST">
            <input type="hidden" name="role" value="admin" />
            <!-- Input Nama -->
            <label class="block mb-4">
                <span class="text-gray-700 dark:text-gray-400">Nama</span>
                <input type="text" name="nama" required
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Masukkan nama Anda" />
            </label>

            <!-- Input Email -->
            <label class="block mb-4">
                <span class="text-gray-700 dark:text-gray-400">Email</span>
                <input type="email" name="email" required
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="example@mail.com" />
            </label>

            <!-- Input Password -->
            <label class="block mb-4">
                <span class="text-gray-700 dark:text-gray-400">Password</span>
                <input type="password" name="password" required
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="*******" />
            </label>

            <!-- Input Konfirmasi Password -->
            <label class="block mb-6">
                <span class="text-gray-700 dark:text-gray-400">Konfirmasi Password</span>
                <input type="password" name="confirm_password" required
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="*******" />
            </label>

            <!-- Tombol Register -->
            <button
                class="block w-full px-4 py-2 text-sm font-medium leading-5 text-white bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                type="submit">
                Register
            </button>
        </form>
    </div>
</body>

</html>