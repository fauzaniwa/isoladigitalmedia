<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="./assets/css/tailwind.output.css" rel="stylesheet">
    <link href="./assets/css/styles.css" rel="stylesheet">
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

<body
    class="min-h-screen flex items-center justify-center bg-gradient-r from-custom-purple via-custom-pink to-custom-blue">
    <div class="flex flex-col md:flex-row bg-white rounded-lg shadow-lg w-full max-w-4xl m-2">
        <!-- Mobile Image (shown above the heading) -->
        <!-- <div class="block md:hidden w-full text-center mt-4">
            <img src="./assets/img/logoidm-black.png" alt="Isola Logo" class="w-48 mx-auto">
        </div> -->
        <!-- The Modal -->
        <div id="statusModal"
            class="fixed inset-0 flex items-center justify-center bg-green-800 bg-opacity-70 z-50 hidden">
            <div id="modalContent" class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full relative text-center">
                <span class="close absolute top-2 right-2 text-gray-500 cursor-pointer text-2xl">&times;</span>
                <div id="modalMessage" class="text-lg"></div>
            </div>
        </div>

        <!-- Left section (Form) -->
        <div class="w-full md:w-1/2 p-12">
            <h1 class="text-4xl font-bold">HELLO FRIEND'S</h1>
            <p class="text-gray-600 mb-8">A place for creative artists & designers</p>
            <form action="../controllers/login_proses.php" method="post">
                <div class="mb-6">
                    <label for="login" class="block text-gray-700 font-semibold mb-2">Email or Username</label>
                    <input type="text" id="login" name="login" placeholder="Email or Username"
                        class="w-full p-4 border rounded-lg focus:outline-none focus:ring focus:border-custom-purple text-lg"
                        required>
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password"
                        class="w-full p-4 border rounded-lg focus:outline-none focus:ring focus:border-custom-purple text-lg"
                        required>
                </div>
                <div class="flex justify-between items-center mb-8">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="mr-2 leading-tight">
                        <span class="text-sm text-gray-600">Remember me</span>
                    </label>
                    <a href="#" class="text-sm text-gray-600 hover:text-gray-800">Forgot Password?</a>
                </div>
                <button
                    class="w-full bg-custom-purple hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline"
                    type="submit">
                    Login
                </button>
                <p class="text-center text-sm text-gray-600 mt-6">
                    Don't have an account? <a href="register.php" class="text-blue-600 hover:underline">Register
                        here</a>
                </p>
            </form>
        </div>
        <!-- Right section (Image) -->
        <div
            class="hidden md:flex md:w-1/2 bg-gradient-to-tr from-purple-400 via-pink-500 to-blue-500 items-center justify-center rounded-r-lg">
            <img src="./assets/img/logoidm-white.png" alt="Isola Logo" class="w-48">
        </div>
    </div>

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
                case 'invalid_password':
                    message = 'Password kamu salah.';
                    break;
                case 'email_or_username_not_found':
                    message = 'Username / Email tidak ditemukan.';
                    break;
                default:
                    message = 'Terjadi kesalahan yang tidak diketahui.';
            }
            showModal(message);
        }
    </script>
</body>

</html>