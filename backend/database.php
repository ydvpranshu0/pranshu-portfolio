<?php
// ==========================================
// DATABASE BOOTSTRAP
// Provides a single database connection helper for admin and contact handlers.
// ==========================================

require_once __DIR__ . '/../includes/config.php';

function getPortfolioPdo(): PDO
{
    return getDbConnection();
}
