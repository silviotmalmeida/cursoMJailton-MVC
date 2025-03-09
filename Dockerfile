# Usando a imagem base do PHP com Apache
FROM php:8.1-apache

# Instalando extensões
RUN apt-get update \
    && docker-php-ext-install pdo pdo_mysql mysqli

# copiando o composer para a pasta bin para podermos executá-lo
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiando o arquivo de configuração do Apache
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Ativando mod_rewrite do Apache
RUN a2enmod rewrite

# Reiniciando o Apache
RUN service apache2 restart
