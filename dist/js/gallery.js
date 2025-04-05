let page = 1;
let isLoading = false;
let columns = [];

function getColumnCount() {
  const width = window.innerWidth;
  if (width < 768) return 2;
  if (width < 1024) return 3;
  return 4;
}

function createColumns(count, gallery) {
  gallery.innerHTML = "";
  columns = [];
  for (let i = 0; i < count; i++) {
    const col = document.createElement("div");
    col.className = "flex flex-col gap-4 flex-1";
    gallery.appendChild(col);
    columns.push(col);
  }
}

async function fetchImages(gallery, accessKey) {
  if (isLoading) return;
  isLoading = true;

  const placeholders = Array.from({ length: 12 }, (_, idx) => {
    const colIndex = idx % columns.length;
    const placeholder = document.createElement("div");
    placeholder.className = "w-full h-48 bg-gray-300 rounded-lg animate-pulse";
    columns[colIndex].appendChild(placeholder);
    return placeholder;
  });

  try {
    const res = await fetch(`https://api.unsplash.com/photos/?client_id=${accessKey}&page=${page}&per_page=12`);
    const data = await res.json();

    setTimeout(() => {
      data.forEach((img, idx) => {
        const colIndex = idx % columns.length;
        const imageEl = document.createElement("img");
        imageEl.src = img.urls.small;
        imageEl.alt = img.alt_description || "Unsplash Image";
        imageEl.className = "w-full rounded-lg shadow-lg hover:opacity-80 transition";
        columns[colIndex].appendChild(imageEl);
      });

      placeholders.forEach((p) => p.remove());
    }, 800);

    page++;
  } catch (err) {
    console.error("Error fetching images:", err);
    placeholders.forEach((p) => p.remove());
  } finally {
    isLoading = false;
  }
}

export function initGallery(accessKey) {
  const gallery = document.getElementById("gallery");
  const sentinel = document.getElementById("sentinel");

  if (!gallery || !sentinel) return;

  createColumns(getColumnCount(), gallery);
  fetchImages(gallery, accessKey);

  new IntersectionObserver((entries) => {
    if (entries[0].isIntersecting) fetchImages(gallery, accessKey);
  }).observe(sentinel);

  window.addEventListener("resize", () => {
    const newColumnCount = getColumnCount();
    if (newColumnCount !== columns.length) {
      const allImages = columns.flatMap((col) => Array.from(col.children));
      createColumns(newColumnCount, gallery);
      allImages.forEach((img, idx) => {
        const colIndex = idx % columns.length;
        columns[colIndex].appendChild(img);
      });
    }
  });
}
