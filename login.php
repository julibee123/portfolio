<?php
session_start();
include 'php-txt/basetext.php';

$admin_username = 'admin';
$admin_password = 'admin';
$username = $password = $err_msg = "";
$remember = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    if (isset($_POST['remember_me'])) {
        $remember = $_POST['remember_me'];
    }

    $result = ($username == $admin_username && $password == $admin_password);
    if ($result) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['username'] = $username;
        if (isset($_POST['remember_me'])) {
            $remember = $_POST['remember_me'];
            setcookie("remember_username", $username, time() + 3600 * 24 * 365);
            setcookie("remember", $remember, time() + 3600 * 24 * 365);
        } else {
            setcookie("remember_username", "", time() - 36000);
            setcookie("remember", "", time() - 3600);
        }
        header("location:admin.php");
        exit;
    } else
        $err_msg = "Incorrect Username/Password";
}

$login_header_title = 'Admin Login';
$login_header_subtitle = 'Enter your credentials to manage contact records.';
$back_to_contact_label = 'Back to Contact';

$label_username = 'Username';
$label_password = 'Password';
$label_remember = 'Remember me';
$btn_signin = 'Sign In';
?>


<!doctype html>
<html lang="en" data-bs-theme="light">
    <head>
        <title>Login</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
        <link rel="stylesheet" href="css/base-style.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    </head>
    <body>
        <main id="main-content">
            <nav class="site-navbar position-sticky top-0 navbar navbar-expand-sm navbar-dark ps-5 pe-3" style="background-color: #262729;">
                <a class="navbar-brand me-5" href="index.php#top"><?php echo $nav_brand; ?></a>
                <div class="ms-auto pe-4">
                    <a class="btn btn-outline-light btn-sm" href="contact.php"><?php echo $back_to_contact_label; ?></a>
                </div>
            </nav>
            <section class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-md-7 col-lg-5">
                        <div class="card border-0 shadow-sm bg-dark text-light">
                            <div class="card-body p-4 p-lg-5">
                                <h1 class="h3 mb-2"><?php echo $login_header_title; ?></h1>
                                <p class="text-secondary mb-4"><?php echo $login_header_subtitle; ?></p>

                                <?php if ($err_msg !== ''): ?>
                                    <div class="alert alert-danger"><?php echo htmlspecialchars($err_msg); ?></div>
                                <?php endif; ?>

                                <form method="post" action="login.php" class="vstack gap-3">
                                    <div>
                                        <label for="username" class="form-label"><?php echo $label_username; ?></label>
                                        <input type="text" class="form-control" id="username" name="username" required 
                                        value="<?php if (!empty($username)) {
                                            echo $username;
                                        } elseif (isset($_COOKIE["remember_username"])) {
                                            echo $_COOKIE["remember_username"];
                                        } ?>"/>
                                    </div>
                                    <div>
                                        <label for="password" class="form-label"><?php echo $label_password; ?></label>
                                        <input type="password" class="form-control" id="password" name="password" required />
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember_me" name="remember_me" value="1" 
                                            <?php if (!empty($remember)) { ?> checked
                                            <?php } elseif (isset($_COOKIE["remember"])) { ?> checked
                                            <?php } ?>
                                        />
                                        <label class="form-check-label" for="remember_me"><?php echo $label_remember; ?></label>
                                    </div>
                                    <button type="submit" class="btn btn-primary"><?php echo $btn_signin; ?></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

        </body>
</html>
