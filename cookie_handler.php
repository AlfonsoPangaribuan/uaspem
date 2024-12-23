<?php
// Fungsi untuk menetapkan cookie
function setCustomCookie($name, $value, $days = 30) {
    $expireTime = time() + ($days * 24 * 60 * 60); // Waktu berlaku cookie
    setcookie($name, $value, $expireTime, "/");
}

// Fungsi untuk mendapatkan nilai cookie
function getCustomCookie($name) {
    return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
}

// Fungsi untuk menghapus cookie
function deleteCustomCookie($name) {
    setcookie($name, "", time() - 3600, "/"); // Mengatur waktu expired ke masa lalu
}
?>
