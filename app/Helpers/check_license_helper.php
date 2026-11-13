<?php
function check_license() {
    $allowed_domain = 'disdukcapil.sumbarprov.go.id'; // Ganti dengan domain yang diizinkan
    $current_domain = $_SERVER['HTTP_HOST'];

    if ($current_domain !== $allowed_domain) {
        die('Akses tidak diizinkan!');
    }
}
