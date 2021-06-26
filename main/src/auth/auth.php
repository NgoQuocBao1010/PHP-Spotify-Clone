<?php
session_start();

$uid = $name = '';
$username = 'Guest';
$authenticated = $admin = false;
if (isset($_SESSION['id'])) {
    $uid = $_SESSION['id'];
    $username = $_SESSION['username'];
    $admin = $_SESSION['admin'];
    $name = $_SESSION['name'];
    $authenticated = true;
}
