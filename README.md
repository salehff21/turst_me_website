Trust_Me

Simple legal consultation platform. Users and lawyers register, post questions, exchange replies, upload files, and submit evaluations.

At a glance

Language: PHP

DB: MySQL

UI: PHP pages with CSS

Uploads: uploads/, uploads_files_con/

Schema: Sql/New_database/website_db.sql

Root folder in archive: Turst_Me/ (note the spelling)

Requirements

PHP 8.x with mysqli, mbstring, json, fileinfo, openssl, curl

MySQL 8.x or MariaDB 10.x

Apache or Nginx + PHP-FPM

UTF-8 (utf8mb4) locale

Quick start

Copy the project to your web root

/var/www/Trust_Me   # example


Create the database and import schema

CREATE DATABASE trust_me DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE trust_me;
SOURCE Sql/New_database/website_db.sql;


Configure DB connection in connection.php

$host = '127.0.0.1';
$user = 'trust_user';
$pass = 'strong_password';
$db   = 'trust_me';


Set upload directory permissions

chmod -R 755 uploads uploads_files_con
# if the web server needs write access:
chmod -R 775 uploads uploads_files_con


Run locally with the built-in server (optional)

php -S 0.0.0.0:8080 -t .
# visit: http://localhost:8080/Turst_Me/index.php

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
└─ Sql/
   └─ New_database/
      └─ website_db.sql

Core pages and functions
Area	Files	Purpose
Auth (clients)	login_clients.php, signup_Clients.php, logout.php	Sign in, sign up, logout
Auth (lawyers)	login_lawyer.php, signup_laywer.php, laywer.php	Lawyer access and profile
Questions	Qustions.php, send_qustion.php	List and submit questions
Consultations	consultations.php, consultations_client.php	Manage consultations
Replies	replay.php, View_replay.php, accept.php	Post and view replies, accept actions
Public pages	index.php, Home.php, about_us.php, contact_us.php	Landing and info
Shared	inc/header.php, inc/Session.php, connection.php	Header, sessions, DB connect
Database

Load Sql/New_database/website_db.sql.

Use utf8mb4 for Arabic content.

Keep credentials outside VCS when possible.

Environment variables (optional refactor)

You can externalize config via an include file not tracked by Git:

// config.local.php (ignored)
return [
  'db_host' => '127.0.0.1',
  'db_user' => 'trust_user',
  'db_pass' => 'strong_password',
  'db_name' => 'trust_me',
];


Then require it in connection.php.

Security notes

Use prepared statements for all SQL queries.

Validate and sanitize all inputs.

Restrict upload MIME types and size. Store outside web root if possible and serve via read-only proxy.

Regenerate session IDs on login. Set session.cookie_httponly=1 and session.cookie_secure=1 under HTTPS.

Disable error display in production and log to files only.

Testing

Smoke tests for login, submit question, reply flow.

DB connectivity test script.

Add CSRF tokens to forms and verify.

Deployment

Apache: set DocumentRoot to the project or to a public/ folder if you later split front controller.

Nginx: route .php to PHP-FPM. Deny direct access to upload directories if you introduce private paths.

Configure log rotation. Backup DB daily.

Roadmap

Migrate to simple MVC and routing layer.

Centralize input validation and CSRF middleware.

Unify styles and components. Add responsive layout.

Add audit logging for sensitive actions.

License

Choose and include a license file, for example MIT.
