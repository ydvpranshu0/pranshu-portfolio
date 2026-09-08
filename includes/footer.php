<?php
// ==========================================
// GLOBAL FOOTER INCLUDE
// Shared footer for PHP pages.
// ==========================================

require_once __DIR__ . '/config.php';

$assetBaseUrl = portfolioUrl('assets');
?>
<footer class="site-footer">
  <div class="container footer-inner">
    <div>
      <h3>Pranshu Yadav</h3>
      <p>Full-Stack Web Developer | WordPress Specialist</p>
    </div>
    <div class="footer-links">
      <a href="mailto:pranshu.rama@gmail.com">Email</a>
      <a href="https://linkedin.com/in/pranshu0" target="_blank" rel="noopener">LinkedIn</a>
    </div>
  </div>
  <div class="container footer-bottom">
    <p>© <span id="currentYear"></span> Pranshu Yadav. All Rights Reserved.</p>
  </div>
</footer>

<script src="<?php echo htmlspecialchars($assetBaseUrl . '/js/bootstrap.bundle.min.js', ENT_QUOTES, 'UTF-8'); ?>"></script>
<script src="<?php echo htmlspecialchars($assetBaseUrl . '/js/main.js', ENT_QUOTES, 'UTF-8'); ?>"></script>
<script src="<?php echo htmlspecialchars($assetBaseUrl . '/js/animations.js', ENT_QUOTES, 'UTF-8'); ?>"></script>
</body>
</html>
