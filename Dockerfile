FROM php:8.2-fpm

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    vim \
    libzip-dev \
    gnupg \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl

# Installer Node.js 18 (compatible avec Laravel)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www

# Copier le code source
COPY . .

# Autoriser git à accéder à ce dossier (évite l'erreur "dubious ownership")
RUN git config --global --add safe.directory /var/www

# Donner les bons droits à Laravel
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Variables d’environnement Composer pour éviter les interactions bloquantes
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_DISCARD_CHANGES=true
ENV COMPOSER_NO_INTERACTION=1
ENV COMPOSER_PROCESS_TIMEOUT=0

# Installer les dépendances PHP (sans exécuter les scripts Laravel)
RUN composer install --no-scripts --prefer-dist --optimize-autoloader

# Installer les dépendances Node.js (Tailwind, etc.)
RUN npm install


# Exposer le port Laravel
EXPOSE 8000
