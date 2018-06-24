# https://polakosz.000webhostapp.com

## Deploy project
1. Clone project
2. Install [Git bash](https://git-scm.com/downloads)
3. Install [VS Code](https://code.visualstudio.com/download)
3. Install [Node.js with NPM](https://nodejs.org/en/download)
4. Integrate Git bash into VS Code

      Add `"terminal.integrated.shell.windows": "C:\\Program Files\\Git\\bin\\bash.exe",` line into the User Settings
5. `$ cd <cloned-project-path>`
6. Rename `.env.example` to `.env`
7. Install PHP required packages

      `$ composer install`
8. Generate an APP_KEY

      `$ php artisan key:generate`
9. Create a DataBase and set the connection details in the `.env` file
10. Create log file

      `/storage/logs/laravel.log`
11. Set permissions (write)

      `/bootstrap/cache/` folder

      `/storage/` folder

## Deploy on https://www.000webhost.com/
12. Rename `/public/` folder to `/public_html/`
13. [env() helper](https://laravel.com/docs/5.5/helpers#method-env) function [useless](https://www.000webhost.com/forum/t/laravel-has-stopper-seeing-env/127154/5) on free plan so one workaround is to hard code (jajjj) into
    - `/config/app.php`

         Change `'name' => env('APP_NAME', 'Laravel'),` to `'name' => env('APP_NAME', 'PoLáKoSz Corp.'),`
         
         Change `'key' => env('APP_KEY'),` to `'key' => '<previously_generated_APP_KEY>',`

    - `/config/database.php`

         Change `'host' => env('DB_HOST', '127.0.0.1'),` to `'host' => env('DB_HOST', 'localhost'),`
         
         Change `'database' => env('DB_DATABASE', 'forge'),` to `'database' => '<ACTUAL_DB_NAME>',`
         
         Change `'database' => env('DB_USERNAME', 'forge'),` to `'database' => '<ACTUAL_DB_USERNAME>',`
         
         Change `'database' => env('DB_PASSWORD', 'forge'),` to `'database' => '<ACTUAL_DB_PASSWORD>',`
    

## WARNING!
Because env() function not working on the free 000webhostapp.com the `APP_REG_ENABLED` allways be `false`.

## Develop
- Install Node dependencies (to [Compile Assets with Laravel Mix](https://laravel.com/docs/5.5/mix))

     `npm install`
