URL Shortener

Description:

This project is a web application for shortening URL's.

Features:

This web application shortens the provided URL.

Technologies Used:

-Frontend: HTML, CSS, JavaScript (Vue.js) -Backend: PHP (Laravel) -Database: MySQL

Installation: To run the project locally, follow these steps:

-Clone the repository to your local machine. -Navigate to the project directory. -Run composer install. -Install dependencies by running npm install for the frontend and composer install for the backend. -Set up the database and configure the database connection in the Laravel .env file (copy example env file, update it). -Run migrations to create the necessary tables in the database: php artisan migrate. -Run php artisan key:generate after pasting key into .env file. -Start the Laravel server: php artisan serve. -Start the Vue server: npm run dev. -Access the application in your web browser at http://localhost:8000.

Usage: -Upon accessing the application, paste the URL that you want to shorten into the input field, then click on the "Shorten URL" button. You will be provided with a shortened version of the original URL or an error message if the link is marked as malicious by Google.
