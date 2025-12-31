Execute following commands for installation:

1. Clone the repository:
`git clone https://github.com/007Shawon/Human-Resource-Management-system.git`

2. Navigate to the project directory: `cd Human-Resource-Management-system`

3. Install Backend Dependencies: `composer install`
   
4. Install Node Dependencies & Build Assets:
    `npm install 
     npm run build`
   
5. Create the Database: Create a database for the project in MySQL.

6. Environment Configuration: In the root directory of the project, copy the .env.example file to a new file named .env: cp .env.example .env

7. Set the following database values in the .env file:
    DB_HOST
    DB_PORT
    DB_DATABASE
    DB_USERNAME
    DB_PASSWORD

8. Run Database Migrations:
   `php artisan migrate`
   
9.  Generate Application Key:
   `php artisan key:generate`

10.  Start the Development Server:
    `php artisan serve`

11. Access the Application: Open your browser and visit: "http://127.0.0.1:8000"
