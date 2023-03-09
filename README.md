## How to run the Project

- first you need to install the dependencies using `composer install`
- now you need to copy `.env.example` in the root directory and rename it to `.env`
- now you need to create a key for laravel `php artisan key:gen`
- we need to setup our database just run this command and answer yes if you didnt create any database `php artisan migrate --seed`
- run `php artisan serve --port=8001` command and start using the project at this address: `http://127.0.0.1:8001/`



### Note:
- I could use docker in order to simplify the process of bootstrapping the project but due to the lack of time I had no choice to choose this way.
- You can also get this project from `https://github.com/VeRJiL/task-project-interview`