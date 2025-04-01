<?php
$db = new PDO('mysql:host=localhost;dbname=lab7;charset=utf8', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$ip = $_SERVER['REMOTE_ADDR'];
$url = $_SERVER['REQUEST_URI'];
$time = date('Y-m-d H:i:s');
$status = http_response_code();

$stmt = $db->prepare("INSERT INTO logs (ip, request_time, url, status) VALUES (?, ?, ?, ?)");
$stmt->execute([$ip, $time, $url, $status]);
