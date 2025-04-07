import { initKursor } from "./kursor.js";
import { initGallery } from "./gallery.js";
import { initLightbox } from "./lightbox.js";

// Inisialisasi fitur sesuai elemen yang tersedia
document.addEventListener("DOMContentLoaded", () => {
  if (document.getElementById("gallery")) initGallery("BWftCOfHfI0yA03E1isqE3vux23Rfn5WAcyOXM1brNs");
  if (document.getElementById("lightbox")) initLightbox();
  if (typeof kursor !== "undefined") initKursor();
});
