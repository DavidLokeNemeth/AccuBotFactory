# Accu Bot Factory Documentation

##Introduction

This coding challenge is part of the interview process for the PHP Developer position at Accu. The purpose of the challenge is to assess my skills and expertise in PHP and Laravel, and to evaluate my ability to build a web application that uses external data sources.

The challenge required me to build a web application that loads order data from a CSV file and component data from an engineering component API, and uses this information to generate amusing robot names based on the most prevalent category of components in each order. I was also needed to display the results in a table on a web page.

## Installation & Setup (Windows)

###1. Installing XAMPP
1. Download XAMPP:
   - Visit the official website of [XAMPP](https://www.apachefriends.org/download.html).
   - Download the installer suitable for your operating system (Windows, macOS, Linux).


2. Run the Installer:
    - Execute the downloaded installer file.
    - Follow the on-screen instructions provided by the installer.


3. Component Selection:
   - During installation, ensure you select the following components:
     - PHP
     - MySQL
     - PHPMyAdmin


4. Starting Services:
   1. Launch XAMPP Control Panel:
      - Once installation is complete, launch the XAMPP Control Panel.
   2. Start Apache:
      - In the XAMPP Control Panel, locate the Apache module. 
      - Click the "Start" button next to it. 
   3. Start MySQL:
      - In the same XAMPP Control Panel, locate the MySQL module. 
      - Click the "Start" button next to it.


5. Testing the Installation:
   - Open a web browser.
   - Enter http://localhost in the address bar and press Enter.
   - If everything is set up correctly, you should see the XAMPP dashboard.

###2. Installing Composer for Laravel
1. Download Composer:
    - Visit the  Composer [download page](https://getcomposer.org/download/).
    - Download the `Composer-Setup.exe` file.


2. Run the Installer:
    - Execute the downloaded `Composer-Setup.exe` file.
    - Follow the on-screen instructions provided by the installer.
    - Make sure to check the box that says "Add PHP to PATH"


3. Verification:
    - Open the Command Prompt.
    - Run `composer --version`.
    - If the installation was successful, you should see output displaying the version of Composer installed.

###3. Setting up the Database
1. Access PHPMyAdmin:
    - Open the XAMPP Control Panel.
    - Click the "Admin" button next to MySQL. This will open PHPMyAdmin in your default web browser.


2. Create a New Database:
    - In PHPMyAdmin, click the "Databases" tab at the top.


3. Name the Database:
    - Create a new database with the exact name "accu_bot".

###4. Setting up the Git Bash
1. Download Git Bash:
    - Visit the official [Git website](https://git-scm.com/downloads).
    - Download the Windows version installer.


2. Install Git Bash:
    - Run the installer.
    - Follow the on-screen instructions. Make sure to pay attention to any additional options or configurations offered during the installation.


3. Configure Git:
    - Open Git Bash after installation.
    - Set your username and email address by running the following commands (replace `Your Name` and `your@email.com` with your actual name and email):
      - `git config --global user.name "Your Name"`
      - `git config --global user.email your@email.com`

###5. Setting up the Project
1. Cloning
   1. Go to the GitHub.com [repository](https://github.com/DavidLokeNemeth/AccuBotFactory).
   2. Above the list of files, click the green Code button.
   3. Copy the URL for the repository.
      - To clone the repository using HTTPS, under "HTTPS", click the copy icon.
   4. Open Git Bash.
   5. Change the current working directory to the location where you want the cloned directory.
   6. Type git clone, and then paste the URL you copied earlier.
      - `git clone https://github.com/DavidLokeNemeth/AccuBotFactory.git`
   7. Press Enter to create your local clone.


2. Navigate to Project Directory:
    - Open the Command Prompt.
    - Use the `cd` command to navigate to the project directory.


3. Set Up Environment Variables:
    - Laravel uses an environment file (.env) to manage configuration variables. Copy the .env.example file and rename it to .env: `cp .env.example .env`.


4. Install Dependencies:
    - Run `composer install` to install project dependencies.


5. Generate Application Key:
    - Run the following command to generate an application key, which is used for encrypting sensitive data: `php artisan key:generate`


6. Migrate Database:
    - Run the following command to create the necessary database tables: `php artisan migrate`.


###6. Running PHPUnit Tests
Execute Tests:
 - Open your command prompt or terminal.
 - Use the `cd` command to navigate to the project directory.
 - Run the following command to execute the PHPUnit tests: `php artisan test`.
 - After a short time, you should see the output indicating the number of tests that passed and the total number of assertions.



###7. Application Usage
1. Navigate to Project Directory:
   - Open your command prompt or terminal.
   - Use the `cd` command to navigate to the project directory.


2. Import Orders:
    - To import components from the API server, run the following command: `php artisan order:components`
    - To import orders, run the following command: `php artisan order:import orders.csv`
    - These commands import data from the API and the CSV, and performs necessary calculations to generate robot names.


3. Start the Server:
    - Run the following command to start the server: `php artisan serve`.
    - You'll receive a message indicating the server is running at http://127.0.0.1:8000.


4. Access the Web Application:
    - Open a web browser and go to http://127.0.0.1:8000.
