<?php

$databaseConfig = [
    'host' => 'xx',
    'username' => 'xx',
    'password' => 'xx',
    'database' => 'xx',
];

function getIpCache(array $databaseConfig): array
{
    $mysqli = new mysqli(
        $databaseConfig['host'],
        $databaseConfig['username'],
        $databaseConfig['password'],
        $databaseConfig['database'],
    );
    $result = $mysqli->query("SELECT ip, date_time FROM ips");
    $row = $result->fetch_assoc();
    return $row;
}

function createRedirectionUrl(string $ip): string
{
    $port = $_GET['port'] ?? '80';
    return "http://$ip:{$port}";
}

$ipCache = getIpCache($databaseConfig);
$redirectionUrl = createRedirectionUrl($ipCache['ip']);
echo <<<HEREDOC

<p>
    Proceeding to {$ipCache['ip']}...<br/>
    (last updated at {$ipCache['date_time']})
</p>

<script>
    setTimeout(function(){
    window.location.href = '$redirectionUrl'
    }, 4000)
</script>

HEREDOC;