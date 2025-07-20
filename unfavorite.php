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

$sql = 'SELECT * FROM favorite_foods WHERE user_id = :user_id AND food_id = :food_id';
$params = [
    ':user_id' => $userId,
    ':food_id' => $foodId,
];
$result = SQLQuery::GetData($sql, ['params' => $params]);

if (count($result) > 0) {
    $deleteSql = 'DELETE FROM favorite_foods WHERE user_id = :user_id AND food_id = :food_id';
    SQLQuery::NonQuery($deleteSql, [
        ':user_id' => $userId,
        ':food_id' => $foodId,
    ]);
}

header("Location: $returnUrl");
exit;
