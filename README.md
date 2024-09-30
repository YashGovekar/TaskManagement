# Task Management System

### Steps to install:

- Clone this repository using `git clone https://github.com/YashGovekar/TaskManagement`
- Run `composer install`
- Run `npm i`
- Create a new database in your system.
- Run `cp .env.example .env` - This will create a new `.env` file using existing the `.env.example` file. 
- Put in your database details within the `.env` file
- Run `php artisan migrate:fresh --seed`
- Run `php artisan key:generate`.
- That's it!

### Now to run the application:

- Run `npm run build`. You can run `npm run dev` if you want to debug the application.
- Now run `php artisan serve`.
- This shall start your application and redirect you to a login page.
- To login, use email: `test@example.com` and password: `test1234#`.


## Features

- Built on SOLID Principles.
- Added compatibility for CI/CD Pipeline.
- Draggable priority-wise tasks.


## To build
- PHP Unit tests
- TBA

## Feel free to raise issues if something is not working.