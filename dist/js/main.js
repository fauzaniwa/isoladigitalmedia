import { initKursor } from "./kursor.js";
import { initGallery } from "./gallery.js";
import { initLightbox } from "./lightbox.js";
import { initSearchandFilter } from "./searchFilter.js";
import { initScrollBar } from "./scrollbar.js";
import { initHamburgerMenu } from "./hamburger.js";

// Inisialisasi fitur sesuai elemen yang tersedia
document.addEventListener("DOMContentLoaded", () => {
  if (document.getElementById("gallery")) initGallery("BWftCOfHfI0yA03E1isqE3vux23Rfn5WAcyOXM1brNs");
  if (document.getElementById("lightbox")) initLightbox();
  if (typeof kursor !== "undefined") initKursor();
  if (document.getElementById("searchWrapper")) initSearchandFilter();
  if (document.getElementById("imageSlider")) initScrollBar();
  if (document.getElementById("hamburger")) initHamburgerMenu();
  
});