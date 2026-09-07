<?php
// ==========================================
// ADMIN LOGOUT HANDLER
// Ends the admin session securely.
// ==========================================

require_once __DIR__ . '/../includes/config.php';

startPortfolioSession();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isValidCsrfToken($_POST['csrf_token'] ?? null)) {
    http_response_code(405);
    header('Location: login.php');
    exit;
}

$_SESSION = [];
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', [
        'expires' => time() - 42000,
        'path' => $params['path'],
        'secure' => $params['secure'],
        'httponly' => $params['httponly'],
        'samesite' => $params['samesite'] ?? 'Lax',
    ]);
}
session_destroy();
header('Location: login.php');
exit;
