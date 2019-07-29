<?php
require_once("includes.php");

$unifi_connection->unauthorize_guest($_POST['mac']);

header('Location: index.php');
