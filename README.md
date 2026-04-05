 # ⚖️ Trust_Me

**Trust_Me** is a simple Arabic (RTL) legal consultation platform where **clients** and **lawyers** can register, exchange consultations, upload files, and submit evaluations.

> ⚠️ *Note: Screenshots and sample data are for demonstration purposes only.*

---

## ✨ Features

### 👥 Accounts & Roles

* Client registration & login
* Lawyer registration & login
* Role-based dashboards (Client / Lawyer)

### 📩 Consultations Workflow

* Clients submit consultations (with optional attachments)
* Lawyers review and **Accept / Reject**
* Lawyers respond to accepted consultations
* Clients track status and view replies

### 📎 File Uploads

* Consultation attachments (clients)
* Lawyer CV upload

### ⭐ Evaluation

* Clients can rate and provide feedback

### ❓ FAQ

* Dedicated FAQ page for guidance

---

## 📸 Screenshots

### 🔐 Login

| Client                                        | Lawyer                                       |
| --------------------------------------------- | -------------------------------------------- |
| ![Client Login](Screenshot/login_clients.png) | ![Lawyer Login](Screenshot/login_lawyer.png) |

### 📝 Signup

| Client                                          | Lawyer                                         |
| ----------------------------------------------- | ---------------------------------------------- |
| ![Client Signup](Screenshot/signup_Clients.png) | ![Lawyer Signup](Screenshot/signup_laywer.png) |

### 📋 Dashboards

| Client                                         | Lawyer                                            |
| ---------------------------------------------- | ------------------------------------------------- |
| ![Client](Screenshot/consultations_client.png) | ![Lawyer](Screenshot/consultations%20Laweyer.png) |

### ✅ Consultation Flow

* Accept / Reject
  ![Accept](Screenshot/accept_consultation.png)

* Reply (Lawyer)
  ![Reply](Screenshot/replay_laweyer_cosultations.png)

* View Reply (Client)
  ![View](Screenshot/view_replay.png)

### 👤 Profile

![Profile](Screenshot/update_info_lawyer%20page.png)

### ❓ FAQ

![FAQ](Screenshot/Qustions.png)

### 🏠 Home

![Home](Screenshot/Screenshot%202026-01-14%20135903.png)

---

## 🧰 Tech Stack

* **Backend:** PHP
* **Database:** MySQL
* **Frontend:** HTML, CSS (RTL Support)
* **File Handling:** uploads system

---

## ✅ Requirements

* PHP 8.x
* MySQL 8.x / MariaDB
* Apache or Nginx
* UTF-8 (`utf8mb4`)

---

## 🚀 Quick Start

### 1️⃣ Create Database

```sql
CREATE DATABASE trust_me 
DEFAULT CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE trust_me;
SOURCE Sql/New_database/website_db.sql;
```

### 2️⃣ Configure Connection

```php
$host = '127.0.0.1';
$user = 'trust_user';
$pass = 'strong_password';
$db   = 'trust_me';
```

### 3️⃣ Set Permissions

```bash
chmod -R 755 uploads uploads_files_con
chmod -R 775 uploads uploads_files_con
```

### 4️⃣ Run Project

```bash
php -S 0.0.0.0:8080 -t .
```

📍 Open in browser:

```
http://localhost:8080/Turst_Me/index.php
```

---

## 📁 Project Structure

```
Turst_Me/
├── index.php
├── Home.php
├── consultations.php
├── login_clients.php
├── login_lawyer.php
├── signup_Clients.php
├── signup_laywer.php
├── connection.php
├── css/
├── uploads/
├── Screenshot/
└── Sql/
```

---

## 🔒 Security Notes

* Use prepared statements
* Validate & sanitize inputs
* Restrict file uploads
* Regenerate session IDs
* Use HTTPS in production

---

## 🌐 Deployment

* Apache / Nginx + PHP-FPM
* Secure uploads directory
* Regular DB backups

---

## 🗺️ Roadmap

* Convert to MVC architecture
* Add CSRF protection
* Improve UI/UX
* Add logging system

---

## 👤 Developer

**Saleh Al-Shaebi**
*Information Technology Graduate | Freelance Developer*

* 🔗 LinkedIn: [Saleh Al-Shaebi](https://www.linkedin.com/in/saleh-al-shaebi-1903263aa)

---
