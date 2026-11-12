# Numismático — Full-Stack Collection Manager

A full-stack web application prototype for organizing numismatic items, managing personal collections, and browsing banknotes listed in a marketplace.

The project combines a **Vue 3 / Quasar** single-page application with a **Laravel 10** backend and a **MySQL** relational database. It was developed as an academic project and is published as a technical portfolio reference.

## Features

- User registration and authentication
- Banknote catalog with metadata such as country, year, condition, and price
- Personal portfolio and collection management
- Marketplace listing for items marked as available for sale
- REST-style API endpoints and database migrations
- Basic Laravel tests and a separate frontend application

> **Project status:** Academic prototype. The source code has been organized and its most critical publicly exposed authentication flow corrected for publication, but a complete frontend–backend integration test and production security review have not been performed. It should not be deployed to the public Internet without further hardening.

## Technology stack

| Layer | Technologies |
| --- | --- |
| Frontend | Vue 3, Quasar Framework 2, JavaScript, Axios, Pinia |
| Backend | PHP 8.1+, Laravel 10, Laravel Sanctum |
| Database | MySQL |
| Tooling | Composer, Yarn, PHPUnit, Laravel migrations |

## Project structure

```text
Numismatico-Full-Stack/
├── frontend/
│   ├── src/
│   ├── public/
│   ├── quasar.config.js
│   ├── package.json
│   └── .env.example
├── backend/
│   ├── app/
│   ├── database/
│   ├── routes/
│   ├── tests/
│   ├── resources/           # Archived Laravel/Inertia interface
│   ├── composer.json
│   └── .env.example
├── docs/
│   └── SECURITY_AND_LIMITATIONS.md
└── README.md
```

The original archive contained two overlapping frontend source trees. This repository uses the more complete Quasar application as `frontend/`. Older Laravel/Inertia views are retained under `backend/resources/` as project history; the **supported UI for development is the Quasar SPA**.

## Requirements

- PHP 8.1 or later and Composer
- MySQL server
- Node.js 18 and Yarn Classic (1.x) for the archived Quasar dependencies

Because this project targets historical framework versions, a newer runtime may require dependency upgrades.

## Local development

### 1. Backend

From `backend/`:

```bash
composer install
cp .env.example .env
php artisan key:generate
```

On Windows PowerShell, use `Copy-Item .env.example .env` instead of `cp` if needed.

Create an empty MySQL database named `numismatico`. Configure `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` in `backend/.env`, then run:

```bash
php artisan migrate
php artisan serve
```

The Laravel API will be available at `http://127.0.0.1:8000/api`.

### 2. Frontend

From `frontend/`:

```bash
yarn install
yarn dev
```

The frontend defaults to `http://127.0.0.1:8000/api`. To change it, set the `API_BASE_URL` environment variable **before starting** Quasar; see `frontend/.env.example`. For example, on PowerShell:

```powershell
$env:API_BASE_URL = "http://127.0.0.1:8000/api"
yarn dev
```

For a local-only demonstration, use a test account and non-sensitive sample data. The frontend requires the backend to be running.

### 3. Tests

Laravel test sources are provided under `backend/tests/`:

```bash
cd backend
php artisan test
```

Tests were included in the recovered project; they have **not** been verified against a running MySQL installation in this recovered environment. Some older tests target pre-refactor API behavior and may need updates to supply authentication tokens.

## Architecture

```text
Vue / Quasar SPA
       |
       | HTTP / JSON via Axios
       v
Laravel API + Sanctum
       |
       v
MySQL (users, money, collections, marketplace)
```

Quasar stores an authentication token for local development and attaches it to private API requests. Laravel Sanctum protects personal portfolio and collection endpoints. Public marketplace listings are available without a token.

The original Laravel/Inertia interface is retained for reference but is not covered by this setup guide.

## Security and project limitations

See [Security and limitations](docs/SECURITY_AND_LIMITATIONS.md) for the project's remaining constraints, including authentication, uploads, dependency maintenance, and testing status.

Only example environment variables are included. Real application secrets, original Git history, sample spreadsheets, and nonessential reference photographs are excluded from this published copy.

## License

No license is granted by default. All rights are reserved unless the repository owners choose a license explicitly.

## Authors

Developed by Davi Darroit Dutra and Bernardo Sachet Braga as a collaborative academic project.
