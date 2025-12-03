FROM php:8.2-fpm-alpine

# Install system dependencies (including Node.js for code highlighting via Shiki)
RUN apk add --no-cache \
    curl \
    libpq-dev \
    zip \
    unzip \
    git \
    bash \
    nodejs \
    npm

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy project files
COPY . .

# Install JS dependency used for code highlighting (Shiki)
RUN npm install shiki@^1.22.1 --production

# Create storage directories
RUN mkdir -p storage/logs storage/framework/sessions storage/framework/views storage/framework/cache

# Set permissions
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
