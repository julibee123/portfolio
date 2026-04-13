<?php
include 'php-txt/basetext.php';

$about_title = 'About Me';

$biography = 'I am Jullian C. Manalo, a second-year BS Computer Science student at Angeles University Foundation. 
            Born in Pampanga, I had a lifelong spark for technology and innovation, which was further nurtured through my 
            undying curiosity and passion for learning. Now, I am an aspiring software developer with a strong interest in
            web development, AI, and software engineering.';
$skills_label = 'Skills';
$certification_label = 'Certifications & Badges';
$skills = ['PHP', 'Java', 'R', 'C#', 'Python', 'HTML', 'CSS', 'JavaScript', 'Bootstrap', 'SQL'];
$skill_icons = [
    'PHP' => 'devicon-php-plain',
    'Java' => 'devicon-java-plain',
    'R' => 'devicon-r-plain',
    'C#' => 'devicon-csharp-plain',
    'Python' => 'devicon-python-plain',
    'HTML' => 'devicon-html5-plain',
    'CSS' => 'devicon-css3-plain',
    'JavaScript' => 'devicon-javascript-plain',
    'Bootstrap' => 'devicon-bootstrap-plain',
    'SQL' => 'devicon-mysql-plain'
];



$carousel_slide_1_label = 'Western Edge Inventory System';
$carousel_slide_1_desc = 'A C#-based inventory management system designed to streamline the organization of stock for Western Edge. This system offers features including a comprehensive UI for tracking inventory and formulating business reports.';
?>

<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <title>About</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS v5.3.8 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/base-style.css" />
    <link rel="stylesheet" href="css/about-style.css" />

    <!-- Bootsrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Devicon --> 
    <link rel="stylesheet" type='text/css' href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css" />
</head>

