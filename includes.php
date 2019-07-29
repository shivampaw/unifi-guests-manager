<?php
session_start();
require_once("vendor/autoload.php");
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

if (empty($_SESSION['authenticated'])) {
    header('Location: login.php');
    die();
}

$unifi_connection = new UniFi_API\Client(getenv('UNIFI_USER'), getenv('UNIFI_PASSWORD'), getenv('UNIFI_CONTROLLER'), getenv('UNIFI_SITE'));

$unifi_connection->login();
