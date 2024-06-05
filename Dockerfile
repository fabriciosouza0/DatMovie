# Usar a imagem oficial do PHP com Apache
FROM php:8.1-apache

# Definir o diretório de trabalho
WORKDIR /var/www/html

# Instalar dependências do sistema e extensões PHP necessárias
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar os arquivos do projeto para o container
COPY . .

# Habilitar o módulo rewrite do Apache
RUN a2enmod rewrite

# Instalar as dependências do Composer
RUN composer install

# Configurar o Apache
COPY ./app /var/www/html

# Definir o comando de inicialização do Apache
CMD ["apache2-foreground"]