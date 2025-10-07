# Construction & Property Management MIS

This is a **Management Information System (MIS)** designed for a construction and property dealing company. Built with **Laravel**, **Bootstrap**, **jQuery**, and **AJAX**, this system streamlines operations including project management, property listings, client management, and user authentication.  

Authentication is powered by the **[Spatie Laravel Permission](https://spatie.be/docs/laravel-permission/v5/introduction)** package for robust role and permission management.

> **Note:** The primary language of this project is **Persian (Farsi)**. An English language implementation is currently under development.

---

## Features

- User Authentication & Role Management (Spatie)
- Property Management
- Project Tracking
- Client & Vendor Management
- Dynamic Frontend with Bootstrap, jQuery, and AJAX
- Responsive design for desktop and mobile
- CRUD operations for core entities

---

## Technologies Used

- **Backend:** Laravel 
- **Frontend:** Bootstrap, jQuery 2.2.4, AJAX  
- **Authentication & Authorization:** Spatie Laravel Permission  
- **Database:** MySQL   

---

## Prerequisites

Before you begin, ensure you have the following installed:

- PHP >= 8.1  
- Composer  
- MySQL or MariaDB  
- Node.js & npm (for compiling assets)  
- Git  

---

## Installation & Deployment

Follow these steps to deploy the project:

### 1. Clone the Repository

```bash
git clone https://github.com/wmohseni7/ConstructionRealStateAgency
```
2. Install PHP Dependencies
```bash
composer install
```
3. Install Node.js Dependencies & Compile Assets
```bash
npm install
npm run dev
```
For production, use: 
```bash
npm run build
```

4. Setup Environment File
```bash
cp .env.example .env
```
Edit .env with your database and environment settings:
```bash
env
Copy code
APP_NAME="Construction MIS"
APP_URL=http://localhost
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```
5. Generate Application Key
```bash
php artisan key:generate
```
6. Run Migrations & Seeders
```bash
php artisan migrate --seed
```
This will create all the necessary tables and seed roles & admin user if configured in seeders.

7. Storage Link
Create a symbolic link to access uploaded files:

```bash
php artisan storage:link
```
8. Serve the Application
For local development:

```bash
php artisan serve
```
Visit http://localhost:8000 in your browser.

User Roles & Permissions
Admin: Full access to all modules.

Manager: Limited access to projects and properties.

Employee: Can view and manage assigned tasks.

Roles and permissions are managed via Spatie’s package. You can modify or extend roles in database/seeders/RoleSeeder.php.

Language
Primary Language: Persian (Farsi)

English Version: Under development

Contributing
Fork the repository

Create a feature branch (git checkout -b feature/YourFeature)

Commit your changes (git commit -m 'Add YourFeature')

Push to the branch (git push origin feature/YourFeature)

Open a Pull Request

License
MIT License © Wali Mohseni
