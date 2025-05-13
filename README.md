# 🎬 Movie Ticket Web Application

A simple web-based movie ticket booking system built using **PHP** and **MySQL**, designed for local development and demonstration purposes.

---

## 🚀 Getting Started

This guide will help you set up and run the project locally using **XAMPP**.

### 📋 Prerequisites

- [XAMPP](https://www.apachefriends.org/index.html) installed and running on your machine
- Basic knowledge of PHP and MySQL

---

## 🛠️ Project Setup

### Step 1: Organize the Project Files

1. Navigate to the `htdocs` directory in your XAMPP installation: C:\xampp\htdocs

2. Create a new folder for the project (e.g., `myProject`): C:\xampp\htdocs\myProject

3. Copy **all `.php` files** into the `myProject` folder **except** `db.php`.

4. Inside `myProject`, create a subfolder named `includes`: C:\xampp\htdocs\myProject\includes

5. Place the `db.php` file inside the `includes` folder: C:\xampp\htdocs\myProject\includes\db.php


> 🔒 `db.php` handles the database connection and should be kept in a separate folder for better structure and security.

---

### Step 2: Set Up the Database

1. Open [phpMyAdmin](http://localhost/phpmyadmin) from your browser.

2. Follow the instructions in the provided `Creating a database.pdf` file to:

- Create the database
- Set up tables
- Populate initial data

> 📝 Make sure the database name and credentials in `db.php` match your actual MySQL setup.

---

### Step 3: Launch the Application

1. Start **Apache** and **MySQL** from the XAMPP Control Panel.

2. Open your browser and go to: http://localhost/myProject/register.php



> This will load the registration page and initialize the application.

---

## ✅ You're All Set!

If everything is configured properly, you should be able to register and explore the movie ticket booking system locally.

---

## 📁 Project Structure

myProject/

├── includes/

│ └── db.php

├── index.php

├── register.php

├── login.php

├── ...other .php files

└── Creating a database.pdf 


---

## 🐞 Troubleshooting

- Make sure MySQL is running and your database credentials are correct.
- Check file paths, especially for the `includes/db.php` reference in other PHP files.
- Review `Creating a database.pdf` for any missed steps.

---

## 📜 License

This project is for educational/demo purposes only.

---






