<?php
// randomFlower.php
require_once 'config.php';

// Fetch one random flower
$stmt = $pdo->query("SELECT id, name, color, meaning, occasions, image_path 
                     FROM flowers 
                     ORDER BY RAND() 
                     LIMIT 1");

$flower = $stmt->fetch(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($flower);
