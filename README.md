User Analytics 
======




Installation
-----

Run a command,

```
composer require mansi/analytics
```
To publish configurations,

```
php artisan vendor:publish --tag=analysis
```
To run testcases
```
php artisan test --testsuite=Feature
```
Usage
-----
Track user's activity on your website Run below command.

Use seperate database for analysis 
    
1. Difine new connection in Database.php config file
    ```
    Ex:
        'analysis_mysql' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('PACKAGE_DB_HOST', '127.0.0.1'),
            'port' => env('PACKAGE_DB_PORT', '3306'),
            'database' => env('PACKAGE_DB_DATABASE', 'forge'),
            'username' => env('PACKAGE_DB_USERNAME', 'forge'),
            'password' => env('PACKAGE_DB_PASSWORD', ''),
            'unix_socket' => env('PACKAGE_DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
    ```

2. Difine connection variables in .env file
    ```
    Ex:
        PACKAGE_DB_CONNECTION=analysis_mysql
        PACKAGE_DB_HOST=127.0.0.1
        PACKAGE_DB_PORT=3306
        PACKAGE_DB_DATABASE=analysis
        PACKAGE_DB_USERNAME=root
        PACKAGE_DB_PASSWORD=admin
    ```
Run Migration
```
php artisan migrate
```


Information
-----
 session table contain the data and type 

 | name | datatype | 
| --------------- | --------------- | 
| id | bigint unsigned Auto Increment |	
| session_id |	varchar(32) |	
| ip_address |	varchar(20)	|
| device_name |	varchar(50)	|
| brand	| varchar(50) NULL	|
| model	| varchar(50) NULL	|
| os	| varchar(20) |	
| browser |	varchar(20)	|
| country |	varchar(20) NULL |	
| state |	varchar(20) NULL |	
| city	| varchar(20) NULL |

 visited_pages table contain the data and type 

 | name | datatype | 
| --------------- | --------------- | 
| id |	bigint unsigned Auto Increment |
| page_url |	varchar(255) |	
| website | varchar(50) |
| status | enum('running','failed') | 
| time_spent |	int	|

 page_activities table contain the data and type 

 | name | datatype | 
| --------------- | --------------- | 
| id |	bigint unsigned Auto Increment |	
| clicked_element |	varchar(255) |	
| timestamp	| varchar(50) |	
| visited_page_id |	int |
| session_id |	varchar(32)	|
| action | varchar(50) | Ex:- 'buy now','opened','closed','favorite','unfavorite','other'

* whenever configuration will be published , analytics.js & ignoreUrl.php (config) file will be published in public/js directory.Then analytics.js will be used as other js file is used.

* For using analytics.js file in all pages of website,include file in header layout file or other layout file which is used in all file.
    ```
        Ex:
            <script src="{{ URL::asset('js/analytics.js') }}"></script>
            <script>
                var base_path = "{{ url('/') }}/";
            </script>
    ```
* If you want skip any pages (do not want to track) , then write that url in ignoreUrl.php (config) file.