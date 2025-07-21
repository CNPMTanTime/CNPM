<?php
session_start();

include 'config/SQLQuery.php';

$foodId = isset($_GET['food_id']) ? (int) $_GET['food_id'] : 0;
$returnUrl = $_GET['url'] ?? '/';

if (!isset($_SESSION['user'])) {
    header('Location: /sign-in.php');
    exit;
}

$userId = $_SESSION['user']['user_id'];

if ($foodId <= 0) {
    header("Location: $returnUrl");
    exit;
}

$deleteSql = "DELETE FROM favorite_foods WHERE user_id = '${userId}' AND food_id = '${foodId}'";
SQLQuery::NonQuery($deleteSql);

header("Location: $returnUrl");
exit;
