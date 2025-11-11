# Final Setup Steps

This document outlines the final steps required to get the User Management feature fully operational. These commands require `php` and `composer` to be installed and available in your environment.

### 1. Run Database Migrations

This will create the `users` table in your database.

```bash
php spark migrate
```

### 2. Seed the Database

This will create the default admin user so you can log in for the first time.

```bash
php spark db:seed UserSeeder
```

**Default Credentials:**
- **Username:** `admin`
- **Password:** `password`

### 3. Start the Development Server

This command will start the local development server, typically at `http://localhost:8080`.

```bash
php spark serve
```

Once the server is running, you can navigate to the `/login` page to access the application.
