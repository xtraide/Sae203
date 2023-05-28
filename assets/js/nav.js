let submenu = document.getElementById("submenu")

function toggleMenu(){
    submenu.classList.toggle("open-menu")
}
let offset = 0;

const sliderLine = document.querySelector('.slider-line')

document.getElementsByClassName('slider-next')[0].addEventListener('click', ()=>{
    offset = offset + 400;
    if (offset > 1999) {
        offset = 0
    }
    sliderLine.style.left = -offset + 'px';
});

document.querySelector('.slider-prev').addEventListener('click', function(){
    offset = offset - 400;
    if (offset < 0) {
        offset = 1999
    }
    sliderLine.style.left = -offset + 'px';
});