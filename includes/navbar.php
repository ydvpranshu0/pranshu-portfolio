<?php
// ==========================================
// SHARED NAVIGATION
// Keep primary navigation consistent across PHP pages.
// ==========================================

require_once __DIR__ . '/config.php';

$homeUrl = portfolioUrl('index.html');
?>
<header class="site-header">
  <nav class="navbar navbar-expand-lg fixed-top navbar-glass">
    <div class="container">
      <a class="navbar-brand" href="<?php echo htmlspecialchars($homeUrl, ENT_QUOTES, 'UTF-8'); ?>">Pranshu</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav ms-auto align-items-lg-center">
          <li class="nav-item"><a class="nav-link" href="<?php echo htmlspecialchars($homeUrl . '#home', ENT_QUOTES, 'UTF-8'); ?>">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo htmlspecialchars(portfolioUrl('about.html'), ENT_QUOTES, 'UTF-8'); ?>">About</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo htmlspecialchars($homeUrl . '#skills', ENT_QUOTES, 'UTF-8'); ?>">Skills</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo htmlspecialchars($homeUrl . '#experience', ENT_QUOTES, 'UTF-8'); ?>">Experience</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo htmlspecialchars(portfolioUrl('projects.html'), ENT_QUOTES, 'UTF-8'); ?>">Projects</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo htmlspecialchars($homeUrl . '#services', ENT_QUOTES, 'UTF-8'); ?>">Services</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo htmlspecialchars(portfolioUrl('contact.php'), ENT_QUOTES, 'UTF-8'); ?>">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>
</header>
