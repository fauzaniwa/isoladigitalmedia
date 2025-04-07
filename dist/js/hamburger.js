// Toggle Mobile Menu
export function initHamburgerMenu() {
const hamburger = document.getElementById("hamburger");
const mobileMenu = document.getElementById("mobile-menu");

hamburger.addEventListener("click", () => {
  const isExpanded = hamburger.getAttribute("aria-expanded") === "true";

  // Toggle menu state
  hamburger.setAttribute("aria-expanded", !isExpanded);
  mobileMenu.setAttribute("aria-hidden", isExpanded);

  // Animate hamburger icon
  hamburger.classList.toggle("active");

  // Toggle menu visibility
  mobileMenu.style.height = isExpanded ? "0" : `${mobileMenu.scrollHeight}px`;
});

// Close menu when clicking outside
document.addEventListener("click", (e) => {
  if (!hamburger.contains(e.target) && !mobileMenu.contains(e.target)) {
    mobileMenu.style.height = "0";
    hamburger.setAttribute("aria-expanded", "false");
    hamburger.classList.remove("active");
  }
});

// Close menu on resize
window.addEventListener("resize", () => {
  if (window.innerWidth >= 768) {
    mobileMenu.style.height = "0";
    hamburger.setAttribute("aria-expanded", "false");
    hamburger.classList.remove("active");
  }
});

// Swiper Featured
function initSwiperCarousel() {
  const swiperContainer = document.querySelector(".mySwiper");
  if (!swiperContainer) return;

  new Swiper(".mySwiper", {
    slidesPerView: 3,
    spaceBetween: 30,
    centeredSlides: true,
    loop: true,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
  });
}

document.addEventListener("DOMContentLoaded", () => {
  initSwiperCarousel();
  initHamburgerMenu(); // kalau masih dipakai juga
});
}