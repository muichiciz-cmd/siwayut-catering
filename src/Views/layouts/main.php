<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars((string)($title ?? ''), ENT_QUOTES, 'UTF-8') ?> — <?= htmlspecialchars((string)APP_NAME, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/app.css?v=2">
</head>
<body>
    <div class="parallax-orbs">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>
    <div class="app-layout">
        <?php require __DIR__ . '/../partials/sidebar.php'; ?>
        <div class="main-wrapper">
            <?php require __DIR__ . '/../partials/navbar.php'; ?>
            <main class="content">
                <?php require __DIR__ . '/../partials/flash.php'; ?>
                <?= $content ?? '' ?>
            </main>
        </div>
    </div>
    <script src="/assets/js/app.js"></script>
</body>
</html>