<body>
    <main id="main-content">
        <nav class="site-navbar position-sticky top-0 navbar navbar-expand-sm navbar-dark ps-5 pe-3"
            style="background-color: #262729;">
            <a class="navbar-brand me-5" href="index.php#top">
                <?php echo $nav_brand; ?>
            </a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation"></button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                    <li class="nav-item me-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Home">
                        <a class="nav-link" href="index.php#main-content">
                            <i class="bi bi-house"></i>
                        </a>
                    </li>
                    <li class="nav-item me-3" data-bs-toggle="tooltip" data-bs-placement="top" title="About Me">
                        <a class="nav-link active" href="about.php" aria-current="page">
                            <i class="bi bi-person"></i>
                        </a>
                    </li>
                    <li class="nav-item me-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Contact Me">
                        <a class="nav-link" href="contact.php">
                            <i class="bi bi-envelope"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <section class="container d-flex align-items-stretch justify-content-center py-5" style="min-height: 90vh;">
            <div class="row w-100 g-4 align-items-center">
                <div class="col-lg-5 d-flex flex-column align-items-center text-light text-center about-side-panel">
                    <div class="about-photo-frame about-photo-frame-first">
                        <img src="resources/PortraitPicManalo.jpg" alt="Profile photo" class="about-photo" />
                    </div>
                </div>
                <div class="col about-description-box w-100 about-first-description">
                    <p class="text-uppercase fw-semibold text-center mb-2 text-light">
                        <?php echo $about_title; ?>
                    </p>
                    <div class="about-profile-details text-light mt-3">
                        <p class="mb-2">
                            <?php echo $biography; ?>
                        </p>
                    </div>
                    <div class="about-certifications mt-auto pt-3">
                        <p class="text-uppercase fw-semibold mb-2 text-light">
                            <?php echo $skills_label; ?>
                        </p>
                        <div class="about-profile-details text-light text-center">
                            <div class="about-skill-list">
                                <?php
                                foreach ($skills as $index => $skill) {
                                    $icon = $skill_icons[$skill] ?? 'bi-code-slash';
                                    echo
                                        '<span class="about-skill-box">' .
                                        '<i class="' . $icon . '"></i>' .
                                        '<span>' . htmlspecialchars($skill, ENT_QUOTES, 'UTF-8') . '</span>' .
                                        '</span>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="about-certifications mt-auto pt-3">
                        <p class="text-uppercase fw-semibold mb-2 text-light">
                            <?php echo $certification_label; ?>
                        </p>
                        <div class="about-badge-list">
                            <a href="https://www.credly.com/badges/7411001a-cc70-4061-a353-f581e414258a" target="_blank">
                            <img src="resources/python_essentials_1.png" alt="Credly badge for Python Essentials 1"
                                class="about-badge" />
                            </a>
                            <a href="https://www.credly.com/badges/5558f194-e4fc-4e6e-b4dd-d4e2c5e812ed" target="_blank">
                                <img src="resources/introduction_to_networks.png" alt="Credly badge for Introduction to Networks"
                                class="about-badge" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="carousel-info" class="container d-flex align-items-stretch justify-content-center py-5">
            <div class="row w-100 g-4 align-items-stretch">
                <div class="col-lg-4 d-flex flex-column align-items-center text-light text-center p-4 about-side-panel">
                    <div class="about-photo-frame about-photo-frame-second mb-3">
                        <img src="resources/PortraitPicManalo.jpg" alt="Profile photo" class="about-photo" />
                    </div>
                    <div id="carousel-description" class="about-description-box w-100 mt-3">
                        <p id="carousel-label" class="carousel-label text-uppercase fw-semibold text-center mb-2">
                            <?php echo $carousel_slide_1_label; ?>
                        </p>
                        <p id="carousel-description-text" class="mb-0">
                            <?php echo $carousel_slide_1_desc; ?>
                        </p>
                    </div>
                    <div id="about-indicators" class="about-indicators mt-3" aria-label="Slide indicators">
                        <button type="button" class="about-indicator is-active" data-slide-index="0"
                            aria-label="Slide 1" aria-current="true"></button>
                        <button type="button" class="about-indicator" data-slide-index="1" aria-label="Slide 2"
                            aria-current="false"></button>
                        <button type="button" class="about-indicator" data-slide-index="2" aria-label="Slide 3"
                            aria-current="false"></button>
                    </div>
                </div>

                <div class="col-lg-8 d-flex">
                    <div id="portfolioCarousel" class="carousel slide align-self-center w-100" data-bs-ride="carousel"
                        data-bs-interval="3000">
                        <div class="carousel-inner rounded-4 overflow-hidden shadow">
                            <div class="carousel-item active">
                                <a href="https://github.com/donsirr/wegutters-ims" target="_blank">
                                    <div
                                        class="carousel-panel d-flex flex-column justify-content-center align-items-center text-center">
                                        <img src="resources/WesternEdge.png" class="carousel-image w-100 d-block" />
                                    </div>
                                </a>
                            </div>
                            <div class="carousel-item">
                                <a href="https://github.com/Aliztaire/GitLit-HackFest" target="_blank">
                                    <div
                                        class="carousel-panel d-flex flex-column justify-content-center align-items-center text-center">
                                        <img src="resources/ForCite.gif" class="carousel-image w-100 d-block" />
                                    </div>
                                </a>
                            </div>
                            <div class="carousel-item">
                                <a href="https://github.com/Atsuwastaken/Library-Booking-System/tree/main22" target="_blank">
                                    <div
                                        class="carousel-panel d-flex flex-column justify-content-center align-items-center text-center">
                                        <img src="resources/AUFLibrary.png" class="carousel-image w-100 d-block" />
                                    </div>
                                </a>
                            </div>
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#portfolioCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#portfolioCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <footer class="text-center text-lg-start text-light" style="background-color: #262729;">
        <section class="d-flex justify-content-center justify-content-lg-between p-4">
            <div class="me-5 d-none d-lg-block">
                <span>
                    <?php echo $contact_me; ?>
                </span>
            </div>

            <div>
                <a href="https://www.facebook.com/jullcmnlo/" class="icon-link me-4 text-reset">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="https://www.linkedin.com/in/jullian-manalo-078227379" class="icon-link me-4 text-reset">
                    <i class="bi bi-linkedin"></i>
                </a>
                <a href="https://github.com/julibee123" class="icon-link me-4 text-reset">
                    <i class="bi bi-github"></i>
                </a>
            </div>
        </section>
    </footer>

    <!-- Bootstrap JavaScript Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script src="js/about-script.js"></script>
</body>

</html>