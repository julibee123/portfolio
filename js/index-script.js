const heroSection = document.querySelector(".hero-section");

if (heroSection) {
    const updateHeroBackground = () => {
        const scrollY = window.scrollY || window.pageYOffset;
        heroSection.style.setProperty("--hero-shift", `${scrollY}px`);
    };

    updateHeroBackground();
    window.addEventListener("scroll", updateHeroBackground, { passive: true });
    window.addEventListener("resize", updateHeroBackground);
}

const portfolioCarousel = document.querySelector("#portfolioCarousel");
const carouselLabel = document.querySelector("#carousel-label");
const carouselLabels = ["About Me", "Projects", "Achievements"];

if (portfolioCarousel && carouselLabel) {
    portfolioCarousel.addEventListener("slide.bs.carousel", (event) => {
        carouselLabel.classList.add("is-updating");

        const nextLabel = carouselLabels[event.to] || carouselLabels[0];

        window.setTimeout(() => {
            carouselLabel.textContent = nextLabel;
            carouselLabel.classList.remove("is-updating");
        }, 180);
    });
}

