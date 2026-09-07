<?php
// ==========================================
// GLOBAL HEADER INCLUDE
// Shared page header for PHP-driven pages.
// ==========================================

require_once __DIR__ . '/config.php';

$assetBaseUrl = portfolioUrl('assets');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars($pageTitle ?? 'Pranshu Yadav'); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($pageDescription ?? 'Pranshu Yadav portfolio'); ?>" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo htmlspecialchars($assetBaseUrl . '/css/bootstrap.min.css', ENT_QUOTES, 'UTF-8'); ?>" />
    <link rel="stylesheet" href="<?php echo htmlspecialchars($assetBaseUrl . '/css/style.css', ENT_QUOTES, 'UTF-8'); ?>" />
    <link rel="stylesheet" href="<?php echo htmlspecialchars($assetBaseUrl . '/css/responsive.css', ENT_QUOTES, 'UTF-8'); ?>" />
    <link rel="stylesheet" href="<?php echo htmlspecialchars($assetBaseUrl . '/css/animations.css', ENT_QUOTES, 'UTF-8'); ?>" />
  </head>
  <body>
