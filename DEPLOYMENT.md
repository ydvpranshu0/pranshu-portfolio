# Deployment Guide

This guide explains how to deploy the portfolio to normal PHP shared hosting using cPanel or Apache.

## 1. Prepare the Files

Upload the project folder to your hosting account root or a subdirectory such as:

```text
public_html/pranshu-portfolio/
```

## 2. Create the MySQL Database

In cPanel:

1. Open MySQL Database Wizard.
2. Create a new database.
3. Create a database user.
4. Assign the user to the database with full privileges.

Example:

```text
Database: pranshu_portfolio
User: pranshu_user
```

## 3. Import the SQL File

1. Open phpMyAdmin.
2. Select the created database.
3. Click Import.
4. Upload database/portfolio.sql.
5. Verify the table contact_messages is present.

## 4. Update Database Settings

Set the production database values in the server environment. `includes/config.php` reads these values and uses local XAMPP defaults only when they are absent:

```text
PORTFOLIO_DB_HOST=localhost
PORTFOLIO_DB_PORT=3306
PORTFOLIO_DB_NAME=pranshu_portfolio
PORTFOLIO_DB_USER=pranshu_user
PORTFOLIO_DB_PASS=your-strong-password
```

## 5. Configure Admin Credentials Securely

For admin login, do not store a plaintext password in source code. Generate a hash locally with PHP:

```php
<?php
$passwordHash = password_hash('yourStrongPassword', PASSWORD_DEFAULT);
echo $passwordHash;
?>
```

Insert the resulting hash into the production database:

```sql
INSERT INTO admin_users (username, password_hash)
VALUES ('admin', 'paste-the-generated-hash-here');
```

The dashboard verifies this hash with `password_verify()` and uses secure sessions and CSRF-protected admin actions.

## 6. Configure PHP Version

Use a PHP version compatible with the project (for example, PHP 8.1 or later if available).

## 7. Set File Permissions

Recommended values:

- Folders: 755
- PHP files: 644
- uploads/: 755

## 8. Configure Domain

Point your domain or subdomain to the virtual document root containing the project.

Example:

```text
https://yourdomain.com/
```

## 9. Enable HTTPS

Use the hosting panel to enable SSL or install a free certificate from Let’s Encrypt.

## 10. Test the Site

Check the following after deployment:

- Homepage loads correctly
- Projects page loads
- Contact form works
- Resume downloads successfully
- Admin login works
- Links open in new tabs where required

## 11. Troubleshooting

### 500 Internal Server Error

- Check PHP logs.
- Verify file permissions.
- Confirm config.php has valid database values.

### Contact form fails

- Test MySQL connection.
- Make sure contact_messages table exists.
- Ensure the DB user has INSERT privileges.

### Admin login fails

- Verify the `admin_users` table was imported into the configured database.
- Verify the username and `password_hash` were inserted correctly.

### Resume download fails

- Confirm the PDF exists in assets/resume.
- Check file permissions.

### SEO before launch

- Add the final canonical URL and absolute Open Graph URL once the production domain is known.
- Add the final domain to `robots.txt` and populate `sitemap.xml` with that domain.
