<?php
$databaseConfig = [
    'host' => 'xx',
    'username' => 'xx',
    'password' => 'xx',
    'database' => 'xx',
];
$mysqli = new mysqli(
    $databaseConfig['host'],
    $databaseConfig['username'],
    $databaseConfig['password'],
    $databaseConfig['database'],
);
$result = $mysqli->query("SELECT ip, date_time FROM ips");
$ipCache = $result->fetch_assoc();

echo <<<HEREDOC
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<style>
    body {
        font-family: Arial;
        background: #181818;
        color: white;
        text-align: center;
        padding-top: 100px;
    }
    a {
        color: white;
    }
</style>

<p>Last IP update was at {$ipCache['date_time']}</p>

<p><a target="_blank" href="http://{$ipCache['ip']}">My first app</a></p>
<p><a target="_blank" href="http://{$ipCache['ip']}:4533">My second app (port 4533)</a></p>

HEREDOC;