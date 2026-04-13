<?php
include 'php-txt/basetext.php';
include 'php-xampp/db.php';
include 'php-xampp/recaptcha-verify.php';

$success_message = '';
$error_message = '';
$name_value = '';
$email_value = '';
$message_value = '';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyRecaptcha()) {
        $error_message = 'reCAPTCHA verification failed. Please try again.';
    } else {
        $name_value = trim($_POST['name'] ?? '');
        $email_value = trim($_POST['email'] ?? '');
        $message_value = trim($_POST['message'] ?? '');

        if ($name_value === '' || $email_value === '' || $message_value === '') {
            $error_message = 'Please fill in all fields before submitting.';
        } elseif (!filter_var($email_value, FILTER_VALIDATE_EMAIL)) {
            $error_message = 'Please enter a valid email address.';
        } else {
            $statement = $db->prepare('INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)');
            $statement->bind_param('sss', $name_value, $email_value, $message_value);
            $statement->execute();
            $statement->close();

            header('Location: contact.php?sent=1');
            exit;
        }
    }
}
if (isset($_GET['sent'])) {
    $success_message = 'Thank you for your message. I will get back to you shortly.';
}

$contact_header_title = 'Contact Me';
$contact_header_subtitle = 'Send a message, and I will respond as soon as possible.';
$view_records_label = 'View Contact Records';

$label_name = 'Name';
$label_email = 'Email';
$label_message = 'Message';
$btn_send = 'Send Message';
?>

<!doctype html>
<html lang="en" data-bs-theme="light">
    <head>
        <title>Contact</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
            crossorigin="anonymous"
        />

        <link rel="stylesheet" href="css/index-style.css"/>
        <link rel="stylesheet" href="css/base-style.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
        <script type="text/javascript">
            var onloadCallback = function() {
                grecaptcha.render('captcha_element', {
                'sitekey' : '6Lcli7QsAAAAANPNrquyZJYCSarS94FeFPMtlyES'
                });
            };
        </script>
    </head>

    <body>
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
                            <a class="nav-link active" href="contact.php" aria-current="page">
                                <i class="bi bi-envelope"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <section class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm bg-dark text-light">
                            <div class="card-body p-4 p-lg-5">
                                <div class="d-flex justify-content-between align-items-start gap-3 flex-wrap mb-4">
                                    <div>
                                        <h1 class="h3 mb-2"><?php echo $contact_header_title; ?></h1>
                                        <p class="text-secondary mb-0"><?php echo $contact_header_subtitle; ?></p>
                                    </div>
                                    <a href="login.php" class="btn btn-outline-light"><?php echo $view_records_label; ?></a>
                                </div>

                                <?php if ($success_message !== ''): ?>
                                    <div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
                                <?php endif; ?>

                                <?php if ($error_message !== ''): ?>
                                    <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
                                <?php endif; ?>

                                <form method="post" action="contact.php" class="row g-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label"><?php echo $label_name; ?></label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="name"
                                            name="name"
                                            value="<?php echo htmlspecialchars($name_value); ?>"
                                            required
                                        />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label"><?php echo $label_email; ?></label>
                                        <input
                                            type="email"
                                            class="form-control"
                                            id="email"
                                            name="email"
                                            value="<?php echo htmlspecialchars($email_value); ?>"
                                            required
                                        />
                                    </div>
                                    <div class="col-12">
                                        <label for="message" class="form-label"><?php echo $label_message; ?></label>
                                        <textarea
                                            class="form-control"
                                            id="message"
                                            name="message"
                                            rows="6"
                                            required
                                        ><?php echo htmlspecialchars($message_value); ?></textarea>
                                    </div>
                                    <div id="captcha_element"></div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary px-4"><?php echo $btn_send; ?></button>
                                    </div>
                                </form>
                            </div>
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

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
        <script src="js/index-script.js"></script>
        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
    </body>
</html>
