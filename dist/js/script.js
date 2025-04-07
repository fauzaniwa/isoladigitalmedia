// Toggle
const navLinks = document.querySelector(".nav-links");
function onToggleMenu(e) {
  e.name = e.name === "menu" ? "close" : "menu";
  navLinks.classList.toggle("-top-44");
}

// Kursor
new kursor({
  type: 1,
  removeDefaultCursor: true,
  color: "#ffffff",
});

// toggleBtn
const toggleButtons = document.querySelectorAll("[id^='toggleBtn']");
toggleButtons.forEach((toggleBtn) => {
  const section = toggleBtn.closest("section");
  const extraCards = section.querySelectorAll(".extra-card");
  let isExpanded = false;

  toggleBtn.addEventListener("click", () => {
    isExpanded = !isExpanded;

    extraCards.forEach((card) => {
      if (isExpanded) {
        card.classList.remove("hidden");
        card.classList.add("animate-fade-in");
      } else {
        card.classList.add("hidden");
        card.classList.remove("animate-fade-in");
      }
    });

    toggleBtn.textContent = isExpanded ? "Hide" : "View More";
  });
});

// Toggle Mobile Menu
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
  initAboutSlideshow();
});

function initGallerySwiper() {
  const galleryContainer = document.querySelector(".gallery-swiper");
  if (!galleryContainer) return;

  const gallerySwiper = new Swiper(".gallery-swiper", {
    slidesPerView: "auto",
    spaceBetween: 20,
    centeredSlides: true,
    loop: true,
    autoplay: {
      delay: 9000,
      disableOnInteraction: false,
    },
  });
}
