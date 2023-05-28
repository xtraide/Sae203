let submenu = document.getElementById("submenu")

function toggleMenu(){
    submenu.classList.toggle("open-menu")
}
let offset = 0;

const sliderLine = document.querySelector('.slider-line')

document.querySelector('.slider-next').addEventListener('click', function(){
    offset = offset + 500;
    if (offset > 2499) {
        offset = 0
    }
    sliderLine.style.left = -offset + 'px';
});

document.querySelector('.slider-prev').addEventListener('click', function(){
    offset = offset - 500;
    if (offset < 0) {
        offset = 1999
    }
    sliderLine.style.left = -offset + 'px';
});