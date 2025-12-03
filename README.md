## Orange Mentor

Orange Mentor is a developers' community discussion platform for Q&A, mentoring, and knowledge sharing. It provides topics, discussions, posts, user mentions, and accepted solutions—built with Laravel on the backend and Vue 3 (via Vite) on the frontend.
it supports markdown format

## Table of Contents

-   [Features](#features)
-   [Installation](#installation)
-   [Usage](#usage)

## Features

-   **Authentication**: Registration, login, and session management.
-   **Topics & Discussions**: Create topics, start discussions, and browse the forum.
-   **Posts & Replies**: Add, edit, and delete posts within discussions.
-   **Accepted Solutions**: Mark a post as the solution for a discussion.
-   **Mentions**: Mention users with `@username` and notify them.
-   **Profiles**: View and edit user profiles.
-   **Moderation**: Policies protect actions on discussions and posts.
-   **Modern UI**: Vue 3 components, Tailwind CSS, Vite, and SPA-like UX.

## Installation

Prerequisites:

-   PHP 8.2+
-   Composer
-   Node.js 18+ and npm
-   A database (e.g., MySQL/PostgreSQL/SQLite) configured in `.env`

Steps:

1. Clone the repository

```bash
git clone <your-fork-or-origin-url>
cd Oragne-Mentor
```

2. Install PHP dependencies

```bash
composer install
```

3. Install JavaScript dependencies

```bash
npm install
```

4. Configure environment

```bash
cp .env.example .env
php artisan key:generate
```

5. Configure your database settings in `.env`, then run migrations (and optionally seed)

```bash
php artisan migrate
# Optional: php artisan db:seed
```

6. Create storage symlink for public assets

```bash
php artisan storage:link
```

7. Build or run frontend assets

```bash
# During development
npm run dev

# For production
npm run build
```

8. Start the application server

```bash
php artisan serve
```

## Usage

Once the server is running, open the app in your browser (e.g., `http://127.0.0.1:8000`).

Typical workflow:

1. Register a new account or log in.
2. Create a topic and start a discussion.
3. Post replies; mention other users with `@username`.
4. Mark the most helpful reply as the accepted solution.
5. Manage your profile and continue the conversation.
