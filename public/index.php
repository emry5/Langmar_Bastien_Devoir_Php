<?php

/**
 * Model, code php
 */
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
    $uri = 'https://';
} else {
    $uri = 'htttps://';
}
$uri .= $_SERVER['HTTP_HOST'];
header('Location: ' . $uri . '/Devoir-php/templates/home.php');
exit;
