<?php
// ==========================================
// CONTACT FORM HANDLER
// Processes AJAX submissions and stores messages in MySQL.
// ==========================================

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('Cache-Control: no-store');

function sendJsonResponse(int $statusCode, bool $success, string $message): void
{
    http_response_code($statusCode);
    echo json_encode([
        'success' => $success,
        'message' => $message,
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

function characterLength(string $value): int
{
    return function_exists('mb_strlen') ? mb_strlen($value) : strlen($value);
}

function containsUnsafeControlCharacters(string $value): bool
{
    return preg_match('/[\\x00-\\x08\\x0B\\x0C\\x0E-\\x1F\\x7F]/u', $value) === 1;
}

function containsDisallowedMarkup(string $value): bool
{
    return preg_match('/<\\s*\\/?\\s*(?:script|iframe|object|embed|svg|img|style)\\b/i', $value) === 1;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendJsonResponse(405, false, 'Method not allowed.');
}

require_once __DIR__ . '/../includes/config.php';

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($name === '' || $email === '' || $subject === '' || $message === '') {
    sendJsonResponse(422, false, 'Please fill in all fields.');
}

if (
    characterLength($name) < 2
    || characterLength($name) > 150
    || characterLength($subject) < 2
    || characterLength($subject) > 255
    || characterLength($message) > 5000
    || characterLength($email) > 255
    || containsUnsafeControlCharacters($name)
    || containsUnsafeControlCharacters($subject)
    || containsUnsafeControlCharacters($message)
    || containsDisallowedMarkup($name)
    || containsDisallowedMarkup($subject)
    || containsDisallowedMarkup($message)
) {
    sendJsonResponse(422, false, 'Please check the length and characters used in your message.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    sendJsonResponse(422, false, 'Please enter a valid email address.');
}

if (characterLength($message) < 10) {
    sendJsonResponse(422, false, 'Message should be at least 10 characters long.');
}

try {
    $pdo = getDbConnection();
    $stmt = $pdo->prepare(
        'INSERT INTO contact_messages (name, email, subject, message) VALUES (:name, :email, :subject, :message)'
    );
    $stmt->execute([
        'name' => $name,
        'email' => $email,
        'subject' => $subject,
        'message' => $message,
    ]);

    sendJsonResponse(201, true, 'Thank you! Your message has been sent successfully.');
} catch (Throwable $e) {
    error_log('Portfolio contact form submission failed: ' . $e->getMessage());
    sendJsonResponse(500, false, 'The form could not be submitted right now. Please try again later.');
}
