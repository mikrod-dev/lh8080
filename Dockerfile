FROM php:8.2-apache
LABEL authors="mik"
WORKDIR /var/www/html

# Extensiones necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilitar mod_rewrite para URLs amigables y mod_headers para headers de seguridad
RUN a2enmod rewrite && a2enmod headers

# Configurar Apache
COPY config/apache/apache.conf /etc/apache2/sites-available/000-default.conf

# Copiar código fuente. Modifica el tamaño de la build.
#COPY . /var/www/html

# Crear directorio para uploads. Confirmar si conviene 755 o 644
RUN mkdir -p /var/www/html/public/uploads && \
    chown -R www-data:www-data /var/www/html/public/uploads && \
    chmod -R 755 /var/www/html/public/uploads

# Establecer permisos
RUN chown -R www-data:www-data /var/www/html/ && \
    find /var/www/html -type f -exec chmod 644 {} \; && \
    find /var/www/html -type d -exec chmod 755 /var/www/html \;

EXPOSE 80

