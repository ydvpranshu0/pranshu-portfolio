# Pranshu Yadav Portfolio

A premium dark futuristic portfolio website built for Pranshu Yadav, designed around HTML, CSS, Bootstrap, JavaScript, PHP, MySQL, Three.js, GSAP and ScrollTrigger.

## 1. Project Overview

This project presents a developer portfolio for Pranshu Yadav with:

- A cinematic hero section with 3D background effects
- About, skills, experience and project sections
- Responsive dark UI with orange accent palette
- Contact form with AJAX submission and PHP backend
- Admin login and message management
- Deployment-ready structure for shared hosting

## 2. Folder Structure

```text
pranshu-portfolio/
├── index.html
├── about.html
├── projects.html
├── contact.php
├── assets/
│   ├── css/
│   ├── js/
│   ├── images/
│   ├── resume/
│   └── models/
├── includes/
├── backend/
├── database/
├── admin/
├── uploads/
├── .htaccess
├── robots.txt
├── sitemap.xml
├── README.md
├── DEPLOYMENT.md
└── pranshu-portfolio.zip
```

## 3. Technologies Used

- HTML5
- CSS3
- Bootstrap
- JavaScript
- PHP
- MySQL
- Three.js
- GSAP
- GSAP ScrollTrigger

## 4. How to Run Locally

Option A: XAMPP / WAMP / MAMP

1. Place the project folder in the local web root.
   - XAMPP: htdocs/
   - WAMP: www/
2. Start Apache and MySQL.
3. Open the browser at http://localhost/pranshu-portfolio/
4. For the contact form, import the SQL file and update the database settings in includes/config.php.

## 5. How to Configure PHP

For XAMPP, the checked-in defaults in `includes/config.php` already target:

```php
$host = 'localhost';
$dbName = 'portfolio';
$dbUser = 'root';
$dbPass = '';
```

For deployment, set these server-side environment variables instead of adding production credentials to source files:

```text
PORTFOLIO_DB_HOST
PORTFOLIO_DB_PORT
PORTFOLIO_DB_NAME
PORTFOLIO_DB_USER
PORTFOLIO_DB_PASS
```

## 6. How to Configure MySQL

1. Open phpMyAdmin.
2. Create a database named portfolio.
3. Import database/portfolio.sql.
4. Verify the table contact_messages exists.

## 7. How to Import the Database

From the MySQL command line:

```powershell
Get-Content -Raw C:\xampp\htdocs\pranshu-portfolio\database\portfolio.sql | & 'C:\xampp\mysql\bin\mysql.exe' -u root
```

Or import through phpMyAdmin using the SQL file.

## 8. How to Configure the Contact Form

1. Update includes/config.php with valid DB credentials.
2. Make sure the database has been imported.
3. Confirm backend/contact-submit.php is reachable from your site root.
4. Test the form from the homepage or contact page.

## 9. How to Change Personal Information

Edit the central values in assets/js/main.js:

```javascript
const portfolioData = {
  name: "Pranshu Yadav",
  title: "Full-Stack Web Developer | WordPress Specialist | Web Developer",
  email: "pranshu.rama@gmail.com",
  phone: "+91 7991357578",
  location: "Kanpur, Uttar Pradesh, India",
};
```

Also update visible page content in index.html, about.html and projects.html when needed.

## 10. How to Add or Edit Projects

Edit the array in assets/js/projects.js:

```javascript
const projectData = [
  { name: "KFL", category: "Business & Corporate", url: "https://kfl.net.in/" },
];
```

Add each new project record with name, category, URL, description and technology details.

## 11. How to Change Colors

Edit the CSS variables in assets/css/style.css:

```css
:root {
  --bg-primary: #050505;
  --bg-secondary: #0b0b0b;
  --accent-orange: #ff6a00;
  --text-primary: #ffffff;
  --text-secondary: #9a9a9a;
}
```

## 12. How to Edit Animations

- Hero movement and 3D effects: assets/js/three-scene.js
- Scroll-driven animations: assets/js/animations.js
- Global behavior: assets/js/main.js

## 13. How to Replace Images

Place new graphics in:

- assets/images/profile/
- assets/images/projects/
- assets/images/general/

Use descriptive names and update relevant HTML or JS references.

## 14. How to Replace the Resume

Replace the PDF in:

```text
assets/resume/Pranshu_Yadav_Resume.pdf
```

Keep the same file name if using the current download link.

## 15. How to Deploy to Shared Hosting

1. Upload the project folder to the hosting root.
2. Create a MySQL database and user in cPanel or phpMyAdmin.
3. Import database/portfolio.sql.
4. Update includes/config.php with the production credentials.
5. Confirm PHP version compatibility.
6. Verify the domain is pointed to the project folder.
7. Enable HTTPS via hosting panel or certificate tool.
8. Test the contact form and resume download.

## 16. Troubleshooting

### Contact form not working

- Check includes/config.php credentials.
- Ensure the database has been imported.
- Confirm the MySQL user has permission to insert into contact_messages.

### Admin login setup

Admin users are stored in `portfolio.admin_users`. Generate a hash (never save a plaintext password in a project file), then insert the username and generated hash:

```powershell
& 'C:\xampp\php\php.exe' -r "echo password_hash('choose-a-long-unique-password', PASSWORD_DEFAULT), PHP_EOL;"
```

```sql
INSERT INTO admin_users (username, password_hash)
VALUES ('admin', 'paste-the-generated-hash-here');
```

The login verifies the hash with `password_verify()`, regenerates the session ID after login, and protects message deletion and logout with CSRF tokens.

### Blank page or 500 errors

- Check PHP error logs.
- Verify the server supports PDO with MySQL.
- Make sure php.ini allows the MySQL extension.

### 3D scene does not display

- Verify Three.js loads from CDN.
- Test in modern browser.
- Sensors or WebGL may be disabled in some environments.

## 17. Important Placeholders

Before production deployment, provide the final public domain and add a canonical URL, `robots.txt` sitemap directive, and populated `sitemap.xml` entries. A GitHub profile link can be added once the owner supplies it.

## 18. Security Notes

- Do not expose database credentials in JavaScript or HTML.
- Keep PHP config values server-side only.
- Use hashed credentials for admin access.
- Restrict sensitive folders using hosting rules or .htaccess when necessary.
- Use prepared statements for all database writes.
