export function initSearchandFilter() {
    const searchToggle = document.getElementById('searchToggle');
    const searchInput = document.getElementById('searchInput');
    const filterToggle = document.getElementById('filterToggle');
    const filterMenu = document.getElementById('filterMenu');

    searchInput.addEventListener("input", () => {
        searchInput.style.height = "auto";
        searchInput.style.height = searchInput.scrollHeight + "px";
      });

    if (searchToggle && searchInput) {
        searchToggle.addEventListener('click',() => {
            searchToggle.classList.add('hidden');
            searchInput.classList.remove('hidden');
            searchInput.focus();
        }

         );
    }

    if (filterToggle && filterMenu) {
        filterToggle.addEventListener('click',() => {
            filterMenu.classList.remove('hidden');
            filterToggle.classList.add('hidden');
        }

    );
    }

    document.addEventListener('click', (e) => {
        if (!searchInput.contains(e.target) && !searchToggle.contains(e.target) && !filterMenu.contains(e.target) && !filterToggle.contains(e.target)
        ) {
            searchInput.classList.add('hidden');
            searchToggle.classList.remove('hidden');
        }
    });

    document.addEventListener('click', (e) => {
       if (
        !searchInput.contains(e.target) && !searchToggle.contains(e.target) && !filterMenu.contains(e.target) && !filterToggle.contains(e.target)
       ) {
        filterMenu.classList.add('hidden');
        filterToggle.classList.remove('hidden');
        
       }
    });


}