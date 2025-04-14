# Gleam And Grace Website

## 🔧 Installation

1. Run `composer install` (you may also want to run `composer self-update` first).
2. Import the database schema:
    - Open **phpMyAdmin** and execute `schema.sql` , **or**
    - Connect your database using an IDE like **PhpStorm** and run the file.
    - Populate the database by running `seed.sql`
3. Start the CakePHP development server (or use your local web server):

   ```bash bin/cake server -p 8765```


Then visit `http://localhost:8765` to see the home page.


## ⚙️ Configuration
Edit the environment-specific settings in:

**config/app_local.php** → for database and local config (e.g., 'Datasources')

**config/app.php** → for environment-agnostic or global configuration


## 🛠 Useful Commands
**Export the Current Database Schema**

To dump the current database structure (without data) into migration.sql:

```mysql
mysqldump -u your_mysql_username -p --no-data fit3047_app > migration.sql
```
Replace your_mysql_username with your actual MySQL username (e.g., poorvikaarthikeyayeluri).
You’ll be prompted to enter your MySQL password.

## 📦 Migrations
To create and apply database migrations:

**Create a New Migration**

```bash
bin/cake bake migration MigrationName field:type
```
***Example:***
```bash
bin/cake bake migration AddImageUrlToProducts image_url:string
```

**Run Migrations**
```bash
bin/cake migrations migrate
```

**Rollback Last Migration**
```bash
bin/cake migrations rollback
```
