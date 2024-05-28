# To-Do List Application

This is a simple To-Do List application developed in PHP and JavaScript. It allows users to add, complete, and delete tasks. The application uses a MySQL database to store the tasks.

## Features

- Add new tasks
- Mark tasks as complete
- Delete tasks
- View incomplete tasks by default
- Option to view all tasks including completed ones

## Getting Started

### Prerequisites

To run this project, you need the following installed:

- PHP
- MySQL
- A web server (e.g., Apache)
- Git

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/Rajputvipul1/todo_list.git
   cd todo_list
2. Set up the database:

    Create a MySQL database named todo_list.
    
    Use the following SQL to create the tasks table:
    
        CREATE DATABASE todo_list;
        USE todo_list;
        
        CREATE TABLE tasks (
            id INT AUTO_INCREMENT PRIMARY KEY,
            task VARCHAR(255) NOT NULL,
            completed TINYINT(1) DEFAULT 0
        );
3. Update the database configuration in tasks.php:

      $servername = "localhost";
      $username = "your_database_username";
      $password = "your_database_password";
      $dbname = "todo_list";



