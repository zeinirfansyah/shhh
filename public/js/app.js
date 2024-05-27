// parallax effect
window.addEventListener("scroll", function () {
    let scroll = window.scrollY;
    let parallax = document.getElementById("welcome");
    parallax.style.backgroundPositionY = scroll / 1.5 + "px";
});
