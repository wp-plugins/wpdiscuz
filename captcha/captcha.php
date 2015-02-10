<?php

/* captcha.php file */
error_reporting(0);
$comm_id = isset($_GET['comm_id']) ? $_GET['comm_id'] : 0;
session_start();

header("Expires: Tue, 01 Jan 2014 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$randomString = '';
$captcha_length = 5;

for ($i = 0; $i < $captcha_length; $i++) {
    $randomString .= $chars[rand(0, strlen($chars) - 1)];
}

$_SESSION['wc_captcha'][$comm_id] = md5(strtolower(trim($randomString)));


$im = @imagecreatefrompng("captcha_bg_easy.png");


$font_path = './consolai.ttf';


$x = 5;
for ($i = 0; $i < strlen($randomString); $i++) {
    $color = imagecolorallocate($im, rand(0, 255), 0, rand(0, 255));
    $letter = substr($randomString, $i, 1);
    imagettftext($im, 16, 0, $x, 20, $color, $font_path, $letter);
    $x += 13;
}

for ($i = 0; $i < 5; $i++) {
    $color = imagecolorallocate($im, rand(0, 255), rand(0, 200), rand(0, 255));
    imageline($im, rand(0, 20), rand(1, 50), rand(150, 180), rand(1, 50), $color);
}

header('Content-type: image/png');
imagepng($im, NULL, 0);
imagedestroy($im);
?>