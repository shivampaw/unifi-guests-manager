<?php

require_once("includes.php");

$clients = $unifi_connection->list_clients();
$guests = array_filter($clients, function ($client) {
    return $client->is_guest;
});

$access_points = array_column($unifi_connection->list_devices(), 'name', 'mac');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Guests</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="my-3 text-center">
<div class="container">
    <h1>WiFi Guest List</h1>
    <p>
        <a href="logout.php">Logout</a>
    </p>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Device Name & Make</th>
                <th>Access Point</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($guests as $guest): ?>
                <tr>
                    <td>
                        <?php echo $guest->hostname ?? "No Device Name"; ?><br/>
                        <?php echo $guest->oui ?? "No Device Manufacturer"; ?>
                    </td>
                    <td><?php echo $access_points[$guest->ap_mac]; ?> </td>
                    <td><?php echo ($guest->authorized) ? 'Authorised' : 'Not Authorised'; ?></td>
                    <td>
                        <?php if ($guest->authorized): ?>
                            <form action="remove_authorisation.php" method="post">
                                <input type="hidden" name="mac" value="<?php echo $guest->mac; ?>">
                                <button class="btn btn-outline-danger">Remove Authorisation</button>
                            </form>
                        <?php else: ?>
                            <form action="authorise.php" method="post">
                                <input type="hidden" name="ap" value="<?php echo $guest->ap_mac; ?>">
                                <input type="hidden" name="mac" value="<?php echo $guest->mac; ?>">
                                <button class="btn btn-outline-success">Authorise</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>

