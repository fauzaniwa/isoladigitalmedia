export function initLightbox() {
    const gallery = document.getElementById("gallery");
    const lightbox = document.getElementById("lightbox");
    const lightboxImg = document.getElementById("lightbox-img");
  
    if (!gallery || !lightbox || !lightboxImg) return;
  
    gallery.addEventListener("click", (e) => {
      if (e.target.tagName === "IMG") {
        lightboxImg.src = e.target.src.replace("&w=400", "&w=1200");
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
  