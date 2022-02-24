const marker = document.querySelector('#marker');
const links = document.querySelectorAll('nav a');

function indicator (e) {
    marker.style.left = e.offsetLeft + "px";
    marker.style.width = e.offsetWidth + "px";
}

links.forEach(link => {
    link.addEventListener('mouseover', (e) => {
        indicator(e.target);
    })
})