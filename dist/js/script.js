// Hamburger Menu

const hamburger = document.querySelector("#hamburger");
const navMenu = document.querySelector("#nav-menu");

hamburger.addEventListener("click", function () {
  hamburger.classList.toggle("hamburger-active");
  navMenu.classList.toggle("hidden");
});

// Klik di luar hamburger
window.addEventListener("click", function (e) {
  if (e.target != hamburger && e.target != navMenu) {
    hamburger.classList.remove("hamburger-active");
    navMenu.classList.add("hidden");
  }
});

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
