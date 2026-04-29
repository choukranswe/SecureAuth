# SecureAuth Pro

A Laravel-based web application for secure authentication and note management with OTP (One-Time Password) verification and advanced security features.

## Features

- **OTP Authentication**: Secure login with one-time passwords sent via email
- **Secure Notes**: Create, read, update, and delete encrypted notes with role-based access control
- **User Management**: Complete user authentication and authorization system
- **Authorization Policies**: Fine-grained control over resource access
- **Email Notifications**: Real-time OTP delivery and authentication alerts
- **Responsive UI**: Built with Tailwind CSS for modern, mobile-friendly interface

## Tech Stack

- **Framework**: Laravel 11
- **Frontend**: Blade templates, Tailwind CSS, Vite
- **Database**: SQLite (configurable)
- **Testing**: PHPUnit with Feature and Unit tests
- **Package Manager**: Composer (PHP) and NPM (JavaScript)

## Requirements

- PHP 8.2 or higher
- Composer
- Node.js & npm
- SQLite or MySQL database

## Installation

1. **Clone the repository**
```bash
git clone https://github.com/yourusername/secureauth-pro.git
cd secureauth-pro
```

2. **Install PHP dependencies**
```bash
composer install
```

3. **Install JavaScript dependencies**
```bash
npm install
```

4. **Setup environment**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configure database** (Edit `.env` and set database connection)
```bash
php artisan migrate
```

6. **Build frontend assets**
```bash
npm run build
```

## Running the Application

**Development Server**
```bash
php artisan serve
```

**Frontend Build Watch**
```bash
npm run dev
```

**Run Tests**
```bash
php artisan test
```

## Project Structure

```
secureauth-pro/
├── app/
│   ├── Http/
│   │   ├── Controllers/     # Application controllers
│   │   ├── Middleware/      # HTTP middleware
│   │   └── Requests/        # Form request validation
│   ├── Models/              # Eloquent models
│   ├── Services/            # Business logic (OTP service, etc.)
│   ├── Policies/            # Authorization policies
│   └── Notifications/       # Email notifications
├── database/
│   ├── migrations/          # Database migrations
│   ├── factories/           # Model factories for testing
│   └── seeders/             # Database seeders
├── resources/
│   ├── views/               # Blade templates
│   ├── css/                 # Stylesheets
│   └── js/                  # JavaScript files
├── routes/                  # Route definitions
├── tests/                   # Test suite
└── config/                  # Configuration files
```

## Key Models

- **User**: User account with authentication details
- **AuthOtp**: OTP records for authentication
- **SecureNote**: User's encrypted notes with access control

## API Endpoints

- `POST /login` - User login
- `POST /auth/otp/verify` - OTP verification
- `POST /auth/logout` - User logout
- `GET /secure-notes` - List user's notes
- `POST /secure-notes` - Create new note
- `PUT /secure-notes/{id}` - Update note
- `DELETE /secure-notes/{id}` - Delete note

## Security Features

- Password hashing with bcrypt
- CSRF protection on all forms
- OTP-based authentication
- Authorization policies for resource access
- Secure session management
- Email verification for critical actions

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is open-sourced software licensed under the [MIT license](LICENSE).


