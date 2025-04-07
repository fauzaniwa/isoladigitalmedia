export function initScrollBar() {
 const slider = document.getElementById('imageSlider'); 
 const nextBtn = document.getElementById('nextBtn');
 const prevBtn = document.getElementById('prevBtn');

 function updateButtons() {
    const maxScrollLeft = slider.scrollWidth - slider.clientWidth;
    prevBtn.style.display = slider.scrollLeft <= 0 ? 'none' : 'block';
    nextBtn.style.display = slider.scrollLeft >= maxScrollLeft - 5 ? 'none' : 'block';
 }

 nextBtn.addEventListener('click', () => {
    slider.scrollBy({
        left: 220, behavior: 'smooth' 
    })
 })

 prevBtn.addEventListener('click', () => {
    slider.scrollBy({
        left: -220, behavior: 'smooth'
    })
 })

 slider.addEventListener('scroll', updateButtons);

 updateButtons();

}

