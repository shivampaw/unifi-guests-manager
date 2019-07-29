<?php
require_once("includes.php");

$unifi_connection->authorize_guest($_POST['mac'], (60 * 24 * getenv('AUTH_DAYS')), null, null, $_POST['ap']);

header('Location: index.php');
