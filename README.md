# Task Management System

### Steps to install:

- Clone this repository using `git clone https://github.com/YashGovekar/TaskManagement`
- Run `composer install`
- Run `npm i`
- Create a new database in your system.
- Run `cp .env.example .env` - This will create a new `.env` file using existing the `.env.example` file. Put in your database details within the `.env` file
- Run `php artisan migrate`
- That's it!

### Now to run the application:

- Run `npm run build`. You can run `npm run dev` if you want to debug the application.
- Now run `php artisan serve`.
- This shall start your application. 

## Feel free to raise a issues if something is not working.