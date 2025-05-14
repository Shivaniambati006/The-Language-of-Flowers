<?php
// index.php
require_once 'config.php';

// Fetch all flowers for gallery
$stmt = $pdo->query("SELECT id, name, image_path FROM flowers ORDER BY name ASC");
$flowers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch one random flower for "Flower of the Day"
$stmt2 = $pdo->query("SELECT id, name, color, meaning, occasions, image_path FROM flowers ORDER BY RAND() LIMIT 1");
$flowerOfDay = $stmt2->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Language of Flowers</title>
    <link rel="stylesheet" href="css/style.css">
    <script defer src="js/script.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
</head>
<body class="dancing-script">
    <header class="site-header">
        <div class="header-container">
            <div class="header-left">
                <h1>The Language of Flowers</h1>
                <p>
                    “The Language of Flowers” is a thoughtfully crafted website that brings to life the centuries-old 
                    tradition of floral symbolism. It invites visitors into a serene, visually rich environment where 
                    every bloom tells a story.
                </p>
                <button id="randomBtn">Surprise Me!</button>
                <!-- Hidden data for random flower modal -->
                <div id="randomData" data-flower='<?php echo json_encode($flowerOfDay); ?>' hidden></div>
                <div id="loading" class="hidden">Choosing a flower...</div>
            </div>
            <div class="header-right">
                <div class="flower-of-day">
                    <h2>Flower of the Day</h2>
                    <img src="images/<?= htmlspecialchars($flowerOfDay['image_path']) ?>" alt="<?= htmlspecialchars($flowerOfDay['name']) ?>">
                    <p><?= htmlspecialchars($flowerOfDay['name']) ?></p>
                </div>
            </div>
        </div>
    </header>

    <main class="gallery">
        <h2>Explore Flowers</h2>
        <div class="card-grid">
            <?php foreach ($flowers as $flower): ?>
                <div class="flower-card">
                    <a href="flower.php?id=<?= $flower['id'] ?>">
                        <img src="images/<?= htmlspecialchars($flower['image_path']) ?>" alt="<?= htmlspecialchars($flower['name']) ?>">
                        <h3><?= htmlspecialchars($flower['name']) ?></h3>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- Modal structure -->
    <div id="flowerModal" class="modal hidden">
        <div class="modal-content">
            <span id="closeModal" class="close">&times;</span>
            <h2 id="modalName"></h2>
            <img id="modalImage" src="" alt="">
            <p><strong>Color:</strong> <span id="modalColor"></span></p>
            <p><strong>Meaning:</strong> <span id="modalMeaning"></span></p>
            <p><strong>Occasions:</strong> <span id="modalOccasions"></span></p>
        </div>
    </div>
</body>
</html>