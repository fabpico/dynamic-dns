<?php

$databaseConfig = [
    'host' => $_ENV['DATABASE_HOST'],
    'username' => $_ENV['DATABASE_USERNAME'],
    'password' => $_ENV['DATABASE_PASSWORD'],
    'database' => $_ENV['DATABASE_NAME'],
];

function cacheIp(string $ip, array $databaseConfig): string
{
    $mysqli = new mysqli(
        $databaseConfig['host'],
        $databaseConfig['username'],
        $databaseConfig['password'],
        $databaseConfig['database'],
    );
    $mysqli->query("DELETE from ips");
    $statement = mysqli_prepare($mysqli, "INSERT INTO ips (ip, date_time) VALUES (?, ?)");
    $parameterTypes = 'ss';
    $dateTime = (new DateTimeImmutable())->format('Y-m-d H:i:s');
    mysqli_stmt_bind_param($statement, $parameterTypes, $ip, $dateTime);
    $success = $statement->execute();
    if ($success) {
        return "$ip cached";
    }
    return "Caching failed";
}

$ip = file_get_contents("http://ipecho.net/plain");
$result = cacheIp($ip, $databaseConfig);
echo $result;