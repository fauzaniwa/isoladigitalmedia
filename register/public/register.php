<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link href="./assets/css/tailwind.output.css" rel="stylesheet">
    <link href="./assets/css/styles.css" rel="stylesheet"> <!-- Tambahkan CSS untuk font -->
    <style>
        .form-container {
            display: none;
        }

        .form-container.active {
            display: block;
        }
    </style>

    <style>
        /* The Modal (background) */
        #statusModal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        /* Modal Content */
        #modalContent {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            position: relative;
        }

        /* The Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-r from-custom-purple via-custom-pink to-custom-blue flex flex-col">
    <!-- Navbar for Mobile -->
    <nav
        class="md:hidden fixed w-full top-0 left-0 bg-gradient-r from-custom-purple via-custom-pink to-custom-blue shadow-lg z-50">
        <div class="container mx-auto flex items-center justify-center p-4">
            <a href="#" class="flex items-center">
                <img src="./assets/img/logoidm-white.png" alt="Isola Logo" class="w-48">
            </a>
        </div>
    </nav>

    <!-- The Modal -->
    <div id="statusModal" class="fixed inset-0 flex items-center justify-center bg-green-800 bg-opacity-70 z-50 hidden">
        <div id="modalContent" class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full relative text-center">
            <span class="close absolute top-2 right-2 text-gray-500 cursor-pointer text-2xl">&times;</span>
            <div id="modalMessage" class="text-lg"></div>
        </div>
    </div>


    <section class="flex flex-1 justify-center items-center">
        <div class="w-full max-w-4xl bg-white md:rounded-lg shadow-lg">
            <form action="../controllers/insert_register.php" method="post" enctype="multipart/form-data">

                <!-- Form Container 1 -->
                <div id="form-1" class="form-container active">
                    <!-- Header -->
                    <div class="p-8 border-b border-white">
                        <h1 class="text-4xl font-bold">Register</h1>
                        <div class="flex flex-col md:flex-row">
                            <p class="text-gray-600 w-full md:w-1/2 mb-6">A place for creative artist & designer</p>
                            <p class="text-gray-600 text-right w-full md:w-1/2">1/3</p>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row">
                        <!-- Left Section -->
                        <div class="w-full md:w-1/2 px-8 border-r border-white">
                            <div class="flex flex-col">
                                <div class="mb-4">
                                    <label for="full-name" class="block text-gray-700 font-semibold mb-2">Nama
                                        Lengkap</label>
                                    <input type="text" id="full-name" placeholder="John Doe" required name="name" required
                                        class="w-full p-4 border rounded-lg focus:outline-none focus:ring focus:border-custom-purple text-lg">
                                </div>
                                <div class="mb-4">
                                    <label for="nim" class="block text-gray-700 font-semibold mb-2">NIM</label>
                                    <input type="text" id="nim" placeholder="12345678" required name="nim" required
                                        class="w-full p-4 border rounded-lg focus:outline-none focus:ring focus:border-custom-purple text-lg">
                                </div>
                                <div class="mb-4">
                                    <label for="year" class="block text-gray-700 font-semibold mb-2">Tahun
                                        Angkatan</label>
                                    <input type="text" id="year" placeholder="2024" name="tahunangkatan" required
                                        class="w-full p-4 border rounded-lg focus:outline-none focus:ring focus:border-custom-purple text-lg">
                                </div>
                                <div class="mb-4">
                                    <label for="program" class="block text-gray-700 font-semibold mb-2">Program
                                        Studi</label>
                                    <select id="program" required name="programstudi"
                                        class="w-full p-4 border rounded-lg focus:outline-none focus:ring focus:border-custom-purple text-lg">
                                        <option value="" disabled selected>Pilih Program Studi</option>
                                        <option value="Desain Komunikasi Visual">Desain Komunikasi Visual</option>
                                        <option value="Film dan Televisi">Film dan Televisi</option>
                                        <option value="Musik">Musik</option>
                                        <option value="Pendidikan Seni Rupa">Pendidikan Seni Rupa</option>
                                        <option value="Pendidikan Seni Tari">Pendidikan Seni Tari</option>
                                        <option value="Pendidikan Seni Musik">Pendidikan Seni Musik</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Right Section -->
                        <div class="w-full md:w-1/2 px-8">
                            <div class="flex flex-col space-y-6">
                                <div class="mb-4">
                                    <label for="instagram"
                                        class="block text-gray-700 font-semibold mb-2">Instagram</label>
                                    <input type="text" id="instagram" placeholder="@username" required name="instagram"
                                        class="w-full p-4 border rounded-lg focus:outline-none focus:ring focus:border-custom-purple text-lg">
                                </div>
                                <div class="mb-4">
                                    <label for="phone" class="block text-gray-700 font-semibold mb-2">No. Handphone
                                        (Whatsapp
                                        Aktif)*</label>
                                    <input type="tel" id="phone" placeholder="08123456789" required name="nohp"
                                        class="w-full p-4 border rounded-lg focus:outline-none focus:ring focus:border-custom-purple text-lg">
                                </div>
                                <div class="mb-4">
                                    <label for="portfolio" class="block text-gray-700 font-semibold mb-2">Portfolio
                                        (Link Drive)</label>
                                    <input type="text" id="portfolio" name="portfolio" placeholder="Link" required
                                        class="w-full p-4 border rounded-lg focus:outline-none focus:ring focus:border-custom-purple text-lg">
                                </div>
                                <div class="mb-4">
                                    <label for="cv" class="block text-gray-700 font-semibold mb-2">CV (Jika ada Link
                                        Drive)</label>
                                    <input type="text" id="cv" name="cv" placeholder="Link" required
                                        class="w-full p-4 border rounded-lg focus:outline-none focus:ring focus:border-custom-purple text-lg">
                                </div>
                                <div class="flex justify-end mt-6 py-6 gap-4">
                                    <button onclick="window.history.back();"
                                        class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-lg focus:outline-none focus:shadow-outline"
                                        type="button">
                                        Back
                                    </button>
                                    <button onclick="nextForm(2)"
                                        class="bg-custom-purple hover:bg-purple-700 text-white font-bold py-2 px-6 rounded-lg focus:outline-none focus:shadow-outline"
                                        type="button">
                                        Next
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Container 2 -->
                <div class="w-full max-w-4xl bg-white md:rounded-lg shadow-lg">
                    <div id="form-2" class="form-container">
                        <!-- Header -->
                        <div class="p-8 border-b border-white">
                            <h1 class="text-4xl font-bold">Register</h1>
                            <div class="flex flex-col md:flex-row">
                                <p class="text-gray-600 w-full md:w-1/2 mb-6">A place for creative artist & designer</p>
                                <p class="text-gray-600 text-right w-full md:w-1/2">2/3</p>
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row">
                            <!-- Left Section -->
                            <div class="w-full md:w-1/2 px-8 border-r border-white-200">
                                <div class="flex flex-col">
                                    <div class="mb-4">
                                        <label for="department"
                                            class="block text-gray-700 font-semibold mb-2">Departement</label>
                                        <select id="department" required name="department"
                                            class="w-full p-4 border rounded-lg focus:outline-none focus:ring focus:border-custom-purple text-lg">
                                            <option value="" disabled selected>Pilih Departement</option>
                                            <option value="Desain">Departement Desain</option>
                                            <option value="Multimedia">Departement Multimedia</option>
                                            <option value="Game">Departement Game</option>
                                            <option value="SinematikFotografi">Departement Sinematik & Fotografi
                                            </option>
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <label for="division"
                                            class="block text-gray-700 font-semibold mb-2">Divisi</label>
                                        <select id="division" required name="division"
                                            class="w-full p-4 border rounded-lg focus:outline-none focus:ring focus:border-custom-purple text-lg">
                                            <option value="" disabled selected>Pilih Divisi</option>
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <label for="optional-department"
                                            class="block text-gray-700 font-semibold mb-2">Departement (2)</label>
                                        <select id="optional-department" name="opsi-department" required
                                            class="w-full p-4 border rounded-lg focus:outline-none focus:ring focus:border-custom-purple text-lg">
                                            <option value="" disabled selected>Pilih Departement</option>
                                            <option value="Desain">Departement Desain</option>
                                            <option value="Multimedia">Departement Multimedia</option>
                                            <option value="Game">Departement Game</option>
                                            <option value="SinematikFotografi">Departement Sinematik & Fotografi
                                            </option>
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <label for="optional-division"
                                            class="block text-gray-700 font-semibold mb-2">Divisi (2)</label>
                                        <select id="optional-division" required name="opsi-divisi"
                                            class="w-full p-4 border rounded-lg focus:outline-none focus:ring focus:border-custom-purple text-lg">
                                            <option value="" disabled selected>Pilih Divisi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- Right Section -->
                            <div class="w-full md:w-1/2 px-8">
                                <div class="flex flex-col space-y-6">
                                    <div class="mb-4">
                                        <label for="knowledge" class="block text-gray-700 font-semibold mb-2">Apa yang
                                            kamu
                                            ketahui
                                            dari IDM?</label>
                                        <textarea name="knowledge" id="knowledge" placeholder="Your answer" required
                                            class="w-full p-4 border rounded-lg focus:outline-none focus:ring focus:border-custom-purple text-lg"></textarea>

                                        </textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-semibold mb-2">
                                            Bersedia / Tidak dipindah ke departement/divisi lain
                                        </label>
                                        <div class="flex items-center space-x-4">
                                            <label>
                                                <input type="radio" value="yes" name="pindahdivisi" required
                                                    class="form-radio text-custom-purple focus:outline-none focus:ring focus:border-custom-purple">
                                                <span class="ml-2">Ya</span>
                                            </label>
                                            <label>
                                                <input type="radio" value="no" name="pindahdivisi" required
                                                    class="form-radio text-custom-purple focus:outline-none focus:ring focus:border-custom-purple">
                                                <span class="ml-2">Tidak</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="flex justify-end mt-6 py-6 gap-4">
                                        <button onclick="previousForm(1)"
                                            class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-lg focus:outline-none focus:shadow-outline"
                                            type="button">
                                            Back
                                        </button>
                                        <button onclick="nextForm(3)"
                                            class="bg-custom-purple hover:bg-purple-700 text-white font-bold py-2 px-6 rounded-lg focus:outline-none focus:shadow-outline"
                                            type="button">
                                            Next
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Container 3 -->
                <div class="w-full max-w-4xl bg-white md:rounded-lg shadow-lg">
                    <div id="form-3" class="form-container">
                        <!-- Header -->
                        <div class="p-8 border-b border-white">
                            <h1 class="text-4xl font-bold">Register</h1>
                            <div class="flex flex-col md:flex-row">
                                <p class="text-gray-600 w-full md:w-1/2 mb-6">A place for creative artist & designer</p>
                                <p class="text-gray-600 text-right w-full md:w-1/2">3/3</p>
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row">
                            <!-- Left Section -->
                            <div class="w-full md:w-1/2 px-8 border-r border-white-200">
                                <div class="flex flex-col">
                                    <div class="mb-4">
                                        <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                                        <input type="text" id="email" placeholder="example@mail.com" name="email" required
                                            class="w-full p-4 border rounded-lg focus:outline-none focus:ring focus:border-custom-purple text-lg">
                                    </div>
                                    <div class="mb-4">
                                        <label for="username"
                                            class="block text-gray-700 font-semibold mb-2">Username</label>
                                        <input type="text" id="username" placeholder="Username" name="username" required
                                            class="w-full p-4 border rounded-lg focus:outline-none focus:ring focus:border-custom-purple text-lg">
                                    </div>
                                    <div class="mb-4">
                                        <label for="password"
                                            class="block text-gray-700 font-semibold mb-2">Password</label>
                                        <input type="password" id="password" placeholder="Password" name="password" required
                                            class="w-full p-4 border rounded-lg focus:outline-none focus:ring focus:border-custom-purple text-lg">
                                    </div>
                                    <div class="mb-4">
                                        <label for="confirm-password"
                                            class="block text-gray-700 font-semibold mb-2">Confirm
                                            Password</label>
                                        <input type="password" id="confirm-password" placeholder="Confirm Password" required
                                            name="confirm-password"
                                            class="w-full p-4 border rounded-lg focus:outline-none focus:ring focus:border-custom-purple text-lg">
                                    </div>
                                </div>
                            </div>
                            <!-- Right Section -->
                            <div class="w-full md:w-1/2 px-8">
                                <div action="" class="flex flex-col space-y-6">
                                    <div class="mb-4">
                                        <label for="setuju" class="block text-gray-700 font-semibold mb-2">Saya
                                            menyataka bahwa data pribadi yang saya berikan adalah benar dan milik saya.
                                            Saya setuju
                                            dengan kebijakan privasi dan memberikan izin kepada Isola Digital Media
                                            (IDM) untuk memproses
                                            data ini sesuai dengan ketentuan yang berlaku.
                                        </label>
                                        <div class="flex items-center space-x-4">
                                            <label>
                                                <input type="checkbox" name="setuju" value="yes" required
                                                    class="form-radio text-custom-purple focus:outline-none focus:ring focus:border-custom-purple">
                                                <span class="ml-2">Ya</span>
                                            </label>
                                        </div>

                                    </div>
                                    <div class="flex justify-end mt-6 py-6 gap-4">
                                        <button onclick="previousForm(2)"
                                            class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-lg focus:outline-none focus:shadow-outline"
                                            type="button">
                                            Back
                                        </button>
                                        <button
                                            class="bg-custom-purple hover:bg-purple-700 text-white font-bold py-2 px-6 rounded-lg focus:outline-none focus:shadow-outline"
                                            type="submit">
                                            Send
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>


    <script>
        function nextForm(formNumber) {
            document.querySelector('.form-container.active').classList.remove('active');
            document.getElementById(`form-${formNumber}`).classList.add('active');
        }

        function previousForm(formNumber) {
            document.querySelector('.form-container.active').classList.remove('active');
            document.getElementById(`form-${formNumber}`).classList.add('active');
        }
    </script>

    <script>
        // Function to show the modal with a specific message
        function showModal(message) {
            const modal = document.getElementById('statusModal');
            const modalMessage = document.getElementById('modalMessage');
            modalMessage.innerHTML = message; // Set the message
            modal.style.display = 'block'; // Show the modal

            // Get the <span> element that closes the modal
            const span = document.getElementsByClassName('close')[0];

            // When the user clicks on <span> (x), close the modal
            span.onclick = function () {
                modal.style.display = 'none';
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function (event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            }
        }

        // Get the status from the URL
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');

        // Show the modal based on the status
        if (status) {
            let message = '';
            switch (status) {
                case 'password_mismatch':
                    message = 'Password dan konfirmasi password tidak cocok.';
                    break;
                case 'upload_portfolio_failed':
                    message = 'Gagal meng-upload file portfolio.';
                    break;
                case 'upload_cv_failed':
                    message = 'Gagal meng-upload file CV.';
                    break;
                case 'success':
                    message = 'Berhasil Mendaftar! </br> <a href="pengumuman.php" class="m-4 bg-custom-purple hover:bg-purple-700 text-white font-bold py-2 px-6 rounded-lg focus:outline-none focus:shadow-outline">Cek Status</a>';
                    break;
                case 'database_error':
                    message = 'Terjadi kesalahan saat menyimpan data ke database.';
                    break;
                case 'nim_already':
                    message = 'Periksa kembali data kamu, tampaknya NIM sudah pernah digunakan.';
                    break;
                case 'email_already':
                    message = 'Periksa kembali data kamu, tampaknya email sudah pernah digunakan.';
                    break;
                case 'username_already':
                    message = 'Periksa kembali data kamu, tampaknya username sudah pernah digunakan.';
                    break;
                default:
                    message = 'Terjadi kesalahan yang tidak diketahui.';
            }
            showModal(message);
        }
    </script>
    <script>
        const divisions = {
            Desain: [
                { value: 'Graphic Design', text: 'Graphic Design' },
                { value: 'Ilustrasi', text: 'Ilustrasi' },
                { value: 'Komik', text: 'Komik' }
            ],
            Multimedia: [
                { value: 'UI/UX', text: 'UI/UX' },
                { value: 'Animasi', text: 'Animasi' },
                { value: '3D', text: '3D' }
            ],
            Game: [
                { value: 'Game Asset', text: 'Game Asset' },
                { value: 'Game Programmer', text: 'Game Programmer' }
            ],
            SinematikFotografi: [
                { value: 'Fotografi', text: 'Fotografi' },
                { value: 'Sinematik', text: 'Sinematik' }
            ]
        };

        function updateDivisions(departmentSelectId, divisionSelectId) {
            const departmentSelect = document.getElementById(departmentSelectId);
            const divisionSelect = document.getElementById(divisionSelectId);
            const selectedDepartment = departmentSelect.value;
            const options = divisions[selectedDepartment] || [];

            // Kosongkan opsi divisi yang ada, kecuali opsi default
            divisionSelect.innerHTML = '<option value="" disabled selected>Pilih Divisi</option>';

            // Tambahkan opsi divisi yang sesuai dengan departemen yang dipilih
            options.forEach(function (option) {
                const newOption = document.createElement('option');
                newOption.value = option.value;
                newOption.text = option.text;
                divisionSelect.appendChild(newOption);
            });
        }

        // Update division select on department change for the first pair
        document.getElementById('department').addEventListener('change', function () {
            updateDivisions('department', 'division');
        });

        // Update division select on department change for the second pair
        document.getElementById('optional-department').addEventListener('change', function () {
            updateDivisions('optional-department', 'optional-division');
        });

        // Initialize division options on page load
        updateDivisions('department', 'division');
        updateDivisions('optional-department', 'optional-division');
    </script>
</body>

</html>