<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="./assets/css/tailwind.output.css" rel="stylesheet">
    <link href="./assets/css/styles.css" rel="stylesheet">
    <style type="text/tailwindcss">

        .navbar-scrolled {
    box-shadow: 2px 2px 30px #000000;
  }
  .ext-scrolled {
    color: black;
  }
  .navbar {
    transition: all 0.5s;
  }
  .scroller {
    max-width: 600px;
  }

  .scroller__inner {
    padding-block: 1rem;
    display: flex;
    flex-wrap: wrap;
    gap: 3rem;
  }

  .scroller[data-animated='true'] {
    overflow: hidden;
    -webkit-mask: linear-gradient(90deg, transparent, white 20%, white 80%, transparent);
    mask: linear-gradient(90deg, transparent, white 20%, white 80%, transparent);
  }

  .scroller[data-animated='true'] .scroller__inner {
    width: max-content;
    flex-wrap: nowrap;
    animation: scroll var(--_animation-duration, 40s) var(--_animation-direction, forwards) linear infinite;
  }

  .scroller[data-direction='right'] {
    --_animation-direction: reverse;
  }

  .scroller[data-direction='left'] {
    --_animation-direction: forwards;
  }

  .scroller[data-speed='fast'] {
    --_animation-duration: 20s;
  }

  .scroller[data-speed='slow'] {
    --_animation-duration: 60s;
  }

  @keyframes scroll {
    to {
      transform: translate(calc(-50% - 0.5rem));
    }
  }

  /* for testing purposed to ensure the animation lined up correctly */
  .test {
    background: red !important;
  }
</style>
</head>

<body>

    <body class="min-h-screen">
        <nav class="bg-gradient-r from-custom-purple via-custom-pink to-custom-blue">
            <div class="w-full h-24 fixed bg-transparent top-0 flex z-50 justify-center">
                <div
                    class="flex w-full h-full bg-[#000000] bg-opacity-0 navbar mx-auto my-auto py-2 pl-4 md:px-8 gap-3 justify-between backdrop-blur-md">
                    <div class="flex items-center gap-4 w-[220px]">
                        <a href="homepage.php" class="md:h-2/3 my-auto"><img src="./assets/img/logoidm-white.png" alt=""
                                class="w-[20%] h-[20%] md:w-full md:h-full" /></a>
                    </div>

                    <!-- Nav Asli -->

                    <div class="hidden md:flex gap-6 justify-center">
                        <a href="homepage.php#about" style="font-family: 'Work Sans'" class="flex"><button
                                class="text-sm lg:text-xl text-white txt1">About</button></a>
                        <a href="homepage.php#program" style="font-family: 'Work Sans'" class="flex"><button
                                class="text-sm lg:text-xl text-white txt2">Departement</button></a>
                        <a href="homepage.php#jadwal" style="font-family: 'Work Sans'" class="flex"><button
                                class="text-sm lg:text-xl text-white txt">Featured</button></a>
                        <a href="homepage.php#karya" style="font-family: 'Work Sans'" class="flex"><button
                                class="text-sm lg:text-xl text-white txt">Contact</button></a>
                    </div>

                    <!-- Tombol Login -->
                    <div class="md:flex items-center hidden gap-4 justify-end">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <!-- Jika sudah login, tampilkan tombol akun dengan dropdown menu -->
                            <div class="relative inline-block text-left">
                                <button onclick="toggleDropdown()" class="flex items-center focus:outline-none">
                                    <img src="./img/iconakun.svg" alt="" />
                                </button>
                                <div id="dropdownMenu"
                                    class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-md shadow-lg py-1">
                                    <a href="account.php"
                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                                    <a href="logout.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</a>
                                </div>
                            </div>
                        <?php else: ?>
                            <!-- Jika belum login, tampilkan tombol login dan daftar -->
                            <a href="login.php" style="font-family: 'Work Sans'"
                                class="border-[1px] hover:bg-white hover:bg-opacity-25 py-2 px-6 border-white text-white rounded-full md:text-lg">Login</a>
                            <a href="register.php" style="font-family: 'Work Sans'"
                                class="bg-[#0D0D0D] hover:bg-white hover:bg-opacity-25 py-2 px-6 text-white rounded-full md:text-lg">Daftar</a>
                        <?php endif; ?>
                    </div>

                    <!-- Tombol Menu -->

                    <button class="bg-transparent aspect-square md:hidden text-center text-white">
                        <ion-icon onclick="onToggleMenu(this)" name="menu"
                            class="txt text-3xl cursor-pointer p-0"></ion-icon>
                    </button>
                </div>

                <!-- Nav Menu -->
                <div
                    class="nav-links flex flex-col absolute items-start bg-[#0D0D0D] bg-opacity-0 w-full p-4 shadow-2xl bottom-[120%] md:hidden text-center backdrop-blur-md">
                    <a href="homepage.php#about"><button style="font-family: 'Work Sans'"
                            class="bg-transparent py-2 px-4 w-fit font-plus font-light text-white">About</button></a>
                    <a href="homepage.php#program"><button style="font-family: 'Work Sans'"
                            class="bg-transparent py-2 px-4 w-fit font-plus font-light text-white">Departement</button></a>
                    <a href="homepage.php#jadwal"><button style="font-family: 'Work Sans'"
                            class="bg-transparent py-2 px-4 w-fit font-plus font-light text-white">Featured</button></a>
                    <a href="homepage.php#karya"><button style="font-family: 'Work Sans'"
                            class="bg-transparent py-2 px-4 w-fit font-plus font-light text-white">Contact</button></a>

                    <!-- -------- -->
                    <div class="flex flex-row items-center gap-6 justify-start mt-4">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <a href="account.php"><img src="./img/iconakun.svg" alt="" /></a>
                            <a href="logout.php" style="font-family: 'Work Sans'"
                                class="border-[1px] hover:bg-white hover:bg-opacity-25 py-2 px-6 border-white text-white rounded-full md:text-lg">Logout</a>
                        <?php else: ?>
                            <a href="login.php" style="font-family: 'Work Sans'"
                                class="border-[1px] hover:bg-white hover:bg-opacity-25 py-2 px-6 border-white text-white rounded-full md:text-lg">Login</a>
                            <a href="register.php" style="font-family: 'Work Sans'"
                                class="bg-[#0D0D0D] hover:bg-opacity-25 py-2 px-6 text-white rounded-full md:text-lg">Daftar</a>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Akhir Navmenu -->
            </div>
        </nav>
        <!-- Navbar -->


        <!-- Content -->
        <div class="pt-20">
            <!-- Page content goes here -->
        </div>

    </body>
    <!-- Script Navbar -->
    <script>
        const navEL = document.querySelector('.navbar');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 56) {
                navEL.classList.add('navbar-scrolled');
            } else if (window.scrollY < 56) {
                navEL.classList.remove('navbar-scrolled');
            }
        });

        // Tambahkan ini ke dalam file JavaScript Anda atau di dalam tag <script>
        function toggleDropdown() {
            var dropdownMenu = document.getElementById('dropdownMenu');
            if (dropdownMenu.classList.contains('hidden')) {
                dropdownMenu.classList.remove('hidden');
                dropdownMenu.classList.add('block');
            } else {
                dropdownMenu.classList.remove('block');
                dropdownMenu.classList.add('hidden');
            }
        }

    </script>
</body>

</html>