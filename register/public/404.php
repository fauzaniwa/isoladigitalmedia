<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman Page</title>
    <link href="./assets/css/tailwind.output.css" rel="stylesheet">
    <link href="./assets/css/styles.css" rel="stylesheet">
</head>

<body
    class="min-h-screen bg-white flex flex-col justify-center items-center bg-gradient-r from-custom-purple via-custom-pink to-custom-blue">
    <!-- Navbar for Mobile -->
    <nav
        class="md:hidden fixed w-full top-0 left-0 bg-gradient-r from-custom-purple via-custom-pink to-custom-blue shadow-lg z-50">
        <div class="container mx-auto flex items-center justify-center p-4">
            <a href="#" class="flex items-center">
                <img src="./assets/img/logoidm-white.png" alt="Isola Logo" class="w-48">
            </a>
        </div>
    </nav>

    <section id="404" class="flex flex-1 w-full justify-center items-center rounded-lg">
        <div class="w-full max-w-4xl bg-white rounded-lg shadow-lg flex flex-col items-center">
            <img src="assets/img/tahap-seleksi.png" alt="" class="w-48 mb-4">

            <div class="p-8 border-b border-gray-300 w-full text-center">
                <h1 class="text-4xl font-bold">404 - NOT FOUND</h1>
            </div>

            <div class="flex flex-col md:flex-row w-full">
                <!-- Left Section -->
                <div class="w-full px-8 border-r flex justify-center">
                    <div class="flex flex-col items-center">
                        <div class="mb-4">
                            <p class="text-gray-600 w-full text-center mb-6">Oops! Sepertinya kamu tersesat. Mari kita temukan jalan pulang!</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 mt-6">
                <a href="login"
                    class="bg-custom-purple hover:bg-purple-700 text-white font-bold py-2 px-6 rounded-lg focus:outline-none focus:shadow-outline">
                    Kembali
                </a>
            </div>
        </div>
    </section>

</body>

</html>