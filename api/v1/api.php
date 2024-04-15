// Created by nosztalgia (lv8)
// My discord server: https://discord.gg/yG4my2nqTa
// Credits to https://github.com/MarkisDev

<?php
if(isset($_GET['id'])) {
    $requested_id = $_GET['id'];
    $json_contents = file_get_contents("../../results/results.json");
    $data = json_decode($json_contents, true);
    foreach($data as $user) {
        if($user['id'] === $requested_id) {
            echo json_encode($user);
            return;
        }
    }
    echo json_encode([]);
} else {
    echo json_encode(["error" => "No user id provided"]);
}
?>
