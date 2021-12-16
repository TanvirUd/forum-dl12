# forum

Test website simulating a forum 

*This is only a prototype website. More updates will come soon.*

## Important

If you want to get it working for yourself make shore to chage the password of the SQL manager to whatever your password is for your root acount. 
It is located in the AbstractManager.php file in src/model/Manager/Abstractmanager.php

```PHP
     protected static function connect()
    {
        self::$connexion = new \PDO(
            "mysql:dbname=forum;host=localhost:3306",
            "root",
            "Admin",  <-- modify this line to your root password
            [
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
            ]
        );
    }
```
