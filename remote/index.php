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

<meta name="viewport" content="width=device-width,initial-scale=1"/>
<style>
    body {
        font-family: Arial;
        background: #181818;
        color: white;
        text-align: center;
        padding-top: 100px;
        line-height: 25px;
    }
</style>

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