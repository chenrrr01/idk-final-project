# Admin Guide: Random Thoughts

This guide provides instructions for system administrators on how to configure and maintain the PHP-based **Random Thoughts** application on a Raspberry Pi Zero 2W.

---

## How to Configure the Application

### 1. Environment Setup
Ensure your Raspberry Pi Zero 2W has the following stack installed:
* **Web Server:** Apache or Nginx
* **Runtime:** PHP 8.x or higher
* **Database:** SQLite3 (A lightweight, file-based database ideal for the Pi Zero 2W)

### 2. File Permissions Configuration
Since the application uses a file-based SQLite database, the web server user (`www-data`) must have write permissions to the project directory and the database file. Run the following commands in your terminal:
```bash
sudo chown -R www-data:www-data /var/www/html/random-thoughts
sudo chmod -R 755 /var/www/html/random-thoughts