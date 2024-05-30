# Laravel Social Media Site
A social media site built with Laravel. Made for Advanced Website Programming course.

## Features
- User authentication (registration, login, logout)
- User profiles, user settings
- Posts (create, read, update, delete)
- Comments on posts
- Likes on posts and comments
- Follow/Unfollow users

## Technologies Used
- PHP
- Laravel
- MySQL
- JavaScript
- HTML/CSS
- Bootstrap
- jQuery

## Installation
0. Start your MySQL database engine.
1. Clone the repository:
    ```bash
    git clone https://github.com/xxnls/laravel-social-media-site.git
    ```
2. Navigate to the project directory:
    ```bash
    cd laravel-social-media-site
    ```
3. Install the dependencies:
    ```bash
    composer install
    npm install
    ```
4. Copy the `.env.example` file to `.env`:
    ```bash
    cp .env.example .env
    ```
5. Generate the application key:
    ```bash
    php artisan key:generate
    ```
6. Run migrations:
    ```bash
    php artisan migrate
    ```
7. Seed the database with users and posts:
    ```bash
    php artisan db:seed
    ```
8. Serve the application:
    ```bash
    php artisan serve
    ```
9. Execute scripts
   ```bash
    npm run dev
    ```

## Usage
- Access the application at `http://localhost:8000`
- Register a new account
- Start creating posts, following users, and interacting with the conten
