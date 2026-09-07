<?php
require_once __DIR__ . '/../backend/database.php';

startPortfolioSession();

if (
    empty($_SESSION['portfolio_admin_logged_in'])
    || empty($_SESSION['portfolio_admin_id'])
    || !is_int($_SESSION['portfolio_admin_id'])
) {
    header('Location: login.php');
    exit;
}

$pdo = null;
$messages = [];
$dbError = '';
$csrfToken = getCsrfToken();

try {
    $pdo = getPortfolioPdo();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $deleteId = filter_input(INPUT_POST, 'delete_id', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

        if (!isValidCsrfToken($_POST['csrf_token'] ?? null) || $deleteId === false || $deleteId === null) {
            http_response_code(400);
            throw new RuntimeException('Invalid message deletion request.');
        }

        $deleteStmt = $pdo->prepare('DELETE FROM contact_messages WHERE id = :id');
        $deleteStmt->execute(['id' => $deleteId]);
        header('Location: dashboard.php');
        exit;
    }

    $stmt = $pdo->query(
        'SELECT id, name, email, subject, message, created_at FROM contact_messages ORDER BY created_at DESC, id DESC'
    );
    $messages = $stmt->fetchAll();
} catch (Throwable $e) {
    error_log('Portfolio dashboard database operation failed: ' . $e->getMessage());
    $dbError = 'Database is not configured yet. Import the SQL file and check includes/config.php.';
}

$pageTitle = 'Admin Dashboard';
$pageDescription = 'View and manage portfolio messages';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <style>
      body { background: var(--bg-primary); color: var(--text-primary); }
      .admin-shell { max-width: 1100px; margin: 3rem auto; padding: 0 1rem; }
      .admin-card { background: rgba(17,17,17,0.8); border: 1px solid rgba(255,255,255,0.08); border-radius: 24px; padding: 2rem; }
      table { width: 100%; color: #fff; }
      th, td { padding: 0.9rem; border-bottom: 1px solid rgba(255,255,255,0.08); vertical-align: top; }
      .topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
      .topbar form { margin: 0; }
      .topbar button { color: var(--accent-orange); background: none; border: 0; padding: 0; }
      .table-wrap { overflow-x: auto; }
      .empty-state { color: var(--text-secondary); padding: 2rem 0; }
    </style>
  </head>
  <body>
    <div class="admin-shell">
      <div class="topbar">
        <div>
          <h1>Admin Dashboard</h1>
          <p>Welcome, <?php echo htmlspecialchars($_SESSION['portfolio_admin_user'] ?? 'admin'); ?></p>
        </div>
        <form method="post" action="logout.php">
          <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8'); ?>" />
          <button type="submit">Logout</button>
        </form>
      </div>

      <div class="admin-card">
        <?php if (!empty($dbError)): ?>
          <div class="alert alert-warning"><?php echo htmlspecialchars($dbError); ?></div>
        <?php elseif (empty($messages)): ?>
          <div class="empty-state">No contact messages yet.</div>
        <?php else: ?>
          <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($messages as $message): ?>
                <tr>
                  <td><?php echo (int) $message['id']; ?></td>
                  <td><?php echo htmlspecialchars($message['name']); ?></td>
                  <td><?php echo htmlspecialchars($message['email']); ?></td>
                  <td><?php echo htmlspecialchars($message['subject']); ?></td>
                  <td><?php echo nl2br(htmlspecialchars($message['message'])); ?></td>
                  <td><?php echo htmlspecialchars($message['created_at']); ?></td>
                  <td>
                    <form method="post" onsubmit="return confirm('Delete this message?');">
                      <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8'); ?>" />
                      <input type="hidden" name="delete_id" value="<?php echo (int) $message['id']; ?>" />
                      <button type="submit" class="btn btn-sm btn-outline">Delete</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </body>
</html>
