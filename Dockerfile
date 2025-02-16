# Sử dụng PHP 8.2 + Apache
FROM php:8.2-apache

# Cài đặt các thư viện cần thiết
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_mysql gd

# Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Thiết lập thư mục làm việc
WORKDIR /var/www/html

# Copy toàn bộ Laravel project vào container
COPY . .

# 🛠️ Fix lỗi quyền sở hữu & Git
RUN git config --global --add safe.directory '*'
RUN git config --system --add safe.directory /var/www/html
RUN git config --system --add safe.directory /var/www/html/vendor/theseer/tokenizer

# 🛠️ Set quyền sở hữu thư mục để tránh lỗi
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 /var/www/html

# Xóa thư mục vendor & cài lại
RUN rm -rf vendor
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Chạy quyền cho storage và bootstrap
RUN chmod -R 777 storage bootstrap/cache

# Mở cổng 80 cho Apache
EXPOSE 80

# Lệnh khởi chạy Apache
CMD ["apache2-foreground"]
