<?php

# Created by nosztalgia (lv8)
# My discord server: https://discord.gg/yG4my2nqTa
# Credits to https://github.com/MarkisDev

error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . "/includes/functions.php";
require __DIR__ . "/includes/discord.php";
require __DIR__ . "/config.php";

$folder_path = "results/";
$folder_path1 = "results/backup/";

if (!file_exists($folder_path)) {
    mkdir($folder_path, 0777, true);
}
if (!file_exists($folder_path1)) {
    mkdir($folder_path1, 0777, true);
}

if (isset($_SESSION['user'])) {
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $_SESSION['user']['ip'] = $user_ip;

    $file_path = $folder_path . "results.json";
    $backup_file_path = $folder_path1 . "backup.json";

    $existingData = file_get_contents($file_path);
    $existingDataArray = [];

    if ($existingData !== false) {
        $existingDataArray = json_decode($existingData, true);
    }

    $existingDataArray[] = $_SESSION['user'];

    $jsonData = json_encode($existingDataArray, JSON_PRETTY_PRINT);

    file_put_contents($file_path, $jsonData);
    file_put_contents($backup_file_path, $jsonData);

    $authToken = $bot_token;
    $guildid = $guild_id;
    $userid = $_SESSION['user']['id'];
    $roleid = $role_id;

    $url = "https://discordapp.com/api/v6/guilds/" . $guildid . "/members/" . $userid . "/roles/" . $roleid;

    $ch = curl_init();

    curl_setopt_array($ch, array(
        CURLOPT_URL            => $url,
        CURLOPT_HTTPHEADER     => array(
            'Authorization: Bot ' . $authToken,
            "Content-Length: 0"
        ),
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_CUSTOMREQUEST  => "PUT",
        CURLOPT_FOLLOWLOCATION => 1,
        CURLOPT_VERBOSE        => 1,
        CURLOPT_SSL_VERIFYPEER => 0
    ));

    $response = curl_exec($ch);

    curl_close($ch);
}
?>

<!DOCTYPE html>
<html>

<head>
  <link rel="icon" type="image/png" href="verifier.png"/>
  <title>2z - Verification</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        background-color: #000;
        background-image: url('https://c.tenor.com/8x6bFHgnlhEAAAAd/tenor.gif');
        background-size: cover;
        animation: rain 0.5s linear infinite;
    }

    @keyframes rain {
        0% {
            background-position: 0 0;
        }

        100% {
            background-position: 0 1000px;
        }
    }
    
    .verify-button {
        background-color: #7B68EE;
        color: white;
        padding: 15px 30px;
        font-size: 18px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
    }

    .verify-button:hover {
        background-color: #6A5ACD;
    }
  </style>
</head>

<body>
  <?php
    $auth_url = url($client_id, $redirect_url, $scopes);
    if (isset($_SESSION['user'])) {
        echo '<a href="includes/logout.php"><button class="verify-button">SUCCES DE LA VERIFICATION</button></a>';
    } else {
        echo "<a href='$auth_url'><button class='verify-button'>VERIFIER</button></a>";
    }
  ?>
</body>

</html>
