# Flora. - Plant Nursery E-commerce Website 🌱

**Flora.** is a user-friendly e-commerce platform for purchasing plants. It features an intuitive user interface for browsing, wishlisting, and ordering plants, along with an admin panel for managing the site.

## Table of Contents

- [Features](#features)
- [Installation Guide](#installation-guide)
  - [Prerequisites](#prerequisites)
  - [Steps to Install XAMPP](#steps-to-install-xampp)
  - [Connecting to the Database](#connecting-to-the-database)
- [Running the Project](#running-the-project)
- [Contributing](#contributing)

## Features

- **User Interface**:
  - Browse and search for a variety of plants.
  - Add products to your wishlist for future reference.
  - Manage your shopping cart and complete orders by filling in address details.

- **Admin Panel**:
  - Admin access is restricted to specific users by modifying their `user_type` in the database.
  - Admins can manage products, orders, and user roles.

## Installation Guide

### Prerequisites

- **XAMPP Server**: A local server environment that includes Apache, MySQL, and PHP.

### Steps to Install XAMPP

1. **Download XAMPP**: 
   - Visit the official [XAMPP website](https://www.apachefriends.org/index.html).
   - Choose the appropriate version for your operating system and download it.

2. **Install XAMPP**:
   - Run the installer and follow the setup instructions.
   - Launch the XAMPP Control Panel after installation.

3. **Start Apache and MySQL**:
   - In the XAMPP Control Panel, click "Start" next to Apache and MySQL.

### Connecting to the Database

1. **Create the Database**:
   - Open `http://localhost/phpmyadmin/` in your browser.
   - Create a new database named `flora_db`.

2. **Import the Database Schema**:
   - Select the `flora_db` database.
   - Go to the "Import" tab and upload the provided SQL file.

3. **Configure Database Connection**:
   - Open `config.php` in the project folder.
   - Set the database connection details:
     ```php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "flora_db";
     ```
   - Save the file.

4. Admin Access Setup:
      Change a user's user_type to admin in the users table via phpMyAdmin.
## Running the Project

1. Move the project files to the `htdocs` folder inside your XAMPP installation directory.
2. Access the website by navigating to `http://localhost/flora` in your browser.
3. Register and use the site as a normal user, or log in as an admin after modifying the `user_type`.

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request, or open an issue for any bugs or feature requests.
