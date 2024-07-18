# Laravel 11 User Management System

Welcome to the Laravel 11 User Management System! This application is designed to manage User data efficiently, featuring user registration and login, profile management, and role-based access control. The system ensures secure sessions for all users and provides a user-friendly interface for managing Users.

## Description

The Laravel 11 User Management System is a web-based application built using the Laravel framework. It allows users to register and log in to the system, access a personalized dashboard, update their profiles, view a list of all users, and perform actions such as editing and deleting user records. The application is designed with security in mind, ensuring that all user sessions are protected.

### Key Features

- **User Registration and Login:** Users can register with the system and log in using their credentials. After logging in, they are redirected to their dashboard.
- **Role-Based Access Control:** Users can be assigned different roles (e.g., Admin, User) with specific permissions.
- **User Dashboard:** The dashboard provides a personalized interface for users to manage their profiles and view other users.
- **Profile Management:** Users can update their profile information, ensuring that their data is always current.
- **User Management:** Admins can view a list of all users, with options to edit or delete user records.
- **Secure Sessions:** All user sessions are protected to prevent unauthorized access.

## Technologies Used

- Laravel 11
- PHP 8.x
- MySQL
- HTML/CSS
- Bootstrap (or any other CSS framework)
- JavaScript (if applicable)

## Installation

1. **Clone the repository:**
    ```bash
    git clone https://github.com/Kaushh21/laravel_11_crud_login_signup
    cd laravel-User-management
    ```

2. **Install dependencies:**
    ```bash
    composer install
    npm install
    ```

3. **Create a copy of the `.env` file:**
    ```bash
    cp .env.example .env
    ```

4. **Update the `.env` file with your database and other configurations:**
    ```plaintext
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```

5. **Generate an application key:**
    ```bash
    php artisan key:generate
    ```

6. **Run the database migrations:**
    ```bash
    php artisan migrate
    ```

7. **Seed the database (if applicable):**
    ```bash
    php artisan db:seed
    ```

8. **Start the local development server:**
    ```bash
    php artisan serve
    ```

9. **Access the application in your browser:**
    ```
    http://localhost:8000
    ```

## Usage

1. **Register a new user or log in with existing credentials.**
2. **After logging in, you will be redirected to the dashboard where you can:**
    - Update your profile
    - Logout
    - View all users with options to edit or delete
    - Session is protected for logged in users

