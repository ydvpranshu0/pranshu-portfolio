<?php
require __DIR__ . '/includes/config.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact | Pranshu Yadav</title>
    <meta name="description" content="Contact Pranshu Yadav for web development, WordPress, and website support services." />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/responsive.css" />
    <link rel="stylesheet" href="assets/css/animations.css" />
  </head>
  <body>
    <header class="site-header">
      <nav class="navbar navbar-expand-lg fixed-top navbar-glass">
        <div class="container">
          <a class="navbar-brand" href="index.html">Pranshu</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
              <li class="nav-item"><a class="nav-link" href="index.html#home">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
              <li class="nav-item"><a class="nav-link" href="index.html#skills">Skills</a></li>
              <li class="nav-item"><a class="nav-link" href="index.html#experience">Experience</a></li>
              <li class="nav-item"><a class="nav-link" href="projects.html">Projects</a></li>
              <li class="nav-item"><a class="nav-link" href="index.html#services">Services</a></li>
              <li class="nav-item"><a class="nav-link active" href="contact.php">Contact</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <main class="page-shell">
      <section class="section page-hero contact-page">
        <div class="container">
          <div class="row g-5 align-items-start">
            <div class="col-lg-5">
              <div class="section-intro reveal">
                <span class="section-kicker">Contact</span>
                <h1>Let’s build something useful and memorable.</h1>
              </div>
              <div class="contact-details reveal">
                <p><strong>Email:</strong> <a href="mailto:pranshu.rama@gmail.com">pranshu.rama@gmail.com</a></p>
                <p><strong>Location:</strong> Kanpur, Uttar Pradesh, India</p>
                <p><strong>LinkedIn:</strong> <a href="https://linkedin.com/in/pranshu0" target="_blank" rel="noopener">linkedin.com/in/pranshu0</a></p>
              </div>
            </div>
            <div class="col-lg-7">
              <form id="contactForm" class="contact-form reveal" action="backend/contact-submit.php" method="post" novalidate>
                <div class="row g-3">
                  <div class="col-md-6">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" minlength="2" maxlength="150" autocomplete="name" required />
                  </div>
                  <div class="col-md-6">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" maxlength="255" autocomplete="email" required />
                  </div>
                  <div class="col-12">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" minlength="2" maxlength="255" required />
                  </div>
                  <div class="col-12">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" minlength="10" maxlength="5000" required></textarea>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
                  </div>
                  <div class="col-12 form-message" id="formMessage" aria-live="polite"></div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
    </main>

    <footer class="site-footer">
      <div class="container footer-inner">
        <div>
          <h3>Pranshu Yadav</h3>
          <p>Full-Stack Web Developer | WordPress Specialist</p>
        </div>
      </div>
    </footer>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/form-validation.js"></script>
    <script src="assets/js/animations.js"></script>
  </body>
</html>
