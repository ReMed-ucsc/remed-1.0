# MVC Framework

This is a simple MVC (Model-View-Controller) framework built with PHP. It provides a basic structure to help you organize your code and separate concerns in your web application.

## Features

- Simple and lightweight MVC structure
- Environment configuration using `.env` file
- Basic routing system
- Easy to extend and customize

## Requirements

- PHP 7.4 or higher
- A web server (e.g., Apache, Nginx)

## Installation

1. **Clone the repository:**

   ```sh
   git clone https://github.com/hansaja1119/MVC.git
   cd mvc
   ```

2. **Set up the environment configuration:**

   Create a `.env` file in the root directory of your project and add your database credentials:

   ```properties
   DBHOST=localhost
   DBUSER=root
   DBPASS=
   DBNAME=mydb
   ```

3. **Update the `.gitignore` file:**

   Ensure that the `.env` file is excluded from version control by adding it to your `.gitignore` file:

   ```plaintext
   /.env
   ```

4. **Configure your web server:**

   If you are using Apache, you can set up a virtual host for your project. Here is an example configuration:

   ```apache
      <Directory />
         AllowOverride All
         Require all denied
      </Directory>
   ```

   Make sure to restart your web server after making these changes.

## Usage

1. **Directory Structure:**

   The project directory structure is as follows:

   ```
   mvc/
   ├── app/
   │   ├── controllers/
   │   │   ├── admin/
   │   │   ├── user/
   │   ├── core/
   │   │   ├── config.php
   │   │   ├── init.php
   │   ├── models/
   │   ├── views/
   │       ├── admin/
   │       ├── user/
   ├── public/
   │   ├── index.php
   │   ├── assets/
   ├── .env
   ├── .gitignore
   ├── README.md
   ```

2. **Configuration:**

   The `config.php` file in the `app/core` directory is used to load environment variables and define constants for your application:

3. **Routing:**

   The `index.php` file in the `public` directory is the entry point for your application. It handles routing and dispatching requests to the appropriate controllers:

   ```php
   <?php

   require_once '../app/core/init.php';

   // Your routing logic here
   ```

4. **Creating Controllers:**

   Controllers are stored in the `app/controllers` directory. Each controller should extend a base controller class and handle specific routes:

   ```php
   <?php

   class Home
   {
       use Controller;
       public function index()
       {
           $this->view('home/index', $data);
       }
   }
   ```

5. **Creating Models:**

   Models are stored in the `app/models` directory. Each model should interact with the database and contain business logic:

   ```php
   <?php

   class User
   {
        use Model;
       // Your model logic here
   }
   ```

6. **Creating Views:**

   Views are stored in the `app/views` directory. Each view should contain the HTML and PHP code to render the page:

   ```php
   <!-- app/views/home.view.php -->
   <h1>Welcome to the MVC Framework</h1>
   ```

## Adding New Pages

To add a new page to your application, follow these steps:

1. **Create a new controller:**

   Create a new file in the `app/controllers` directory. For example, to create an `About` page, create `About.php`:

   ```php
   <?php

   class About
   {
       use Controller;
       public function index()
       {
           $this->view('user/about', $data);
       }
   }
   ```

2. **Create a new view:**

   Create a new directory and file in the `app/views` directory. For the `About` page, create `about.view.php`:

   ```php
   <!-- app/views/about.view.php -->
   <h1>About Us</h1>
   <p>This is the about page.</p>
   ```

## Contributing

Contributions are welcome! Please open an issue or submit a pull request if you have any improvements or bug fixes.

## License

This project is licensed under the MIT License. See the LICENSE file for details.
# remade-1.0
# admin-2
# admin-3
