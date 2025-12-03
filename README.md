# Orange Mentor

Orange Mentor is a Orange Coding Academy students' community discussion platform for Q&A, mentoring, and knowledge sharing. It supports markdown format for posts and discussions.

## Technologies Used

### Backend

-   **Laravel 10** - PHP framework
-   **PostgreSQL** - Database
-   **Meilisearch** - Full-text search engine
-   **Redis** - Caching and session storage
-   **Laravel Sanctum** - API authentication
-   **Laravel Scout** - Search functionality
-   **Spatie Laravel Markdown** - Markdown rendering
-   **Spatie Laravel Query Builder** - API query filtering

### Frontend

-   **Vue 3** - JavaScript framework
-   **Inertia.js** - SPA-like experience without API complexity
-   **Tailwind CSS** - Utility-first CSS framework
-   **Vite** - Build tool and dev server
-   **Shiki** - Syntax highlighting for code blocks
-   **Vue Mention** - User mention functionality

## How to Run the Project

### Using Docker (Recommended)

1. Clone the repository:

```bash
git clone <repository-url>
cd Oragne-Mentor
```

2. Start the application with Docker Compose:

```bash
docker-compose up -d
```

3. Access the application:
    - Frontend: http://localhost:8000
    - Meilisearch Dashboard: http://localhost:7700

The Docker setup will automatically:

-   Install PHP and JavaScript dependencies
-   Run database migrations
-   Seed the database with demo data
-   Start all required services (PostgreSQL, Meilisearch, Redis)

### Manual Setup

**Prerequisites:**

-   PHP 8.1+
-   Composer
-   Node.js 18+ and npm
-   PostgreSQL database
-   Meilisearch instance
-   Redis (optional)

**Steps:**

1. Clone the repository:

```bash
git clone <repository-url>
cd Oragne-Mentor
```

2. Install PHP dependencies:

```bash
composer install
```

3. Install JavaScript dependencies:

```bash
npm install
```

4. Configure environment:

```bash
cp .env.example .env
php artisan key:generate
```

5. Configure your database and Meilisearch settings in `.env`, then run migrations:

```bash
php artisan db:create # a custom command for creating the database
php artisan migrate
php artisan db:seed
```

6. Create storage symlink:

```bash
php artisan storage:link
```

7. Build frontend assets:

```bash
npm run dev
```

8. Start the application server:

```bash
php artisan serve
```

## Demo Accounts

After seeding the database, you can log in with these accounts:

**Admin Account:**

-   Email: `ahmed.masri@example.com`
-   Password: `password`

**User Account:**

-   Email: `omar.khatib@example.com`
-   Password: `password`
