Execute following commands for installation:

1. Clone the repository:
`git clone https://github.com/007Shawon/Human-Resource-Management-system.git`

2. Navigate to the project directory: `cd Human-Resource-Management-system`

3. Install Backend Dependencies: `composer install`
   
4. Install Node Dependencies & Build Assets:
    `npm install`
    `npm run build`

5. Generate Application Key:
   `php artisan key:generate`
   
6. Create the Database: Create a database for the project in MySQL.

7. Environment Configuration: In the root directory of the project, copy the .env.example file to a new file named .env: cp .env.example .env

8. Set the following database values in the .env file:
    DB_HOST
    DB_PORT
    DB_DATABASE
    DB_USERNAME
    DB_PASSWORD

9. Run Database Migrations:
   `php artisan migrate`

10. If you want to add sample data for testing:
   `php artisan db:seed`

12.  Start the Development Server:
    `php artisan serve`

10. Access the Application: Open your browser and visit: "http://127.0.0.1:8000"
