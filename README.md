# GEGI LLC test assignment

## Installation

1. Clone repo

```
git clone https://github.com/dimichspb/gegi
```

2. Change directory

```
cd gegi
```

3. Install dependenies

```
composer install
```

## Configuration

1. Setup apache configuration

```
<VirtualHost *:80>
    DocumentRoot "C:/Projects/PHP/gegi/web"
    ServerName gegi.localhost
    <Directory "C:/Projects/PHP/gegi/web">
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all Granted
    </Directory>
</VirtualHost>
```

2. Restart apache service

```
apachectl restart
```

3. Configure database connection:

Production:
```
config\db.php
```
Testing:
```
config\test_db.php
```

4. Apply migrations:

Production:
```
php yii migrate
```

Testing:
```
php test migrate
```

5. Import data:

```
php yii data\import
```

## Usage

1. Web GUI

```
http://gegi.localhost
```

2. Console

```
php yii data\import
```

## Tests

```
codecept run
```

## TODOs

Implement more unit tests