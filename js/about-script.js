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
const carouselDescriptionText = document.querySelector("#carousel-description-text");
const aboutIndicators = document.querySelector("#about-indicators");
const carouselLabels = ["Western Edge Inventory System", "ForCite", "AUF Library Booking System"];
const carouselDescriptions = [
    "A C#-based inventory management system designed to streamline the organization of stock for Western Edge. This system offers features including a comprehensive UI for tracking inventory and formulating business reports.",
    "An AI-powered research platform that streamlines the research process by providing intelligent search capabilities, automated gap and title analysis, and efficient organization of research materials.",
    "A robust PHP-based platform designed to bridge the gap between students and educators. This system replaces static book lending with a dynamic scheduling engine, allowing users to book sessions with qualified facilitators.",
];

if (portfolioCarousel && carouselLabel && carouselDescriptionText && aboutIndicators) {
    const setIndicatorState = (index) => {
        aboutIndicators.querySelectorAll(".about-indicator").forEach((indicator, indicatorIndex) => {
            const isActive = indicatorIndex === index;
            indicator.classList.toggle("is-active", isActive);
            indicator.setAttribute("aria-current", isActive ? "true" : "false");
        });
    };

    portfolioCarousel.addEventListener("slide.bs.carousel", (event) => {
        carouselLabel.classList.add("is-updating");

        const nextLabel = carouselLabels[event.to] || carouselLabels[0];
        const nextDescription = carouselDescriptions[event.to] || carouselDescriptions[0];
        setIndicatorState(event.to);

        window.setTimeout(() => {
            carouselLabel.textContent = nextLabel;
            carouselDescriptionText.textContent = nextDescription;
            carouselLabel.classList.remove("is-updating");
        }, 180);
    });

    aboutIndicators.addEventListener("click", (event) => {
        const button = event.target.closest(".about-indicator");

        if (!button) {
            return;
        }

        const slideIndex = Number(button.dataset.slideIndex);
        const carousel = bootstrap.Carousel.getOrCreateInstance(portfolioCarousel);

        carousel.to(slideIndex);
    });
}

