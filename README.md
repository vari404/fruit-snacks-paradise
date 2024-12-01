# Fruit Snacks Paradise

Welcome to **Fruit Snacks Paradise**! A fun and creative website for sharing and managing fruit snack recipes.

## Features

- User registration and authentication
- Create, read, update, and delete fruit snack entries
- Upload and display images of fruit snacks
- Protected pages accessible only to logged-in users
- Client-side validation using JavaScript
- Sessions and cookies for persistent login
- Fun and creative design with playful fonts and vibrant colors

## Demo

*(Include screenshots or a link to a live demo if available.)*

## Prerequisites

- Local server environment (e.g., XAMPP, WAMP, MAMP)
- PHP 7.4 or higher
- MySQL 5.7 or higher

## Installation

1. **Clone the Repository**

   ```bash
   git clone https://github.com/vari404/fruit-snacks-paradise.git

   ## Database Setup

To set up the database for the Fruit Snacks Paradise website, follow these steps:

1. **Create the Database:**

   - Open phpMyAdmin by navigating to `http://localhost/phpmyadmin/` in your web browser.
   - Click on the **"Databases"** tab at the top.
   - In the **"Create database"** field, enter the database name:

     ```
     fruit_snacks_db
     ```

   - Click **"Create"**.

2. **Import the Database Schema:**

   - After creating the database, select it from the left sidebar.
   - Click on the **"Import"** tab at the top.
   - Click **"Choose File"** (or **"Browse"**) and select the `database.sql` file located in the project directory.
     - If you don't have a `database.sql` file yet, you can create one by exporting your database from phpMyAdmin. Instructions are provided below.
   - Leave the default settings as they are.
   - Click **"Go"** at the bottom to start the import process.
   - You should see a success message indicating that the database has been imported.

3. **Configure the Application:**

   - Copy `config.sample.php` from the `includes` directory and rename it to `config.php`.
   - Open `config.php` in a text editor.
   - Enter your database credentials:

     ```php
     <?php
     // config.php
     session_start();

     $servername = "localhost";
     $username = "root";          // Your MySQL username (default is 'root' in XAMPP)
     $password = "";              // Your MySQL password (default is empty in XAMPP)
     $dbname = "fruit_snacks_db"; // The database name you created
     $port = 3306;                // Default MySQL port

     // Create connection
     $conn = new mysqli($servername, $username, $password, $dbname, $port);

     // Check connection
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }
     ?>
     ```

   - Save the `config.php` file.

4. **Set Folder Permissions:**

   - Ensure the `images` folder in your project has the correct permissions to allow file uploads.
     - On Unix/Linux systems, you can use the command:

       ```bash
       chmod 755 images
       ```

     - On Windows, right-click the `images` folder, select **Properties**, go to the **Security** tab, and make sure your user account has **Write** permissions.

5. **Start Apache and MySQL Services:**

   - Open your XAMPP Control Panel.
   - Start the **Apache** and **MySQL** services.

6. **Access the Application:**

   - Open your web browser and navigate to `http://localhost/fruit_snacks_site/`.
   - You should see the home page of Fruit Snacks Paradise.
   - You can now register a new account and start using the application.

---

### **Including the `database.sql` File**

Ensure that the `database.sql` file is included in your project repository. This file contains the SQL statements needed to recreate your database schema (and optionally, sample data).

#### **Creating the `database.sql` File**

If you haven't already created the `database.sql` file, follow these steps:

1. **Export the Database from phpMyAdmin:**

   - Open phpMyAdmin and select your `fruit_snacks_db` database.
   - Click on the **"Export"** tab.
   - Choose the **"Custom"** export method.
   - Under **"Tables"**, ensure all tables (`users`, `snacks`) are selected.
   - Scroll down to **"Object creation options"** and ensure the following options are checked:
     - **Add DROP TABLE / VIEW / PROCEDURE / FUNCTION / EVENT / TRIGGER statement**
     - **Add CREATE TABLE statement**
     - **IF NOT EXISTS**
   - Click **"Go"** to download the `database.sql` file.

2. **Add the `database.sql` File to Your Project:**

   - Place the `database.sql` file in the root directory of your project or in a `database` folder.
   - Ensure it's included in your Git repository so that others can access it.

---

### **Complete README.md Example**

Here's how your `README.md` might look with the database instructions included:

```markdown
# Fruit Snacks Paradise

Welcome to **Fruit Snacks Paradise**! A fun and creative website for sharing and managing fruit snack recipes.

## Features

- User registration and authentication
- Create, read, update, and delete fruit snack entries
- Upload and display images of fruit snacks
- Protected pages accessible only to logged-in users
- Client-side validation using JavaScript
- Sessions and cookies for persistent login
- Fun and creative design with playful fonts and vibrant colors

