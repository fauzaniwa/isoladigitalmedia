<!-- Header -->
<header class="text-black py-6 shadow-lg bg-white">
  <div class="container mx-auto flex justify-between items-center px-6">
    <!-- Brand -->
    <a href="home" class="text-3xl font-extrabold font-primary">FessUp</a>

    <!-- Toggle Button and Submit Button for Mobile -->
    <div class="flex items-center space-x-4 lg:hidden">
      <!-- Mobile Submit Button -->
      <a href="submit">
        <button
          class="btn-primary text-white px-6 py-2 rounded-md font-semibold shadow-md hover:shadow-lg">Submit</button>
      </a>

      <button id="navToggle" class="text-black focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
          class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
        </svg>
      </button>


    </div>

    <!-- Navigation Links Desktop -->
    <nav id="navMenuDesktop"
      class="hidden lg:flex flex-col lg:flex-row lg:items-center space-y-4 lg:space-y-0 lg:space-x-6 text-lg px-6 py-4 lg:py-0">
      <a href="home" class="hover:text-pink-light">Home</a>
      <a href="browse" class="hover:text-pink-light">Browse</a>
      <a href="mutual" class="hover:text-pink-light">Spotify</a>
      <a href="menfess" class="hover:text-pink-light">Menfess</a>
      <a href="submit">
        <button
          class="btn-primary text-white px-8 py-3 rounded-md font-semibold shadow-md hover:shadow-lg">Submit</button>
      </a>
    </nav>
  </div>

  <!-- Navigation Links Mobile -->
  <nav id="navMenuMobile" class="hidden flex-col bg-main mt-2 py-4 px-6 space-y-4 lg:hidden">
    <a href="home" class="block text-lg text-white hover:text-pink-light py-2">Home</a>
    <a href="browse" class="block text-lg text-white hover:text-pink-light py-2">Browse</a>
    <a href="mutual" class="block text-lg text-white hover:text-pink-light py-2">Spotify</a>
    <a href="menfess" class="block text-lg text-white hover:text-pink-light py-2">Menfess</a>
  </nav>
</header>