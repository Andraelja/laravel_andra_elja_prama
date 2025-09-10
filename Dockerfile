FROM php:8.2-apache

# --- 1. Install system dependencies ---
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    libicu-dev \
    && rm -rf /var/lib/apt/lists/*

# --- 2. Configure & install PHP extensions ---
RUN docker-php-ext-configure intl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo \
        pdo_pgsql \
        pgsql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        intl



# --- 3. Install Node.js 20 (untuk Vite) ---
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# --- 4. Enable mod_rewrite Apache ---
RUN a2enmod rewrite

# --- 5. Set Apache Document Root ke folder Laravel public ---
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# --- 6. Ambil Composer dari image resmi ---
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# --- 7. Set working directory ---
WORKDIR /var/www/html

# --- 8. Salin semua file project ke dalam container ---
COPY . .

# --- 9. Install dependensi Laravel ---
RUN composer install --no-dev --optimize-autoloader --no-interaction

# --- 10. Install dependensi Node.js dan build Vite ---
COPY package*.json ./
RUN npm install --legacy-peer-deps
COPY . .
RUN npm run build && ls -la public/build
RUN if [ -f public/build/.vite/manifest.json ]; then \
        cp public/build/.vite/manifest.json public/build/manifest.json; \
    fi

# --- 11. Set permission folder penting ---
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Jalankan artisan storage:link
RUN php artisan storage:link

# --- 12. Setup Laravel .env & key ---
RUN if [ ! -f ".env" ]; then cp .env.example .env; fi
RUN php artisan key:generate --no-interaction || echo "Key generation failed, continuing..."
RUN php artisan config:clear || echo "Config clear failed, continuing..."
RUN php artisan route:clear || echo "Config clear failed, continuing..."
RUN php artisan cache:clear || echo "Config clear failed, continuing..."
RUN php artisan view:clear || echo "Config clear failed, continuing..."

# --- 13. Buka port 80 ---
EXPOSE 80

# --- 14. Perintah saat container dijalankan ---
CMD apache2-foreground
# CMD php artisan migrate:fresh --seed --force && apache2-foreground