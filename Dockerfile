# Use your custom Docker Hub image as the base
FROM php:8.3.3RC1-apache-bullseye

# Install curl, Node.js, and npm
RUN apt-get update && apt-get install -y \
    curl \
    && curl -sL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*  # Clean up

# Copy the snippets directory to the container
COPY . /var/www/snippets
COPY vite.config.example /var/www/snippets/vite.config.js
COPY laravel.conf /etc/apache2/sites-available

RUN a2dissite 000-default.conf \
    && a2enmod rewrite \
    && a2ensite laravel.conf \
    && service apache2 restart \
    && chmod -R 777 /var/www/snippets/storage

# Additional configurations or commands can be added here
