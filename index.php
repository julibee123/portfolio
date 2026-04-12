<?php
include 'php-txt/basetext.php';

$welcome_title = 'Hi, I\'m Jullian Manalo';
$welcome_headline = 'Aspiring Software Developer, Tech Enthusiast, and Lifelong Learner';
$welcome_sub = 'Learn more about me, my journey, and my work.';

$carousel_about = 'About Me';
$carousel_call_to_action = 'Learn More';

?>

<!doctype html>
<html lang="en" data-bs-theme="light">
    <head>
        <title>Portfolio</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Bootstrap CSS v5.3.8 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
            crossorigin="anonymous"
        />
        <!-- Custom CSS -->
        <link rel="stylesheet" href="css/index-style.css"/>
        <link rel="stylesheet" href="css/base-style.css"/>

        <!-- Bootsrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    </head>

    <body>
        <header>
            <section class="hero-section">
                <span class="hero-orb orb-1" aria-hidden="true"></span>
                <span class="hero-orb orb-2" aria-hidden="true"></span>
                <span class="hero-orb orb-3" aria-hidden="true"></span>
                <span class="hero-orb orb-4" aria-hidden="true"></span>
                <span class="hero-orb orb-5" aria-hidden="true"></span>
                <span class="hero-orb orb-6" aria-hidden="true"></span>
                <div class="container">
                    <div class="row justify-content-center text-center">
                        <div class="col-lg-8 hero-content">
                            <p class="text-uppercase text-primary fw-semibold mb-2">
                                <?php echo $welcome_title; ?>
                            </p>
                            <h1 class="display-5 fw-bold">
                                <?php echo $welcome_headline; ?>
                            </h1>
                            <p class="lead text-muted mt-3 mb-4">
                                <?php echo $welcome_sub; ?>
                            </p>
                            <a class="btn btn-outline-primary btn-lg border-0" href="#main-content">
                                <i class="bi bi-arrow-down"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </header>   
        
        <main id="main-content">
            <nav class="site-navbar position-sticky top-0 navbar navbar-expand-sm navbar-dark ps-5 pe-3" style="background-color: #262729;">
                <a class="navbar-brand me-5" href="index.php#top">
                    <?php echo $nav_brand; ?>
                </a>
                <button
                    class="navbar-toggler d-lg-none"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavId"
                    aria-controls="collapsibleNavId"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                ></button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                        <li class="nav-item me-3"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Home">
                            <a class="nav-link" href="index.php#main-content">
                                <i class="bi bi-house"></i>
                            </a>
                        </li>
                        <li class="nav-item me-3"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="About Me">
                            <a class="nav-link" href="about.php">
                                <i class="bi bi-person"></i>
                            </a>
                        </li>
                        <li class="nav-item me-3"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Contact Me">
                            <a class="nav-link" href="contact.php">
                                <i class="bi bi-envelope"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            
            <section class="p-5">
                <div class="container">
                    <p id="carousel-label" class="carousel-label text-uppercase fw-semibold text-center mb-3">
                        <?php echo $carousel_about; ?>
                    </p>

                    <div id="portfolioCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#portfolioCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="About Me"></button>
                            <button type="button" data-bs-target="#portfolioCarousel" data-bs-slide-to="1" aria-label="Projects"></button>
                            <button type="button" data-bs-target="#portfolioCarousel" data-bs-slide-to="2" aria-label="Achievements"></button>
                        </div>
                    

                        <div class="carousel-inner rounded-4 overflow-hidden shadow">
                            <div class="carousel-item active">
                                <div class="carousel-panel d-flex flex-column justify-content-center align-items-center text-center">
                                    <img src="resources/aboutme.jpg" class="carousel-image w-100 d-block"/>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="carousel-panel d-flex flex-column justify-content-center align-items-center text-center">
                                    <img src="resources/ForCite.gif" class="carousel-image w-100 d-block"/>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="carousel-panel d-flex flex-column justify-content-center align-items-center text-center">
                                    <img src="resources/achievements.jpg" class="carousel-image w-100 d-block"/>
                                </div>
                            </div>
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#portfolioCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#portfolioCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </button>
                    </div>

                    <div class="text-center mt-4">
                        <a href="about.php" class="btn btn-outline-light px-4">
                            <?php echo $carousel_call_to_action; ?>
                        </a>
                    </div>
                </div>
            </section>
        </main>

        <footer class="text-center text-lg-start text-light" style="background-color: #262729;">
            <!-- Section: Social media -->
            <section class="d-flex justify-content-center justify-content-lg-between p-4">
                <!-- Left -->
                <div class="me-5 d-none d-lg-block">
                <span>
                    <?php echo $contact_me; ?>
                </span>
                </div>
                <!-- Left -->

                <!-- Right -->
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
                <!-- Right -->
            </section>
            <!-- Section: Social media -->
        </footer>   

        <!-- Bootstrap JavaScript Bundle (includes Popper) -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>

        <!-- Custom JavaScript -->
        <script src="js/index-script.js"></script>
    </body>
</html>
