# 👥 Employees REST API (PHP & MySQL)

A simple RESTful API built with **native PHP** (no frameworks) and **MySQL** for managing employees and their departments. It supports full CRUD operations and includes a script that seeds the database with sample users from an external API.

---

## 🛠️ Tech Stack

- **PHP 8** (native, object-oriented)
- **MySQL / MariaDB** (via `mysqli`)
- **cURL** – consuming an external API ([DummyJSON](https://dummyjson.com))
- **XAMPP / phpMyAdmin** – local development environment

---

## 📁 Project Structure

```
api_php/
├── api.php            # Main API router (handles HTTP methods and endpoints)
├── employee.php       # Employee class (database operations)
├── conn.php           # Database connection settings
├── curl_helper.php    # cURL helper function for external requests
├── index.php          # Seeder: fetches users from DummyJSON and stores them
└── api_php_db.sql     # Database schema and sample data
```

---

## 🗄️ Database Schema

**Database name:** `api_php_db`

### `departments`
| Column | Type | Notes |
|--------|------|-------|
| id | INT | Primary key, auto increment |
| dep_name | VARCHAR(50) | Department name |

Sample data: `IT`, `Customer Service`, `HR`

### `employees`
| Column | Type | Notes |
|--------|------|-------|
| id | INT | Primary key, auto increment |
| name | VARCHAR(50) | |
| email | VARCHAR(100) | |
| phone | VARCHAR(20) | |
| salary | FLOAT | |
| dep_id | INT | Foreign key → `departments.id` (ON DELETE/UPDATE CASCADE) |
| created_at | TIMESTAMP | Set automatically |
| updated_at | TIMESTAMP | Updated automatically |

---

## ⚙️ Installation

1. Clone the repository into your server root (e.g. `htdocs` in XAMPP):
   ```bash
   git clone https://github.com/fady023/api_php.git
   ```
2. Start **Apache** and **MySQL** from XAMPP.
3. Open phpMyAdmin and **import** `api_php_db.sql` (it contains the `api_php_db` database).
4. Check the credentials in `conn.php` and change them if needed:
   ```php
   $host = "localhost";
   $user = "root";
   $pass = "";
   $db   = "api_php_db";
   ```
5. (Optional) Visit `http://localhost/api_php/index.php` to fetch and insert sample users from DummyJSON.

---

## 🔌 API Endpoints

**Base URL:** `http://localhost/api_php/api.php`

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api.php/emp` | Get all employees with their department data |
| GET | `/api.php/emp/{id}` | Get a single employee by ID |
| POST | `/api.php/emp` | Create a new employee |
| PUT | `/api.php/emp/{id}` | Update an employee |
| DELETE | `/api.php/emp/{id}` | Delete an employee |

### Examples

**Create an employee** (`POST /api.php/emp`)
```json
{
  "emp_name": "Ahmed",
  "emp_email": "ahmed@example.com",
  "emp_phone": "+20 100-000-0000",
  "emp_salary": 5000
}
```
> New employees are assigned to department `1` (IT) by default, and duplicate names are rejected.

**Update an employee** (`PUT /api.php/emp/1`)
```json
{
  "name": "Ahmed Ali",
  "email": "ahmed.ali@example.com",
  "phone": "+20 100-000-0000",
  "salary": 6000
}
```

**cURL example**
```bash
curl -X GET http://localhost/api_php/api.php/emp
curl -X DELETE http://localhost/api_php/api.php/emp/3
```

---

## 🌱 Data Seeding

`index.php` calls `https://dummyjson.com/users`, takes the first 5 users, and stores each one as an employee (first name, email, phone, and age mapped to salary) using the `employee` class.

---

## 🚧 Possible Improvements

- Use prepared statements to prevent SQL injection
- Add input validation and proper HTTP status codes
- Add authentication (JWT / API key)
- Support choosing a department when creating or updating an employee
- Move database credentials to an `.env` file

---

## 👤 Author

**Fady** – [GitHub](https://github.com/fady023)
