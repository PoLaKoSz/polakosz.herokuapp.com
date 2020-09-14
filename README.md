# https://polakosz.000webhostapp.com

## Deploy project
1. Clone project
2. Install [Git bash](https://git-scm.com/downloads)
3. Install [VS Code](https://code.visualstudio.com/download)
4. Install [Node.js with NPM](https://nodejs.org/en/download)
5. Integrate Git bash into VS Code

      Add `"terminal.integrated.shell.windows": "C:\\Program Files\\Git\\bin\\bash.exe",` line into the User Settings
6. `$ cd <cloned-project-path>`
7. Rename `.env.example` to `.env`
8. Install PHP required packages

      `$ composer install`
9. Generate an APP_KEY

      `$ php artisan key:generate`
10. Create a DataBase and set the connection details in the `.env` file
11. Install Node dependencies (to [Compile Assets with Laravel Mix](https://laravel.com/docs/5.5/mix))

     `npm install`
12. Generate (JS, CSS) assets

      `npm run prod`
13. Create log file

      `/storage/logs/laravel.log`
14. Set permissions (write)

      `/bootstrap/cache/` folder

      `/storage/` folder

## Deploying to https://www.000webhost.com

15. Rename `/public/` folder to `/public_html/`

## Develop
- JS, CSS
  - `npm run watch`

## Test
Run `$ composer run-all-tests` to run the Unit and Feature tests.
Run `$ composer get-coverage` to generate HTML code coverage.

## Code formatting

Please use the `$ composer run-tidy` command before every commit to make sure the source code formatted properly.
