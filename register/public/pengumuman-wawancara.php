<section id="selamat" class="flex flex-1 w-full justify-center items-center rounded-lg">
    <div class="w-full max-w-4xl bg-white rounded-lg shadow-lg flex flex-col items-center">
        <img src="assets/img/selamat.png" alt="" class="w-48 mb-4">

        <div class="p-8 border-b border-gray-300 w-full text-center">
            <h1 class="text-4xl font-bold">Selamat, Lolos tahap administrasi!</h1>
        </div>

        <div class="flex flex-col md:flex-row w-full">
            <!-- Left Section -->
            <div class="w-full px-8 border-r flex justify-center">
                <div class="flex flex-col items-center">
                    <div class="mb-4">
                        <p class="text-gray-600 w-full text-center mb-6">
                            "Selamat <span class="font-bold"><?php echo htmlspecialchars($user['name']); ?></span>! 🎉
                            Kamu berhasil melewati tahap
                            administrasi anggota IDM.
                            Kamu berhak untuk melanjutkan pada tahap wawancara pada tanggal 15 - 16 Oktober 2024<span
                                class="font-bold"></span>. 
                                <br>. Segera konfirmasi kehadiranmu dalam
                            tahap wawancara dan
                            masuk grup WhatsApp untuk detail selanjutnya dan persiapan awal. Sampai jumpa di pertemuan
                            berikutnya!"
                        </p>
                    </div>
                </div>
            </div>
        </div>


        <div class="p-4 mt-6">
            <a href="https://chat.whatsapp.com/Ep2QTLNWRfE2fDUFPaZkkV" target="_blank"
                class="bg-custom-purple hover:bg-purple-700 text-white font-bold py-2 px-6 rounded-lg focus:outline-none focus:shadow-outline">
                Bergabung dengan Grup WhatsApp!
            </a>
        </div>
    </div>
</section>