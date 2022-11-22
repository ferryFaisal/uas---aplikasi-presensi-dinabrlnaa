<?php

session_start();

if (isset($_SESSION['login'])) {
    unset($_SESSION);

    session_destroy();

//
    die("Anda telah keluar. Silahkan login <a href='login.php'>di sini</a>");
}