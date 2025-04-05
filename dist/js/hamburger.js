export function initHamburgerMenu() {
    const hamburger = document.querySelector("#hamburger");
    const navMenu = document.querySelector("#nav-menu");
  
    if (hamburger && navMenu) {
      hamburger.addEventListener("click", () => {
        hamburger.classList.toggle("hamburger-active");
        navMenu.classList.toggle("hidden");
      });
  
      window.addEventListener("click", (e) => {
        if (e.target !== hamburger && e.target !== navMenu) {
          hamburger.classList.remove("hamburger-active");
          navMenu.classList.add("hidden");
        }
      });
    }
  
    const navLinks = document.querySelector(".nav-links");
    window.onToggleMenu = function (e) {
      e.name = e.name === "menu" ? "close" : "menu";
      navLinks.classList.toggle("-top-44");
    };
  }
  