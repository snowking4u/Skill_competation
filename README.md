# Student Technical Workshop Registration System

A simple PHP + MySQL web application for managing student registrations in technical
workshops at **Govt. Polytechnic HMR**.

Students can browse the workshop catalogue and register themselves. Admins log in to
create new workshops and review the list of registered students.

## Tech Stack

| Layer    | Technology                |
| -------- | ------------------------- |
| Frontend | HTML5, CSS3 (`style.css`) |
| Backend  | PHP (procedural, `mysqli`) |
| Database | MySQL / MariaDB           |
| Auth     | PHP sessions              |

No frameworks, build steps, or package manager dependencies.

## Features

**Public**

- Workshop catalogue with name, date, time, venue, max seats, and description
- Student registration form (name, roll number, branch, semester, email, mobile, gender, workshop)
- Duplicate roll-number prevention per registration

**Admin (session protected)**

- Admin login via email + password
- Create new workshops
- View all registered students with their chosen workshop
- Logout

## Project Structure

```
.
├── index.php         # Public workshop catalogue (landing page)
├── registration.php  # Student registration form + INSERT logic
├── login.php         # Admin login, starts session
├── logout.php        # Destroys session, redirects to login
├── admin.php         # Admin dashboard: registered students table
├── workshop.php      # Admin form to create a workshop
├── style.css         # All styling
└── README.md
```

## Database Setup

The app expects a database named `temp` on `localhost` with the tables below.
(Schema is inferred from the queries in the source; no `.sql` dump is committed yet.)

```sql
CREATE DATABASE temp;

USE temp;

CREATE TABLE users (
    sno   INT AUTO_INCREMENT PRIMARY KEY,
    name  VARCHAR(100),
    email VARCHAR(150) UNIQUE,
    pass  VARCHAR(255)
);

CREATE TABLE registration (
    workshop_id   INT AUTO_INCREMENT PRIMARY KEY,
    workshop_name VARCHAR(150),
    workshop_date DATE,
    workshop_time TIME,
    venue         VARCHAR(150),
    max_seats     INT,
    description   TEXT
);

CREATE TABLE students (
    sno         INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(100),
    rno         VARCHAR(20) UNIQUE,
    branch      VARCHAR(100),
    semester    VARCHAR(20),
    email       VARCHAR(150),
    mobile      VARCHAR(20),
    gender      VARCHAR(10),
    workshop    VARCHAR(150),
    description VARCHAR(255),
    reg_date    DATE
);
```

Seed an admin account:

```sql
INSERT INTO users (name, email, pass) VALUES ('Admin', 'admin@example.com', 'your_password');
```

## Running Locally

Requires PHP 7+ with `mysqli` enabled and a MySQL/MariaDB server.

1. Clone the repository:

   ```bash
   git clone https://github.com/snowking4u/Skill_competation.git
   cd Skill_competation
   ```

2. Create the database and tables using the SQL above.

3. Update the credentials in each PHP file. They are currently hardcoded as
   `localhost` / `root` / empty password / `temp` (`index.php:30-33`,
   `registration.php:7-10`, `login.php:6`, `admin.php:44`, `workshop.php:4`).

4. Start a local server and open the site:

   ```bash
   php -S localhost:8000
   ```

   Then visit <http://localhost:8000/index.php>.

## Usage

1. Open `index.php` and click **Admin** to log in.
2. From the dashboard, use **Register Workshop** to add a workshop.
3. Students open `registration.php`, pick a workshop from the dropdown, and submit.
4. Registrations appear in the admin dashboard table.

## Known Issues

This is an early-stage project. Known problems worth fixing:

- **SQL injection** — all queries interpolate `$_POST` values directly into SQL strings.
  Use prepared statements (`mysqli_prepare`) everywhere.
- **Plaintext passwords** — `users.pass` is compared as-is; store `password_hash()` /
  `password_verify()` hashes instead.
- **No input validation or escaping** — no server-side validation, and no
  `htmlspecialchars()` on output, so stored data is rendered as raw HTML (XSS).
- **Hardcoded credentials** duplicated across five files; move to a single config file
  or environment variables.
- **No session hardening** — `session_regenerate_id()` is not called after login, and
  `admin.php` performs output before the redirect guard.
- **No seat-limit enforcement** — `max_seats` is stored but never checked against the
  number of registrations.
- **Markup issues** — `index.php` declares 7 table headers but outputs 8 cells (the
  "Register Yourself" link has no `<th>`), that `<td><a>` is never closed, and
  `<mian>`/`<lable>` are typos for `<main>`/`<label>`.
- **Missing gender validation** — the radio group is not `required`.
- **No `registration.sql` export** — the schema has to be recreated by hand.

## Roadmap

- [ ] Replace raw SQL with prepared statements
- [ ] Hash admin passwords
- [ ] Centralize DB config
- [ ] Add a schema/seed SQL file
- [ ] Enforce seat capacity per workshop
- [ ] Add admin edit/delete for workshops and registrations
- [ ] Validate and escape all form input and output
- [ ] Fix invalid HTML tags and table column mismatch

## License

No license specified. Add one (e.g. MIT) before distributing.