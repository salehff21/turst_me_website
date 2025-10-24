 # Trust_Me

Simple legal consultation platform: users and lawyers register, post questions, exchange replies, upload files, and submit evaluations.

## At a glance
- Language: PHP
- DB: MySQL
- UI: PHP + CSS
- Uploads: `uploads/`, `uploads_files_con/`
- Schema: `Sql/New_database/website_db.sql`
- Root folder in archive: `Turst_Me` (note the spelling)

## Requirements
- PHP 8.x with `mysqli`, `mbstring`, `json`, `fileinfo`, `openssl`, `curl`
- MySQL 8.x or MariaDB 10.x
- Apache or Nginx + PHP-FPM
- UTF-8 (`utf8mb4`)

## Quick start

### 1) Create database and import schema
```sql
CREATE DATABASE trust_me DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE trust_me;
SOURCE Sql/New_database/website_db.sql;

2) Configure DB connection in connection.php
$host = '127.0.0.1';
$user = 'trust_user';
$pass = 'strong_password';
$db   = 'trust_me';

3) Set upload directory permissions
chmod -R 755 uploads uploads_files_con
# if the web server needs write access:
chmod -R 775 uploads uploads_files_con

4) Run locally with the built-in server (optional)
php -S 0.0.0.0:8080 -t .


Visit: http://localhost:8080/Turst_Me/index.php

Project structure
Turst_Me/
├─ index.php
├─ Home.php
├─ about_us.php
├─ contact_us.php
├─ Qustions.php
├─ send_qustion.php
├─ consultations.php
├─ consultations_client.php
├─ replay.php
├─ View_replay.php
├─ evaluation.php
├─ login_clients.php
├─ login_lawyer.php
├─ signup_Clients.php
├─ signup_laywer.php
├─ laywer.php
├─ accept.php
├─ logout.php
├─ connection.php
├─ inc/
│  ├─ header.php
│  └─ Session.php
├─ css/
│  ├─ style.css
│  ├─ laywer_style.css
│  ├─ Styles_Qustions.css
│  ├─ Style_conslation.css
│  ├─ style_evaluation.css
│  ├─ style_update_info_lawyer.css
│  └─ about_us_styles.css
├─ image/
├─ uploads/
├─ uploads_files_con/
└─ Sql/New_database/website_db.sql

Core pages and functions

Auth (clients): login_clients.php, signup_Clients.php, logout.php

Auth (lawyers): login_lawyer.php, signup_laywer.php, laywer.php

Questions: Qustions.php, send_qustion.php

Consultations: consultations.php, consultations_client.php

Replies: replay.php, View_replay.php, accept.php

Public: index.php, Home.php, about_us.php, contact_us.php

Shared: inc/header.php, inc/Session.php, connection.php

Security

Prepared statements for all SQL.

Validate and sanitize inputs.

Restrict upload MIME types and size.

Regenerate session IDs on login; enable httponly and secure cookies.

Disable error display in production.

Deployment

Apache or Nginx + PHP-FPM.

Deny direct access to private upload paths if introduced.

DB backups and log rotation.

Roadmap

Move to simple MVC routing.

Centralize validation and CSRF tokens.

Responsive UI and unified CSS.

Audit log for sensitive actions.

