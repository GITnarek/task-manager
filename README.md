# Task Manager Application

Welcome to the Task Manager Application! This application is built using Laravel 9 on the backend and Vue.js on the frontend.

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
- [Features](#features)
- [Contributing](#contributing)
- [License](#license)

## Installation

To get started with the Task Manager Application, follow these steps:

1. Clone this repository to your local machine:

   ```bash
   git clone https://github.com/your-username/task-manager.git
   ```

2. Navigate to the project directory:

   ```bash
   cd task-manager
   ```

3. Install PHP dependencies using Composer:

   ```bash
   composer install
   ```

4. Install JavaScript dependencies using npm or Yarn:

   ```bash
   npm install
   ```

   or

   ```bash
   yarn install
   ```

5. Navigate to the frontend directory:

   ```bash
   cd task-manager/frontend
   ```

6. Install frontend dependencies:

   ```bash
   npm install
   ```

7. Run the frontend server:

   ```bash
   npm run serve
   ```

   This will start the frontend development server, and you can access the Vue.js application by visiting `http://localhost:8080` in your web browser.

8. Navigate back to the project root directory:

   ```bash
   cd ..
   ```

9. Set up your environment variables by renaming the `.env.example` file to `.env` and configuring it with your database credentials and other settings.

10. Generate application key:

    ```bash
    php artisan key:generate
    ```

11. Migrate the database:

    ```bash
    php artisan migrate
    ```

## Usage

To run the Task Manager Application, execute the following command:

```bash
php artisan serve
```

This will start a development server for the Laravel backend, and you can access the application by visiting `http://localhost:8000` in your web browser.

## Features

- Create, read, update, and delete tasks.
- Assign tasks to specific users.
- Categorize tasks into different categories.
- Mark tasks as completed.
- Search and filter tasks.
- User authentication and authorization.

## Contributing

Contributions are welcome! If you find any issues or have suggestions for improvements, please feel free to open an issue or submit a pull request.

## License

This project is licensed under the [MIT License](LICENSE).
