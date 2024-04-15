<?php

// Created by nosztalgia (lv8)
// My discord server: https://discord.gg/yG4my2nqTa
// Credits to https://github.com/MarkisDev

error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . "/discord.php";
require __DIR__ . "/functions.php";
require "../config.php";

init($redirect_url, $client_id, $secret_id, $bot_token);

get_user();

$_SESSION['guilds'] = get_guilds();

$_SESSION['connections'] = get_connections();

redirect("../index.php");
