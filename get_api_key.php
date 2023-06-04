<?php
// Verifikasi pengguna sebelum memberikan akses ke kunci API 

if (
    (!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] == '')
    && (
        !isset($_SERVER['PHP_AUTH_USER'])
        || !isset($_SERVER['PHP_AUTH_PW'])
        || ($_SERVER['PHP_AUTH_USER'] != 'username' || $_SERVER['PHP_AUTH_PW'] != 'password')
    )
) {
    header('WWW-Authenticate: Basic realm="Restricted Access"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Access Denied.';
    exit;
}

/* 
kalo langsung pake htaccess bisa gunakan ini directory htpasswd disesuaikan
<Files "get_api_key.php">
    AuthType Basic
    AuthName "Restricted Access"
    AuthUserFile "C:/xampp/htdocs/LiveSearch-AlpineJS/.htpasswd"
    Require valid-user
</Files>
*/

$api_key = 'my_secret_api_key'; // Ganti dengan kunci autentikasi Anda

header('Content-Type: text/plain');
echo $api_key;

//password han id han