<?php
function is_admin_logged_in(): bool
{
    if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
        return true;
    }

    if (isset($_COOKIE['remember_username']) && isset($_COOKIE['remember']) && $_COOKIE['remember'] === '1') {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['username'] = $_COOKIE['remember_username'];
        return true;
    }

    return false;
}
