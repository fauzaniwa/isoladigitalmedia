export function initLightbox() {
  const lightbox = document.getElementById("lightbox");
  const lightboxImg = document.getElementById("lightbox-img");

  if (!lightbox || !lightboxImg) return;

  document.addEventListener("click", (e) => {
    // Tambahkan class khusus biar hanya img yang dimaksud yang bisa trigger lightbox
    if (e.target.matches("img.lightbox-trigger")) {
      lightboxImg.src = e.target.src;
      lightbox.classList.remove("hidden");
      lightbox.classList.add("flex");
    }
  });

  lightbox.addEventListener("click", () => {
    lightbox.classList.remove("flex");
    lightbox.classList.add("hidden");
    lightboxImg.src = "";
  });
}
