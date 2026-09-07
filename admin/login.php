<?php
require_once __DIR__ . '/../includes/config.php';

startPortfolioSession();

$loginMessage = '';
$csrfToken = getCsrfToken();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!isValidCsrfToken($_POST['csrf_token'] ?? null)) {
        $loginMessage = 'Your session has expired. Please try again.';
    } elseif ($username === '' || $password === '') {
        $loginMessage = 'Please enter both username and password.';
    } else {
        try {
            $pdo = getDbConnection();
            $statement = $pdo->prepare(
                'SELECT id, username, password_hash FROM admin_users WHERE username = :username LIMIT 1'
            );
            $statement->execute(['username' => $username]);
            $admin = $statement->fetch();

            if ($admin && password_verify($password, $admin['password_hash'])) {
                session_regenerate_id(true);
                $_SESSION['portfolio_admin_logged_in'] = true;
                $_SESSION['portfolio_admin_id'] = (int) $admin['id'];
                $_SESSION['portfolio_admin_user'] = $admin['username'];
                getCsrfToken();
                header('Location: dashboard.php');
                exit;
            }

            $loginMessage = 'Invalid username or password.';
        } catch (Throwable $e) {
            error_log('Portfolio admin login failed: ' . $e->getMessage());
            $loginMessage = 'The admin service is unavailable. Check the database configuration.';
        }
    }
}

$pageTitle = 'Admin Login';
$pageDescription = 'Portfolio admin login';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/responsive.css" />
    <style>
      body { background: var(--bg-primary); color: var(--text-primary); }
      .login-wrap { min-height: 100vh; display: grid; place-items: center; padding: 2rem; }
      .login-box { width: min(480px, 100%); background: rgba(17,17,17,0.8); border: 1px solid rgba(255,255,255,0.08); border-radius: 22px; padding: 2rem; }
      .login-box h1 { margin-bottom: 1.5rem; }
      .login-box input { width: 100%; margin-bottom: 1rem; }
      .alert { margin-top: 1rem; }
    </style>
  </head>
  <body>
    <div class="login-wrap">
      <div class="login-box">
        <h1>Portfolio Admin</h1>
        <form method="post">
          <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8'); ?>" />
          <label for="username">Username</label>
          <input type="text" id="username" name="username" maxlength="100" autocomplete="username" required />

          <label for="password">Password</label>
          <input type="password" id="password" name="password" autocomplete="current-password" required />

          <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <?php if ($loginMessage !== ''): ?>
          <div class="alert alert-danger" role="alert"><?php echo htmlspecialchars($loginMessage); ?></div>
        <?php endif; ?>
      </div>
    </div>
  </body>
</html>
