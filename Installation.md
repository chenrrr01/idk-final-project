# Installation

## Requirements

- Raspberry Pi Zero 2W running Raspberry Pi OS Lite
- Apache2
- PHP 8.x with `php-mysql` extension
- MariaDB

## Steps

### 1. Update the system

```bash
sudo apt update && sudo apt upgrade -y
```

### 2. Install Apache and PHP

```bash
sudo apt install apache2 php libapache2-mod-php php-mysql -y
```

### 3. Install MariaDB

```bash
sudo apt install mariadb-server -y
sudo mysql_secure_installation
```

### 4. Create the database and user

```bash
sudo mariadb
```

```sql
CREATE DATABASE random_thoughts CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'rtuser'@'localhost' IDENTIFIED BY 'your_password';
GRANT ALL PRIVILEGES ON random_thoughts.* TO 'rtuser'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### 5. Deploy the application

```bash
sudo cp -r /path/to/repo/* /var/www/html/
sudo chown -R www-data:www-data /var/www/html/
```

### 6. Update config.php

Edit `/var/www/html/config.php` and set `DB_USER` and `DB_PASS` to match the credentials above.

### 7. Restart Apache

```bash
sudo systemctl restart apache2
```

### 8. Access the app

Open a browser and go to `http://<raspberry-pi-ip>/`
