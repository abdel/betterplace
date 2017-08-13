# Betterplace Egypt
Aggregates and analyses data about crowd-funded projects in Egypt using the betterplace.org API

## Setting Up

Clone the repository to your web directory.
```
git clone https://github.com/abdelm/betterplace.git
```

Assuming you have Composer installed, run the command inside the `betterplace` directory to install application dependencies:
```
composer install
```

## Enivornment Configuration

Make a copy of the `.env.example` file and rename it to `.env` in order to modify your environment configuration including your database details.

To generate a new key for your application, use the following command:
```
php artisan key:generate
```

Simply set the `APP_KEY` variable to the key you just generated and modify the default database configuration to match your own. Also, make sure the directories `storage` and `bootstrap/cache` are writable by your web server.

## Migration

Run all outstanding migrations available in the application after changing your database config using 
```
php artisan migrate
```

## Virtual Host

Add a new virtual host to point to the `public` web directory for Laravel by modifying the `httpd-vhosts.conf` if you're using **Apache** or by adding a new file to your `sites-available` directory if you're using **ngnix**.

**Apache Example:**
```
<VirtualHost *:80>
    DocumentRoot "/path/to/betterplace/public/"
    ServerName betterplace.app
    ErrorLog "logs/betterplace.app-error.log"
    CustomLog "logs/betterplace.app-access.log" common
</VirtualHost>
```

**nginx Example:**
```
server {
  listen   80;

  root /path/to/betterplace/public;
  index index.html index.htm index.php;

  server_name betterplace.app;
}
```

Adjust your `/etc/hosts` to add a new record for the server name you chose, for example:
```
127.0.0.1 betterplace.app
```

## Scheduling

The application uses Laravel's built in scheduling tasks to update all project data and opinions for each individual project. In order to use Laravel's scheduling task, you only need to add one cron entry to call Laravel's scheduling system:
```
* * * * * php /path/to/artisan schedule:run 1>> /dev/null 2>&1
```
