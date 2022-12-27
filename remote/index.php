<?php

$databaseConfig = [
    'host' => 'xx',
    'username' => 'xx',
    'password' => 'xx',
    'database' => 'xx',
];

function getIp(array $databaseConfig): string
{
    $mysqli = new mysqli(
        $databaseConfig['host'],
        $databaseConfig['username'],
        $databaseConfig['password'],
        $databaseConfig['database'],
    );
    $result = $mysqli->query("SELECT ip FROM ips");
    $row = $result->fetch_row();
    return $row[0];
}

function createRedirectionUrl(string $ip): string
{
    $port = $_GET['port'] ?? '80';
    return "http://$ip:{$port}";
}

$ip = getIp($databaseConfig);
$redirectionUrl = createRedirectionUrl($ip);
echo "Redirecting to $redirectionUrl";
sleep(2);
echo "<script>window.location.href = '$redirectionUrl'</script>";