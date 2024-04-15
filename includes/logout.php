<?php

// Created by nosztalgia (lv8)
// My discord server: https://discord.gg/yG4my2nqTa
// Credits to https://github.com/MarkisDev

require __DIR__ . "/functions.php";

session_start();

session_destroy();

redirect("../index.php");

?>
