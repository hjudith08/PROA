// En tu Responsive.js
document.addEventListener("DOMContentLoaded", () => {
    const hamburgerBtn = document.getElementById("hamburger-btn");

    if (hamburgerBtn) {
        hamburgerBtn.addEventListener("click", () => {
            const mobileMenu = document.getElementById("mobile-menu");
            mobileMenu.classList.toggle("active");
        });
    }
});