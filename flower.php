<?php
// flower.php
require_once 'config.php';

// Validate and get the flower ID from query string
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}
$flowerId = (int) $_GET['id'];

// Prepare and execute statement to fetch flower details
$stmt = $pdo->prepare("SELECT name, color, meaning, occasions, image_path FROM flowers WHERE id = :id");
$stmt->execute(['id' => $flowerId]);
$flower = $stmt->fetch(PDO::FETCH_ASSOC);

// If no flower found, redirect back to index
if (!$flower) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($flower['name']) ?> &mdash; The Language of Flowers</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/flower.css">
    <script defer src="js/flower.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
</head>
<body class="dancing-script">
    <header class="flower-header">
        <a href="index.php" class="back-link">&larr; Back to Gallery</a>
    </header>

    <main class="flower-detail">
        <div class="flower-image">
            <img src="images/<?= htmlspecialchars($flower['image_path']) ?>" alt="<?= htmlspecialchars($flower['name']) ?>">
        </div>
        <div class="flower-info">
            <h1><?= htmlspecialchars($flower['name']) ?></h1>
            <p><strong>Color:</strong> <?= htmlspecialchars($flower['color']) ?></p>
            <p><strong>Meaning:</strong> <?= nl2br(htmlspecialchars($flower['meaning'])) ?></p>
            <p><strong>Occasions:</strong> <?= htmlspecialchars($flower['occasions']) ?></p>
        </div>
    </main>

</body>
</html>
